---
description: 'Deploying your applications from GitHub using SSH doesn''t have to be difficult and you don''t have to give your remote machine access to your entire GitHub account either. In this post, we''re going over using SSH through Deploy keys to only give your remote machine pull access to a single repository to deploy your application safely.'
post_date: '2020-08-19'
is_published: true
is_scheduled: false
update_date: '2021-01-13 12:09:30'
linkedin_post: 'I''ve worked a lot with Ansible of the past few weeks, what a journey it has been so far! I''ve learned to automatically deploy entire platforms across multiple servers with a single command and how to do this predictably and in a repeatable manner. Recently, I''ve found a way to make this even easier (and safer) by using SSH deploy keys in GitHub to give the remote machines access to 1 repository, but only read access. This is perfect for deployment purposes, so I decided to write about what I learned.'
twitter_post: ''
tags:
    - github
    - ansible
    - ssh
---
![Ansible Logo](/images/articles/ansible-logo.jpg)
# Ansible: Easy and Safe SSH deployments from GitHub
Ansible is a server orchestration tool that you can also use to perform workflows on remote machines in a predictable and repeatable way. In a previous post, ["Automating Laravel deployment using Ansible"](/articles/automating-laravel-deployment-using-ansible), I've lined out how you can deploy an application using your GitHub username and a user token using the Ansible Vault. However, you can also do this using SSH, making sure your server only has pull-access to your application repository. This extra layer of security is quite easy to accomplish, so in this post, we're going to look at how to do this.

In this blog post, we'll go over the following steps to use the same configuration as before, but with SSH instead of user tokens or passwords:

1. Generating an SSH key on your server
2. Submitting the Public SSH key to GitHub as a Deploy key
3. Deploying your application using SSH

## Prerequisites
You can use the configuration from the [previous blog post](/articles/automating-laravel-deployment-using-ansible) to deploy your application, the only difference in this post is that you won't need the Ansible Vault, so you can remove the "vars_files" key from the configurations mentioned in that post. Along with that, you'll need to use the SSH address as the "github_repo_url" value: git@github.com:your-username/your-repository.git. 

## Generating an SSH key on your server
Generating an SSH key on your server is a quick process and involves a single command:

```bash
ssh-keygen -t rsa -b 4096 -f ~/.ssh/id_rsa 
```

Let's break this down:
- "-t": this is where we define the public key algorithm and set this to "RSA"
-  "-b": we're setting the key size to 4096 bits (don't go any lower)
-  "-f": We're specifying which filename we'd like to use. 

When you're specifying a filename, make sure the file doesn't already exist. This will result in the existing key being overwritten, which could break other SSH connections you might have. If the file already exists, choose a different name: ~/.ssh/your_repository_name, for example.

If you do end up using a filename that differs from "id_rsa", you'll need to make an additional change:

1. Create and/or open the following file: ~/.ssh/config
2. Add the snippet below
3. Update the SSH address of your repository to use the custom SSH key

```
Host github_server
    Hostname github.com
    IdentityFile ~/.ssh/your_repository_name
    IdentitiesOnly yes
```

and change the SSH address for your repository in Ansible to git@github_server:your-username/your-repository.git. Notice how we're not using github.com anymore and are now using our custom configuration: github_server.

## Submitting the Public SSH key to GitHub as a Deploy key
Now that we've generated a private and public SSH key on our server, we can add this as a "Deploy key" to our GitHub repository. [Deploy keys](https://developer.github.com/v3/guides/managing-deploy-keys/#deploy-keys) are SSH keys that give the other machine access to a single GitHub repository. You, as the repository owner, can even specify if the remote machine has push privileges. By default, the Deploy keys only have pull access, which is exactly what we want for deployments. We don't want push privileges and we don't want to give the remote machine unlimited access to our entire GitHub account.

To get your public SSH key from your server, run this command:

```bash
cat ~/.ssh/id_rsa.pub
```

If you used a custom name for your SSH key, use that instead. This could be:

```bash
cat ~/.ssh/your_repository_name.pub
```

Notice the .pub behind the SSH key, this is your public key. You can give this out to others, just make sure to NEVER give out your private key (the file without the .pub at the end). The contents of the private file need to remain a secret at all times. 

You should now see your public key in the terminal, starting with "ssh-rsa". Copy the entire key, including ssh-rsa and the machine name at the end. This is all part of your public key.

Now, go to your Repository on GitHub and navigate to the "Settings" tab -> Deploy keys -> Add deploy key.

Give your Deploy key a recognizable title, like "Production server", and paste the public SSH key in the "Key" field. Don't check the "Allow write access" checkbox unless you really need to. Now click "Add key" and you should see your newly created Deploy key in your overview.

## Deploying your application using SSH
Now that you've connected your server to your GitHub repository, you can make some changes to your application and commit your changes. When you're ready to deploy your changes, execute your Ansible Playbook, and see your application being deployed using your new SSH setup. You can verify if your SSH key was used to pull your changes by refreshing the "Deploy keys" overview in GitHub. Your deploy key should now be green instead of gray, and it should have a message saying "Last used within the last week". 

To execute your Ansible Playbook, you can use this command:

```bash
ansible-playbook your-configuration-file.yml
```

## Conclusion
Deploying your applications from GitHub using SSH doesn't have to be difficult and you don't have to give your remote machine access to your entire GitHub account either. In this post, we went over using SSH through Deploy keys in GitHub to only give your remote machine pull access to a single repository to deploy your application safely and easily.

I've written this blog post to share my recent findings of deploying applications using Ansible. I could have missed a few things here and there, as I'm new to this myself. New findings will always be addressed in new blog posts and inaccuracies will be fixed in this post to make sure I'm not spreading misinformation. So if you've found a mistake, please let me know and help me to spread quality information to fellow software engineers.