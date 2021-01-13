---
is_scheduled: false
is_published: true
url: development-sprint-workflows
canonical: 'https://medium.com/tubber-development/development-sprint-workflows-55b21225b2f8'
post_date: '2018-11-05'
external_url: 'https://medium.com/tubber-development/development-sprint-workflows-55b21225b2f8'
description: 'During development sprints, you plan work that needs to be completed by the end of the sprint, and you try to leave some extra room for bugs that might occur and need to be fixed.  This post describes how I plan to use time more efficiently and to keep developers focused on their task at hand during sprints.'
update_date: '2021-01-13 14:21:47'
linkedin_post: ''
twitter_post: ''
tags:
    - development
---
!["Development sprint workflows"](/images/articles/0_tWzT65t5CidslLRb.jpeg)

# Development sprint workflows
During development sprints, you plan work that needs to be completed by the end of the sprint, and you try to leave some extra room for bugs that might occur and need to be fixed. When bugs occur, you’re expected to drop everything you’re working on to solve them, but this is a huge strain on developers and there are better ways to deal with this. This post describes how I plan to use time more efficiently and to keep developers focused on their task at hand during sprints.

## Sprint duration (2–6 weeks)
A specified time frame to complete tasks is an excellent way to make sure tasks are being completed on time. The time pressure will promote focus rather than distractions during a workday. By time pressure I mean that there is a deadline, not an excuse to cram too much work in a given time frame. As a team, you will decide on a duration for the upcoming sprint. This is not a fixed amount of weeks, because sometimes there are events or other things that will block a full 6-week sprint. And uninterrupted sprints are exactly what we’re trying to avoid here.

The minimum amount of time for a sprint is 2 weeks and the maximum amount is 6 weeks. If you were to go longer than 6 weeks, productivity will go down, because “there is plenty of time to do this later, I’m making something cool right now”. The deadline forces you to make choices about what to make and which features have the highest priorities. This means that you can decide to take on a large and ambitious project for 6 weeks, but at the end of the 6 weeks it has to be done. This could mean that you have to decide to only build the absolute minimum viable product (MVP) and build on this later on. The results don’t always have to be perfect. This is not an excuse to deploy sloppy work, but it’s to build the MVP and build that as well as possible.

### The backlog
Every once in a while you’ll think of a new feature to build during a sprint. You will work on this during the same sprint after all other work has been completed. This should be discouraged. This is not meant to be mean or kill creativity, but to protect the overall product. Any new features will be added to the backlog and considered for the next sprint. This way, you’re not wasting your time on features that may not be as useful as you first thought. The “cool-down” time you give to the feature, by just adding it to the backlog, helps to prioritize it. If you, and others, still think it’s a great feature after 2–6 weeks, you can go ahead and build it. If not, simply remove it from the backlog and no harm was done.

With that said, anyone is allowed to add features to the backlog. But only the development team and product owner decide which tasks will actually be added to an upcoming sprint. The development team knows best how long something will take to build, and this is why they have the last say on what’s being built. The product owner will simply help to prioritize work during this process.

### Jobs to be done
To help your team prioritize features and tasks, it could be beneficial to use “Jobs to be done” in your workflow. A quick explanation can be found on YouTube. This will help to filter any of the new features or changes to see if they are actually beneficial to the users of your product. All tasks that add benefit to your product should get the highest priority because you will actually make the product more useful. Any other tasks will get a lower or even no priority at all.

## Bug sprints (1–2 weeks)
After a few weeks of working on features and tests, there could still be several bugs. To minimize interruptions caused by these bugs in the next sprint, take one or two weeks between two sprints to hunt for bugs and resolve them. Any minor details from the past sprint can be altered during this bug sprint, but only after you can’t find any more bugs. It’s not allowed to start new features during this bug sprint. Any new features will need to be added to the backlog and can be added to the next sprint.
A note about critical bugs: they always have priority over every other task.

### Assign a “bug lead”
Of course, hunting for bugs only really applies to a team that has no dedicated testers or QA team. When these people are present, they will collect all issues during the sprint and list them to be fixed during the bug sprints. A note about critical bugs: they always have priority over every other task. Assign a person within the development team to make decisions on which bug is critical and which bug has a lower priority. It doesn’t matter which member of the development team takes this job, but it’s important that only 1 person does this.

There should only be minimal room for discussion because you can discuss something endlessly without making a decision. Ideally, the most experienced member of the team would take this task upon him- or herself, because he or she usually has better judgment on the subject. However, it could also be a great idea to let everyone try to take on this role, but only one person per sprint. This way, other departments will know who to talk to when something goes wrong, instead of bothering multiple people with their problems and creating irritation within the team.

The bug lead will determine if the bug is critical enough to make someone drop everything they’re doing to resolve the problem.

## Continuous Integration / Continuous deployment
To achieve a system always evolving and improving, continuous integration and continuous deployment (CI/CD) is a method to implement in your team’s workflow. This simply means that new features and bug fixes are published as soon as they’re done and tested. This way you can provide users of your product with quick solutions and new features.

### Publishing workflow in Git
Once you’ve completed work and fully tested your implementations, you can make pull requests (or merge requests) to the appropriate branch your team has decided on. You can use any CI/CD service to help test the code in your pull request. Assign anyone from your team to look over your code, remember, you’re now preventing them from working on their own tasks, so keep these pull requests short and to the point. Once they approve your changes, you can wait for someone to merge your pull request or do it yourself if you have this ability.

### Versioning releases
To keep these releases simple to track, you’ll have to use versioning and refer to these versions when talking about problems and solutions. For an excellent reference about versioning, have a look at Semantic Versioning. In short, the meaning for versions for MAJOR.MINOR.PATCH (0.0.0, 1.0.0, etc), are:

- MAJOR version when you make incompatible API changes,
- MINOR version when you add functionality in a backward-compatible manner, and
- PATCH version when you make backward-compatible bug fixes.

(Copied from https://semver.org/)

These versions can get tagged through Git and then pushed to any repository service.

This is a lot of information for a single post, but I think it will add benefit to the workflow within a development team. The goal is to reduce distractions, get more work done, and have a good feeling about what you’ve worked on when you go home in the afternoon.

Thank you for reading this post and if you have anything that you want to see explained in a better way, let me know and I’ll do my best to facilitate this change!