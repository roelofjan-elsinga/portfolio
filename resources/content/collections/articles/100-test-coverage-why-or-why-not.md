---
update_date: '2019-11-02 15:26:40'
description: '100% test coverage: Why or why not? But first, what does 100% test coverage mean? Let''s explore the topic in this post and I''ll tell you my thoughts about it afterwards.'
is_scheduled: false
is_published: true
post_date: '2019-11-06'
url: 100-test-coverage-why-or-why-not
---
!["Unpeeling a banana"](/images/articles/unpeeling-a-banana.jpeg)
<span class="caption">Photo by Carlos Alberto Gómez Iñiguez</span>

# 100% test coverage: Why or why not?
The magical moment is finally there, you've written the tests and the screen says "100% coverage". You're happy, all tests pass and your code will never be bad again. But is that really what 100% test coverage means? Let's explore the topic together and I'll tell you my thoughts about "the magic 100% test coverage" milestone. 

## What does it mean to have 100% test coverage?
Great, you've got 100% test coverage, but what does it actually mean? 100% test coverage simply means you've written a sufficient amount of tests to cover every line of code in your application. That's it, nothing more, nothing less. If you've structured your tests correctly, this would theoretically mean you can predict what some input would do to get some output. Theoretically... It doesn't mean you've actually written a test to verify the expected output is actually returned. It could just mean you've written a test for a different part of the application and a line was executed in the process.

So now that I've outlined what I mean with 100% test coverage, let's look at some reasons why you would want to achieve the magical 100% test coverage and some reasons why it might be a huge waste of time.

## Why it's a good idea to get 100% test coverage
There are several reasons why achieving 100% code coverage is a good idea, given that you write a test to verify specific use cases. This means that you purposefully write tests to verify certain scenarios are dealt with in the way you intend them to, not just tests that execute your code in the background. So for the next part of the blog post, you should keep in mind that the tests are written to thoroughly test your code.

#### You can find unused code
While writing tests and making sure you get to that 100%, you will most likely find code that hasn't been executed by any of your previous tests. This could mean that you need to write another test to verify if a specific use case is dealt with properly by your code, or it could mean that the code is not used anymore. If the code is not used (anymore) you can remove it. If that's the case, writing tests has already had the added benefit of finding dead code and cleaning up your codebase in general. 

#### You can find broken code
Another scenario you might encounter is that you find code that has silently been failing up until now and you've just never noticed it before. If you write a test with a certain input and you're expecting a certain output, it can't result in any other value without a good reason. You might discover that you need to write an additional test to cover the new scenario or you've found broken code. When you find broken code, the test has already proven its value. The test is there to verify your code works and if it finds an error, it has served its purpose.

#### You won't break your code as easily while refactoring
So imagine that you've gotten to the 100% coverage after fixing all errors and removing all unused code, making sure to cover most if not all scenarios your code might deal with, pretty satisfying feeling right? Well now comes one of my favorite benefits of having 100% test coverage: refactoring old code and writing new features. When you have the tests, you theoretically know what output you'll get for a certain input. This is a very powerful concept because it means that you can refactor your code in any way you can imagine and get instant feedback on the refactor. You will instantly find out if you broke the code or if everything is still working. The tests expect a certain output for the given input and as soon as this changes, it will let you know. Of course, some unit tests might break, because they rely on specific implementations of your code, but the integration tests won't break as they don't really care how you solve the problem, as long as it gets the expected result. 

#### You can trust your process
And the last benefit that I can think of is having a sense of security and confidence about the reliability of the code. The confidence in the system is only as great as the level of trust you put into the tests. So if you write tests, but don't really trust the result, it's probably time to write more and/or better tests. You need to be able to rely on your tests, as these are a representation of the proper functioning of your application to the outside world. If you trust the results of the tests, you'll be able to ship new features much faster. If you don't trust the results of your tests, you won't write the tests in the long run, as they are an obstacle to getting to what you need: a "working" system. I deliberately wrote that in parentheses, because there is no way to verify if the code you wrote actually works. Sure, the first time you can test it by hand, but 10 features later you won't do this anymore. Then if any new features break this script, you won't find out until someone brings it to your attention.

## Why achieving 100% test coverage might be a waste of time
As I mentioned in the introduction about why it's a good idea to achieve 100% test coverage, you need to write tests with the explicit purpose of testing a specific piece of code. This is where a lot of people will, rightfully in some cases, tell you that test coverage doesn't really mean anything. In this section I break down what that means and why solely going for 100% coverage, for the sake of going for 100% coverage is a bad idea.

#### Coverage reports are easy to trick
As I mentioned at the beginning of this post, 100% code coverage means that 100% of your lines of code have been executed while running your tests. That's great, but it also doesn't mean anything. If some code gets executed, but you don't have tests in place to verify if what is being executed actually does what it's supposed to, you are effectively tricking yourself. You will believe that just because your tests execute all lines of code it actually does what you intend it to. This doesn't have to be the case in any way. If you're only writing integration tests you will cover a lot of code, but the individual methods won't be tested. 

This means that you need to write unit tests to verify if a single method returns exactly what you intend it to. If you have this in place, only then you can trust that the code coverage actually means your code is working as it should.

#### 100% coverage doesn't mean everything is working as it should
As I mentioned in the last paragraph, just because you executed every line of code, doesn't mean you actually verified it's working as it should. This means that there could be any number of unexpected errors hiding in plain sight. For example, you've written tests for a controller and verified that all methods on the controller work as intended. That's a great start, but you're not there yet. What if the middleware blocks the user from ever reaching the controller? Well, you haven't tested for this aspect. So your tests might return green, but your application doesn't work as intended. This is a basic example, but you get my point: multiple ways lead to a certain result and you need to verify all of these ways function as intended.

#### Tests can be misleading
Tests can be misleading. This is especially true if you write tests after you've already written the code. You might find a method that hasn't been tested properly, so you write a test for it. Great start! But what happens if you assert a certain result is returned when this result is a bug, to begin with? An example: your input is 1 and your expected output is 3. So you write a test that verifies 1 will return 3 and it does. That's green, the code works. Yes, it seems that way, but if the method returns 1 + 1, then your assertion is incorrect, to begin with. This is a very basic example, but it's good to pause and think about what it means. This means that you've written a test that makes sure you never find the bug automatically until a customer stumbles upon it. The process of writing tests is to make sure you understand your code and you shape it to your will. The tests are your primary source of truth, so make sure you can rely on the results of your tests.

## There is no silver bullet
Writing tests is a great way to write better software, but it's not a silver bullet. We're human (right?) and humans make mistakes. This is why writing tests for everything is not enough, but it's a great base to build from. You need insightful error reporting and you need to deal with errors properly. You need to let the right people know when something is breaking and you need to make it very simple to fix any mistakes. 

I promised you I would give my opinion on 100% test coverage, so I will. 100% test coverage for the sake of getting 100% test coverage is a huge waste of time because it has no added benefit for you, your stakeholders, or your customers. It gives you a false sense of security and will only cost you valuable time. 100% test coverage as a tool, however, is great. It forces you to think about how you structure your code, how you can write it as simple as possible and it helps you eliminate unused scripts. 

So is 100% test coverage worth it? Well, that depends on the situation. Often it has a lot of benefits, but again, it's not the ultimate solution to write great software. 

What are your thoughts about 100% test coverage? Have you ever actively chosen to not go after the 100% coverage? Why? Thank you for reading this far. Let me know on [Twitter](https://twitter.com/RJElsinga) what you think about this topic.