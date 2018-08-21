!["Containers"](/images/articles/0_DMj0ko2eJtSm4nRZ.jpeg)

# Docker isn't as difficult as I thought it was

When I looked into using Docker for my projects, I was very intimidated by “the Dockerfile”. This was until I realized that I’ve been doing a similar thing for a year outside of Docker.

A year or so back, I wrote a full installation script that needed to be run on any new server to install any necessary software for a particular project. I thought this was the best thing in the world because with a single command I could install the entire application and all its dependencies.

So it still confuses me that I thought Docker was difficult to understand. It’s exactly the same concept as the full installation script, but instead of installing any software on the Host OS, you install it in a contained environment. So when I figured this out, I built a single Dockerfile for my projects, containing everything I needed to get started. Then I thought to myself, “Docker is used as a container service, why do I use a single large container?”. It felt like I wasn’t using the software as intended. This is when I came across docker-compose.

Docker compose manages multiple different containers for you through a docker-compose.yml file. Now I finally felt like I was taking full advantage of the different containers.

An example of this can be found here:

```yml
version: "2"
services:
  nginx:
      build:
          context: ./nginx
      ports:
          - "8080:80"
      volumes:
          - ../:/var/app
  fpm:
      build:
          context: ./fpm
      volumes:
          - ../:/var/app
      expose:
          - "9000"
  redis:
      image: redis
      expose:
          - "6379"
  solr:
      image: solr:7.2.1-alpine
      expose:
          - "6379"
      volumes:
          - ./solr/search_core:/opt/solr/server/solr/search_core

```

This file seems a bit strange if you’ve never worked with Docker or docker-compose before, but it’s actually really simple. The version simply marks which version of Docker you’d like to use. The services block is where it get’s interesting because this is where you define your different containers. As you can see, I have four different containers.

The first service is nginx, because you’ll need some kind of web server, and I like Nginx better than Apache. Nginx requires you to redirect any content to PHP, in contrast to Apache. This is why I also have a PHP container defined. The “context” argument here simply means that any configuration I’d like to do is located in a Dockerfile in the given location. In this Dockerfile I have defined what software the container should run.

This is an example of the Dockerfile for the Nginx service:

```bash
FROM nginx
ADD ./default.conf /etc/nginx/conf.d/
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
CMD service nginx start
```

All this Dockerfile does it customize the default Nginx web server configuration. Then it tells Nginx to not run in daemon mode (because the docker image will stop working right away). The CMD directive simply starts the Nginx service. The configuration that’s being applied to the Nginx container can be found here:

```conf
server {
    listen 80 default_server;
    root /var/app/public;
    index index.php index.html;
    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_disable "msie6";
    gzip_comp_level 6;
    gzip_buffers     4 4k;
    gzip_types text/css application/javascript text/javascript text/plain text/xml application/json application/x-font-opentype application/x-font-truetype application/x-font-ttf application/xml font/eot font/opentype font/otf image/svg+xml;
    gzip_min_length 1000;
    rewrite_log on;
    # serve static files directly
    location ~* \.(jpg|jpeg|gif|css|png|js|ico|html)$ {
        access_log off;
        expires max;
        log_not_found off;
    }
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~* \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass fpm:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    location ~ /\.ht {
        deny all;
    }
}
```

This configuration makes sure that the web server serves the PHP files correctly and adds some caching headers to static files. All requests are forwarded to the PHP container through “fastcgi_pass fpm:9000;”. Obviously, this Nginx installation is not set up for SSL, but for development purposes, this has not been deemed necessary (yet).

The third service is Redis, but as you can see, I defined an “image” argument here. This means that I’m using a pre-built Docker image and don’t wish to make any adjustments (in this case, at least). I simply expose port 6379 to be able to monitor the service from my Host OS. This is not recommended in a production environment, because the outside would will be able to access it now. Docker provides internal pointers to this port, so you’ll be able to use it in the other containers, without exposing it to the outside.

The fourth service is again a pre-built Docker image, but this time I’m attaching a host volume, through “volumes”. What this means is that I’m allowing the Docker container to interact with a folder or folders on my Host OS. This way I’m able to use information from my own hard drive inside the container.

Docker and docker-compose make it very simple to work together with colleagues on the same code because all the code runs in the exact same environment. It doesn’t matter if they use Mac OSX, Windows or Linux, the application environment will always be identical.

So if you’ve not tried Docker yet or you’re intimidated by it, give it a try and don’t give up. When you get it to work, it’ll be a wonderfully simple experience to add functionality to your application. If you have any tips on how I can improve any of my examples here, please let me know! I love to learn more from you!