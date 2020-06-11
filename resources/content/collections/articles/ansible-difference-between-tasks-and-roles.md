---
description: 'Ansible has several ways of performing tasks: Tasks, Roles, and Handlers. Each has a different use case and in this post, I go over what each of them does and how you can use them.'
post_date: '2020-06-10'
is_published: true
is_scheduled: false
update_date: '2020-06-10 16:44:40'
---

![Ansible Logo](/images/articles/ansible-logo.jpg)
# Ansible: Tasks vs Roles vs Handlers
Running tasks in Ansible can be done in different ways and this can be very confusing for those starting out with automation and server orchestration. In this post, I'll explain the difference and why you should use one or the other for certain situations. If I had this post when I started with Ansible it would've saved me hours of researching, so hopefully this helps you.

## Tasks
Tasks are...well tasks. They are specific to a workflow, called playbooks, in Ansible. If you read my post from last week, [Automating Laravel deployment using Ansible](https://roelofjanelsinga.com/articles/automating-laravel-deployment-using-ansible), you would have seen the configuration I shared at the bottom of that post. This configuration used tasks. These tasks are specific to that specific playbook and can't be shared with other playbooks. This is something you should use roles for.

An advantage of using tasks rather than roles or handlers is that you have the details of the tasks in the same file as the entire playbook. You can quickly see what your entire playbook will do when you execute it. This is great for smaller playbooks, like the playbook I shared, but gets tough to understand when the playbook gets longer. This is where roles might offer a way out.

## Roles
Roles are a collection of tasks that are grouped under a common name. If we use the configuration that I shared last week, we can convert that into a playbook with roles, rather than tasks. This would look like the configuration below.

<script src="https://gist.github.com/roelofjan-elsinga/25952857fffcef0e39ccc1ca693d8268.js"></script>

This configuration has the role "deploy_laravel_app". To understand what's happening here, I need to give you the folder structure:

```
├── deploy_laravel_app
│   ├── handlers
│   │   └── main.yml
│   └── tasks
│       └── main.yml
└── playbook.yml
```

Here you can see the "playbook.yml" we're using above and a folder called "deploy_laravel_app". The folder name determines the name of the role in the playbook. The role contains two folder, handlers and tasks. We'll focus on handlers in the next section, but for now we'll focus on the tasks folder. This folder contains a main.yml. This is the default filename ansible will look for when trying to find tasks for a specific role.

The main.yml contains the following configuration:
<script src="https://gist.github.com/roelofjan-elsinga/6f2f6d872dd079719dd187e85b89a350.js"></script>

Here you can see 2 new things that we haven't seen in the configurations yet. The "when" attribute of the tasks from the previous blog post is missing and instead we have the "notify" attribute. These two attributes do the same thing in the sense that they are both running tasks, but only if the status of the task is "changed" instead of "OK". In other words, this means that the tasks in "notify" are only executed when the task makes a change to the state of the application. In this case, if we pull new changes from Git, only then will those tasks be performed. The difference between the "when" and "notify" attribute however is this: The when attribute is registered on a task, which means the order of execution won't change. The tasks that are executed under the "notify" attribute are handlers. Handlers are executed after all other tasks have been performed.

The order of execution then looks like this:
1. Tasks
2. Roles
3. Handlers

So if you have multiple roles that each call different handlers, all roles will perform their tasks first and then all the handlers that need to be executed. 

The advantage of using roles rather than tasks is that the playbook stays small, but you're also creating reusable processes that can be added to multiple playbooks. The use of variables is very important in this case. The disadvantage is that you won't be able to see what the playbook is actually running and in which other the different tasks are executed. You have to look through multiple directories to be able to figure out what is running at which point in time.

## Handlers
Handlers are tasks, but they're executed at the very end of the playbook. If you were to compare this to a JavaScript execution cycle, you could say that handlers are additional tasks that are appended to the task list, not executed in between two other tasks. In the previous section, I showed you the folder structure we're using. Now lets see what's inside of the main.yml in the handlers folder.

<script src="https://gist.github.com/roelofjan-elsinga/def7668a00525601342d7b044c5fc300.js"></script>

This looks like the tasks from the configuration from [Automating Laravel deployment using Ansible](https://roelofjanelsinga.com/articles/automating-laravel-deployment-using-ansible). The only difference is that the names are identical to the names used in the "notify" section of the task in the role. These are seen as unique identifiers within the role and it uses the name to figure out which handlers to run.

The advantages of handlers is that you can very easily perform certain tasks and "schedule" a cleanup command for example. That way it's not something that'll get in the way of executing the main tasks, but it's also not something you're going to forget.

The biggest disadvantage for me personally is that you're not able to give the handlers a descriptive name like you can for the roles and tasks. 

## Conclusion
There are several ways to perform tasks with Ansible: Tasks, Roles, and Handlers. They all have a different use case and they each have their advantages and disadvantages.

- Tasks: clear overview of the tasks to be executed, but could get difficult to understand with longer playbooks.
- Roles: reusable tasks that can schedule other tasks, but it's more difficult to figure out which tasks are performed.
- Handlers: Simple tasks to be performed at the end, but you can't give them a nice and descriptive name.

I hope this post helped you to understand the difference between the ways you can perform actions in an Ansible playbook. It took me hours to figure out what the difference was and how each of them worked, so I hope this cleared that up.