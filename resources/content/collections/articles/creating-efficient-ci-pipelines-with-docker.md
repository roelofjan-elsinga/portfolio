---
update_date: '2021-01-13 13:59:25'
description: 'Find out what I''ve done to improve the efficiency in the CI pipeline with CircleCI and Docker for a PHP application. You won''t even have to install any software yourself.'
is_scheduled: false
is_published: true
post_date: '2019-10-23'
url: creating-efficient-ci-pipelines-with-docker
linkedin_post: ''
twitter_post: ''
tags:
    - docker
    - laravel
    - circleci
---
!["Circleci docker laravel"](/images/articles/circleci-docker-laravel.png)
# Creating an efficient CI pipeline with CircleCI, Docker, and Laravel
Efficient and fast CI pipelines are great because you quickly know if your application behaves the way it does, by running automated tests. Having pipelines that take a long time to complete have the disadvantage that people might start to ignore the status checks if something needs to be fixed quickly. This is something you want to avoid, so I've compiled a way to run PHPUnit tests in a very simple environment without having to install any composer dependencies.

## Setting up a docker compose environment for CI
When your application is dependent on a lot of different services, you want to mock most of these or run them in RAM memory.  For database tests for example, you often want to use an in-memory SQLite database. However, in my case this was impossible as the application was dependent on certain geolocation functions (ST_AsText, ST_MPolyFromText, ST_IsValid, etc.). These are not available for SQLite, so instead a MySQL server with a mounted tmpfs volume storage device will have to do. This simply means that we're using a MySQL server, which is tricked into using RAM memory as a storage device. This results into lightning fast reading and writing operations. You get the functionality of a MySQL server with the performance of a in-memory SQLite database.

You can very easily do this in docker. I'm using a docker-compose.yml file, but you can also do this in the terminal with the docker commands. This is how I've done it in docker-compose:

```yml
version: "2.3"
services:

  mysql:
    image: mysql:5.7
    tmpfs: /var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: testing_database
      MYSQL_USER: testing_user
      MYSQL_PASSWORD: testing_password
    networks:
    - front

networks:
  front:
```

The special things in this configuration are the tmpfs key and the networks. The tmpfs key tells the docker container to place the /var/lib/mysql folder into RAM memory. This is the folder than contains all the data that's stored in the databases. The networks key is important, because we'll come back to that in a minute. For now, you just have to create a new network and make sure the mysql container is part of that network. This network has the name "front". This is important for later.

## Creating a docker image for your PHP environment
Since it's not really possible to cache installed programs and extensions in CircleCI (installed through apt-get install), the only other way is to create an docker image that contains all required programs and extensions. When you build this docker image, the layers will be cached and you'll be able to run the docker image in mere seconds, even though it includes all software you need to build your application. If you install these applications on the virtual machine within CircleCI, this could take up to 5 minutes and that's just preparing the testing environment. Using a provisioned docker image, you can download it in 10 seconds and run commands 3 seconds later.

Since I'm testing a Laravel application, I can use the following Dockerfile to install any and all composer dependencies and run any and all artisan commands:

```Dockerfile
FROM debian:9.7-slim

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y --no-install-recommends apt-transport-https lsb-release \
			ca-certificates wget build-essential \
    && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' \
    && apt-get update \
    && apt-get install -y --no-install-recommends php7.3 php7.3-fpm php7.3-mysql \
        mcrypt php7.3-gd curl php7.3-curl php7.3-mbstring php7.3-xml php7.3-soap \
        php7.3-zip php-zmq php7.3-bcmath php-pcov unzip \
    && curl -s https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

VOLUME /var/app

WORKDIR /var/app

EXPOSE 9000
```

As you can see here, I'm using the Debian slim image instead of Ubuntu 18.04 (or any other version). This is done with the sole reason that the Debian image is 50 - 60% smaller in size, which means it'll download much faster. Instead of downloading 900mb, CircleCI will "only" have to download 300mb. This Dockerfile installs all PHP dependencies I need and the latest installation of Composer.

This Dockerfile is also available for download, you can pull it by running:

```bash
docker pull roelofjanelsinga/test-suite
```

## Running tests by using the new Docker image
When setting up the application in CircleCI, we'll need to install all Composer dependencies and generate an APP_KEY before running any tests. We can very easily install the composer dependencies without installing composer on the virtual machine, because we have the docker image. Run the following command to install all composer dependencies:

