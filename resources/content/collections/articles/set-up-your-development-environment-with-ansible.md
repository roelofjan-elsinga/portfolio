---
description: 'Setting up your development environment with Ansible'
post_date: '2020-09-30'
is_published: false
is_scheduled: false
update_date: '2020-09-29 16:49:48'
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

```bash
sudo apt-get install python3 ansible
```

You can now start writing your [playbook](https://docs.ansible.com/ansible/latest/user_guide/playbooks.html), as it's called in Ansible.

## Creating your playbook
Creating a playbook is essentially creating steps in a process and defining what those steps do. You can use several modules for this, for example: git, docker, apt, service, and shell. These modules are included in Ansible and you can make use of these to simplify and standardize the steps in your playbook. If you want to, you could do everything using commands, but it's easier to maintain if you use a module that's built for what you're trying to do. This way you can look up what a step is doing instead of deciphering commands.

For example, we might need to install git, docker, nodejs, and python3-pip. In that case, you could use the "apt" module like so:

```yml

- name: "Install required software"
  apt:
    name: "{{ packages }}"
    state: present
  vars:
    packages:
      - git
      - docker
      - docker-compose
      - nodejs
      - python3-pip
```

We specify that the packages should be "present". The apt module knows what this means and installs these packages if they're not installed yet. This means that you could run this playbook multiple times, but it'll only install the packages if they're not yet installed on the system.

Since we also need Docker for our development environment, it's useful to start the Docker engine when you boot your system. You can often do this using the following command:

```bash
sudo systemctl enable docker && sudo systemctl start docker
```

But, you could also use the "service" module to make this step a little more abstract and less vulnerable to potential changes:

```yml
- name: "Starting Docker"
  service:
    name: docker
    state: started
    enabled: yes
```

With this "service" module, we're making sure that we start Docker when the system boots up, but also that it's already running right now. You can use whichever version you prefer, but I like to stick as close the the included modules as possible.