---
description: 'Experimenting with Ansible: The power of automation in your hands'
post_date: '2020-06-03'
is_published: false
is_scheduled: false
update_date: '2020-06-03 15:45:37'
faq:

---
# Experimenting with Ansible: The power of automation in your hands

Ansible is a system orchestration tool to set up your servers, but also desktops, to the exact state you need it to be in to do its job. To see how this works, let's see how this works for this very website. This server, and this website are managed through Ansible and it allows me to deploy changes to the server without ever touching the server. But that's only the beginning: if I want to include a search engine that runs on another server, I can also manage that in Ansible. 

But the best part yet: you don't have to install anything on the server to be able to orchestrate and deploy changes to your server. Everything is set up in configuration files on your local machine and the tasks are executed through SSH tunnels. This makes it very simple to keep the configuration files safe in a private (or public) repository on GitHub or any other version control system. 

## How does it work?
Ansible uses SSH to connect to all the servers you defined in your hosts file. In this case, my hosts file only contains 1 domain: roelofjanelsinga.com, this website. You could also enter the IP address of your server, but I find it easier to use the domain name. 