```bash
docker run --rm \
    -u $(id -u):$(id -g) \
    -v `pwd`:`pwd` -w `pwd` \
    --network=$(docker network ls | grep front | awk '{print $2}') \
    roelofjanelsinga/test-suite \
    composer install
```

Let's go through this command line by line:

**docker run --rm**: This will run a command and remove itself after the command has finished.

**-u $(id -u):$(id -g)**: This will run the container with the same user as your current user (ex: 1000:1000). This avoids any incorrect file permissions.

**-v \`pwd\`:\`pwd\` -w \`pwd\`**: These are backticks, not quotation marks! This will mount the current directory in the same location in the docker container and set the working directory to that folder. This means that all commands will be run in that folder.

**--network=$(docker network ls | grep front | awk '{print $2}')**: This is where the networks key from earlier comes in. The command: *$(docker network ls | grep front | awk '{print $2}')* returns the name of the network you created in the docker-compose.yml file. If you haven't named your network "front" in the earlier steps, be sure the replace it in this command. Normally docker-compose will name your network something along the lines of: prefix_front. However, this is not a guarantee, so by running *docker network ls* we get the actual name. This part of the command attaches the docker images to the network. This will allow you to connect to the mysql server through the docker network.

**roelofjanelsinga/test-suite**: This is where you specify the container to run. I'm simply using the container we've created earlier. CircleCI won't have this container installed locally and will download it. This is why I'm using Debian slim instead of Ubuntu, just to make this process run more quickly.

**composer install**: This is the command we're running. This will install all composer dependencies using the software we've install inside the docker container. Since we mounted the current directory into the docker container and we're running the command in that directory, this will write all composer files to the storage layer in the virtual machine.

## Caching composer dependencies
Installing composer dependencies takes a while depending on how many dependencies you have installed. To avoid doing this every time, we will cache these dependencies:

```yml
- save_cache:
    key: my-project-composer-dep-{{ checksum "composer.lock" }}
    paths:
    - ~/my-project/vendor
```

This will save the installed dependencies and will only restore it when you make any changes to the list of composer dependencies you have. When you have cache available, you can restore it as well, let's add this in a step before we're installing the composer dependencies. This means composer will see the dependencies are already installed and skip the installation.

```yml
- restore_cache:
    keys:
    - my-project-composer-dep-{{ checksum "composer.lock" }}
```

## Putting everything together
Now that we've discussed everything that's related to using Docker to improve your CI pipeline performance, I'll show you the full configuration and how you could use it in your own projects:

```yml
version: 2
jobs:
  Test-PHP:
    machine:
      image: ubuntu-1604:201903-01
    working_directory: ~/my-project
    steps:
    - checkout
    - restore_cache:
        keys:
        - my-project-composer-dep-{{ checksum "composer.lock" }}
    - run:
        name: Starting docker-compose services
        command: |
          echo "Starting docker-compose"
          docker-compose -f docker-compose-ci.yml up -d
    - run:
        name: Install Composer dependencies
        command: |
          mv .env.testing.example .env.testing
          docker run --rm \
            -u $(id -u):$(id -g) \
            -v `pwd`:`pwd` -w `pwd` \
            --network=$(docker network ls | grep front | awk '{print $2}') \
            roelofjanelsinga/test-suite \
            composer install
          docker run --rm \
            -u $(id -u):$(id -g) \
            -v `pwd`:`pwd` -w `pwd` \
            --network=$(docker network ls | grep front | awk '{print $2}') \
            roelofjanelsinga/test-suite \
            php artisan key:generate
    - save_cache:
        key: my-project-composer-dep-{{ checksum "composer.lock" }}
        paths:
        - ~/my-project/vendor
    - run:
        name: Run PHPUnit tests
        command: |
          docker run --rm \
            -u $(id -u):$(id -g) \
            -v `pwd`:`pwd` -w `pwd` \
            --network=$(docker network ls | grep front | awk '{print $2}') \
            roelofjanelsinga/test-suite \
            ./vendor/bin/phpunit
```

As you can see, all commands to interact with the applications are run through the docker container. We're installing composer dependencies, generating a application key, and running PHPUnit tests in the docker image. This makes it so the virtual machine (ubuntu) doesn't need to install anything, because docker is already preinstalled. They only thing the virtual machine does is pulling the latest changes from a git repository. Everything else is managed through the docker container.

I hope this helps you improve the efficiency of your CI pipelines. If you have any questions or suggestions to make this configuration better, please let me know on [Twitter](https://twitter.com/RJElsinga).