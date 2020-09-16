---
description: 'Setting up your development environment with Ansible'
post_date: '2020-09-16'
is_published: false
is_scheduled: false
update_date: '2020-09-14 15:09:52'
faq: null
linkedin_post: ''
twitter_post: ''
---
![Ansible Logo](/images/articles/ansible-logo.jpg)
# Setting up your development environment with Ansible
It's probably very clear by now, but Ansible is one of my new favorite deployment/automation tools. I've written more about it at the links below, in case you're interested:

- [Automating Laravel deployment using Ansible](/articles/automating-laravel-deployment-using-ansible)
- [Ansible: Tasks vs Roles vs Handlers](/articles/ansible-difference-between-tasks-and-roles)
- [Ansible: Easy and Safe SSH deployments from GitHub](/articles/ansible-easy-safe-ssh-deployments-from-github)

Ansible is usually used for server orchestration, but you can do so much more with it. What about setting up your development environment to be perfectly suited for the project(s) you're working on...completely automatically? You won't have to deal with setting up your environment from scratch on new systems any more and you can share your Playbook with colleagues to help them quickly get started on projects. 

These two use cases might be enough to convince you of the benefit of automating setting up your development environment, but in case you need another reason: In case you mess up, I mean really mess up, you can run your Playbook again and continue as if nothing happened. Let's get into what you need to automatically set up your development environment and how to actually do this.

## Pre-requisites
- Ansible installed
- Python installed
- Ubuntu-based distro installed (or you can port the included script to your distro)
- A list of software you need to get your projects running
- A list of software to develop your software (softwareception)