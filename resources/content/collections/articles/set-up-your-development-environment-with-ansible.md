---
description: 'Setting up your development environment with Ansible is a great way to save yourself and your colleagues headaches. Creating an Ansible Playbook helps you to keep everyone on your team in the same environment and makes switching machines an easy task, not a chore.'
post_date: '2020-11-30'
is_published: false
is_scheduled: false
update_date: '2020-11-30 17:44:58'
faq: null
linkedin_post: ''
twitter_post: ''
---
![Ansible Logo](/images/articles/ansible-logo.jpg)
# Setting up your development environment with Ansible
It's probably very clear by now, but Ansible is one of my favorite deployment/automation tools. It's a tool to very easily create reproducible scripts that you can use for all kinds of different purposes. In case you're interested to find out more about what I've done with Ansible, go have a look at any of the links below.

- [Automating Laravel deployment using Ansible](/articles/automating-laravel-deployment-using-ansible)
- [Ansible: Tasks vs Roles vs Handlers](/articles/ansible-difference-between-tasks-and-roles)
- [Ansible: Easy and Safe SSH deployments from GitHub](/articles/ansible-easy-safe-ssh-deployments-from-github)

Ansible is usually used for server orchestration, but you can do so much more with it. What about setting up your development environment to be perfectly suited for the project(s) you're working on...completely automatically? You won't have to deal with setting up your environment from scratch on new systems any more and you can share your Playbook with colleagues to help them quickly get started on projects. 

These two use cases might be enough to convince you of the benefit of automatically setting up your development environment, but in case you need another reason: In case you mess up, I mean really mess up, you can run your Playbook again and continue as if nothing happened. Let's get into what you need to automatically set up your development environment and how to do this.

## Pre-requisites
- Ansible installed 
- Python installed
- Debian-based distro installed (or you can port the included script to your distro of choice)
- A list of software you need to get your projects running (docker, docker-compose, etc.)
- A list of software to develop your software (PHPStorm, MySQL Workbench, etc.)

Installing Python and Ansible on Debian based systems is a single command:

```terminal
sudo apt-get install python3 ansible
```

You can now start writing your [playbook](https://docs.ansible.com/ansible/latest/user_guide/playbooks.html), as it's called in Ansible.

## Creating your playbook
Creating a playbook is essentially creating steps in a process and defining what those steps do. You can use several modules for this, for example: git, docker, apt, service, and shell. These modules are included in Ansible and you can make use of these to simplify and standardize the steps in your playbook. If you want to, you could do everything using shell commands, but it's easier to maintain if you use a module that's built for what you're trying to do. This way you can look up what a step does instead of deciphering commands.

For example, we might need to install git, docker, and python3-pip. In that case, you could use the "apt" module like so:

```yml

- name: "Install required software"
  apt:
    name: "{{ packages }}"
    state: present
	become: true
  vars:
    packages:
    - git
    - docker
    - docker-compose
    - python3-pip
```

If you want to install this using shell commands, this would look like this:

```terminal
apt-get install git docker docker-compose nodejs python3-pip
```

We specify that the packages should be "present". The apt module knows what this means and installs these packages if they're not installed yet. This means that you could run this playbook multiple times, but it'll only install the packages if they're not yet installed on the system.

Since we also need Docker for our development environment, it's useful to start the Docker engine when you boot your system. You can often do this using the following command:

```terminal
sudo systemctl enable docker && sudo systemctl start docker
```

But, you could also use the "service" module to make this step a little more abstract and less vulnerable to potential changes:

```yml
- name: "Starting Docker"
  become: true
  service:
    name: docker
    state: started
    enabled: yes
```

With this "service" module, we're making sure that we start Docker when the system boots up, but also that it's already running right now. You can use whichever version of installing software you prefer, but I like to stick as close the the included modules as possible. This way, when something changes under the hood, I won't have to update my playbooks.

## Pulling your Git repository using Ansible
Now that we have the required software on our machine, we need our code from Github. You guessed it, there is an Ansible module for that. This is what it looks like:

```yml
- name: "Pull our Git repository"
  git:
    repo: git@github.com:roelofjan-elsinga/portfolio.git
    dest: /var/www/html/roelofjanelsinga.com
    version: master
    accept_hostkey: yes
```

This assumes that you have the permission to pull from the specified GitHub repository. As the repository I've specified there is this website, and it's public, you can pull that without any issues. You can automate setting up SSH keys with GitHub as well, but I won't go into that in this post.

## Launching a Docker environment using Ansible
In the previous step, we've gone over some basic steps to install software we need to be able to run our application. You might also have seen that I included python3-pip in that list of applications. You might not need this for your software, but we will need it for the Docker module that's built into Ansible. For this example we want to launch a simple docker environment with docker-compose. First, let's look at the docker-compose.yml configuration:

```yml
version: "3.8"
services:

  nginx:
    image: nginx:1.19.2-alpine
    volumes:
    - ./:/var/app
```

This will map the current directory in /var/app of the Docker container. As you can see in this example, we're going to need an nginx container. We can pull this from Docker Hub by using Ansible:

```yml
- name: "Pull the Nginx image"
  docker_image:
    name: nginx:1.19.2-alpine
    source: pull
```

And now you'll have the Docker image on your host and you can launch your docker-compose environment with Ansible:

``` yml
- name: "Launch the docker-compose environment using shell"
  shell: docker-compose up -d
```

You can also use the [docker-compose module](https://docs.ansible.com/ansible/latest/collections/community/general/docker_compose_module.html) for Ansible in case you have more detailed needs. Since I'm only bringing the environment up, I don't feel the need to install a community plugin.

## Specifying hosts to run this Playbook on
So we have a basic Playbook, but now we need to configure hosts to run this playbook on. Since we're only interested in running this Playbook on our local machine, it's easy to specify your host: it's called "local". Let's add that to our Playbook and let's see what the finished Playbook looks like:

```yml
- hosts: local
  tasks:
  - name: "Install required software"
    apt:
      name: "{{ packages }}"
      state: present
    become: true
    vars:
      packages:Setting up your development environment with Ansible is a great way to save yourself and your colleagues headaches. Creating an Ansible Playbook helps you to keep everyone on your team in the same environment and makes switching machines an easy task, not a chore.
      - git
      - docker
      - docker-compose
      - python3-pip
  - name: "Starting Docker"
    become: true
    service:
      name: docker
      state: started
      enabled: yes  
  - name: "Pull our Git repository"
    git:
      repo: git@github.com:roelofjan-elsinga/portfolio.git
      dest: /var/www/html/roelofjanelsinga.com
      version: master
      accept_hostkey: yes
  - name: "Pull the Nginx image"
    docker_image:
      name: nginx:1.19.2-alpine
      source: pull
  - name: "Launch the docker-compose environment using shell"
    shell: docker-compose up -d
```

This is our simple, yet complete playbook and we're now ready to run our playbook and see our local machine being setup from a fresh install of a Debian-based distro into a development machine, exactly like your colleagues have it as well. That's really the power of Ansible here: when you make a change to your playbook and share this with your colleagues, they can run your updated playbook and it'll setup their system in the exact same way as you've intended it. We can run this playbook using a single command:

```terminal
ansible-playbook playbook.yml
```

This will now go through all the steps you've specified in your own playbook. If you're not satisfied with the results, simply change your playbook and run it again. 

Creating a playbook is often a process with a lot of little things to change here and there to get it just the way you want. But even though in seems like a lot of work, it can save you countless of hours in the future. When you move to a new machine, simply run the playbook again and you can continue where you were, without having to tinker for hours to get everything like you had it.

