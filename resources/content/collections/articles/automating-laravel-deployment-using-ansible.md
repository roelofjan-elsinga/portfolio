---
description: 'Deploying changes to your websites is often a very repetitive task. Repetition means you can automate the entire process. To do this, you can use Ansible, because it''s easy to set up and doesn''t require any special software on the remote machine.'
post_date: '2020-06-07'
is_published: false
is_scheduled: false
update_date: '2020-06-07 17:17:58'
---
# Automating Laravel deployment using Ansible

If you, like me, have been deploying changes manually to any of your websites consistently for months, if not years, you know that this is a repetitive task. Usually, you pull your changes from your version control system (VCS), run a few tasks to install production dependencies and/or compile them, cache your configuration, and reload some kind of service. It's usually the same few steps with a few optional steps, in case you need to run database migrations for example.

## What is Ansible?

You know that if something is repetitive, you can automate it. This is where Ansible comes in. Originally, Ansible is a tool to help with server orchestration and repeat tasks reliably on an infinite amount of servers. The best part of Ansible is that you don't need to install anything on your remote machines. The only requirement is that you need to be able to connect to your remote machine through SSH. If you can do that, you can use Ansible.

You could compare Ansible to a large bash script that runs commands on the remote machine through SSH. The main difference between these two is that Ansible makes everything much easier and has built-in modules for abstracting many tasks. Pulling changes from GitHub, specifying only a repository and a destination folder is one of these modules. It makes writing tasks much quicker and easier. 

## Why is Ansible useful?

I mentioned that Ansible is originally used for server orchestration. As Ansible is essentially an easy to manage bash file, you can make it do anything you want to. This includes using it for deploying your websites, be it one 1 or 1000 servers. As long as you can use SSH on all of those servers, you can deploy on all of them. 

As most of my websites are built using Laravel, I'll provide a simple configuration to deploy your Laravel website to your server, migrate your database, cache your configuration, and clear your views cache. This is very basic, but it's a starting point. This is not a tutorial, because frankly, I've just started out with using Ansible. 

## The basic configuration
<script src="https://gist.github.com/roelofjan-elsinga/84bf1c1fa58ecfa95e18a5174bdd0f14.js"></script>

Then you'll need to create the secrets.yml file, you can use ansible vault:

```bash
ansible-vault create secrets.yml
```

Then fill it with these pieces of information:

```yaml
github_user: your_username
github_token: your_github_access_token
```

To edit this file, you can use the following command

```bash
ansible-vault edit secrets.yml
```

This is still something I'm learning, so that's why this is not a full-on tutorial. But by putting this out there, I've already learned a lot of new things about using Ansible.

There will definitely be more content about Ansible, because I'm already loving how easy it is and how many modules are built-in. When I know more about how it works in-depth, I will write a tutorial for it.