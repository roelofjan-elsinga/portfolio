---
description: 'API gateways are great for development teams, because they expose the data you need for all kinds of different purposes in a central location. So why not create an API gateway with GraphQL and use it to bring all your REST endpoints in 1 place?'
post_date: '2020-08-26'
is_published: true
is_scheduled: false
update_date: '2020-08-26 12:17:42'
linkedin_post: 'With a growing list of REST API endpoints from different services, the need of having an API gateway starts to grow as well. This makes it easier for a development team to build products. This is why I''ve looked at a few different API gateways for REST resources, but ended up using GraphQL for this. I already had experience with building a GraphQL server in PHP with Laravel, but the performance wasn''t quite there and made caching very difficult. Because of this, I opted to use Golang to build my GraphQL server. It''s much faster and caching fields is easier to do. I''ve experimented centralizing REST API endpoints using GraphQL and it''s actually not as difficult as I expected. Read more about this process with code examples.'
twitter_post: ''
---
![Golang with GraphQL](/images/articles/golang-with-graphql.png)
# GraphQL: Centralize existing REST API endpoints for easier development
API gateways are great for development teams because they expose the data you need for all kinds of different purposes in a central location. There are a few great REST API gateways out there, like [KrakenD](https://www.krakend.io/), but what if you wanted to go in a different direction and choose GraphQL for your API infrastructure? Well, that works out perfectly, as it's one of the goals of GraphQL: Abstracting many different services into a single place and allowing the developers very fine-grained control over the data they need.

In this post, we're going to look over a GraphQL implementation, which keeps the previous sentence in mind: Abstracting existing REST API Endpoints into a fast GraphQL server. To build the GraphQL server, we're going to use Golang: It's fast, it's memory efficient, and provides just enough tools, but not too many. The GraphQL package we'll use is [github.com/graphql-go/graphql](https://github.com/graphql-go/graphql). This package is very closely aligned with the JavaScript implementation [graphql-js](https://github.com/graphql/graphql-js). This makes it a perfect candidate because you'll be able to follow JavaScript tutorials and be able to port this to Go.

## The entry point
To show how you can abstract an existing REST API Endpoint in GraphQL, we're going to need an example project. I've created an example project at [github.com/roelofjan-elsinga/graphql-rest-abstraction](https://github.com/roelofjan-elsinga/graphql-rest-abstraction). You can use this to follow along in this post, as I will go over different parts of the GraphQL server and explain what's going on.

The entry point of our GraphQL server is [main.go](https://github.com/roelofjan-elsinga/graphql-rest-abstraction/blob/master/main.go). Here we specify two resources in our GraphQL server: users and user. 

<script src="https://gist.github.com/roelofjan-elsinga/36cd9a32bfe45cec0b26cb8d485f3a65.js"></script>

We intend to use a dummy [REST API service](https://jsonplaceholder.typicode.com/) to fetch JSON data for all users and also a single user. The "users" resources will be used to fetch all users at [https://jsonplaceholder.typicode.com/users](https://jsonplaceholder.typicode.com/users), while the "user" resource will be used to fetch a single user by ID from [https://jsonplaceholder.typicode.com/users/1](https://jsonplaceholder.typicode.com/users/1) or any other user available to us.

## Fetching all users
Now that we have a REST API we can use, we can create a resource to be able to fetch this data through a GraphQL resource. You can find this resource in [queries/users.go](https://github.com/roelofjan-elsinga/graphql-rest-abstraction/blob/master/queries/users.go): 

<script src="https://gist.github.com/roelofjan-elsinga/6c9003ccbc75a9c5c7b37a243b9a5de3.js"></script>

Here you'll find a method "fetchUsers", where we call the REST API endpoint and convert the data into a Go struct, which is located in [models/user.go](https://github.com/roelofjan-elsinga/graphql-rest-abstraction/blob/master/models/user.go). Our field "Users", will return the User slice from "fetchUsers". 

In the "users" field declaration we specified the type we expect to receive from this GraphQL resource: graphql.NewList(userObject). We told GraphQL we're returning multiple users. The userObject is one of our GraphQL resources and you can [view it in full here](https://github.com/roelofjan-elsinga/graphql-rest-abstraction/blob/master/queries/users.go#L134). It's too much code to inline here, so I've linked it up to the exact line you need in the source code. The userObject itself also contains fields and nested objects ([address](https://github.com/roelofjan-elsinga/graphql-rest-abstraction/blob/master/queries/users.go#L77) and [company](https://github.com/roelofjan-elsinga/graphql-rest-abstraction/blob/master/queries/users.go#L13)). These nested objects are linked to the exact line as well. As you can see, objects can be nested within nested objects.

Now that we've specified all fields and we can retrieve data from the REST API, it's time to give our new GraphQL resource a try. Follow the [setup steps](https://github.com/roelofjan-elsinga/graphql-rest-abstraction#how-to-launch-the-server-for-development) (there are only 4, and they're easy) and try to execute the following GraphQL query:

<script src="https://gist.github.com/roelofjan-elsinga/1d59d60fc250fc07cd462556dacf6d18.js"></script>

You should now see all of your users appear in the response, but only the fields we've specified in our query:

<script src="https://gist.github.com/roelofjan-elsinga/0917f2c7880a5757e9cfb900c2d01378.js"></script>

I've redacted the rest of the users to not make this snippet too long. As you can see, only the requested fields we're returned, as we expect from GraphQL.

## Fetching a single user
Now that we've seen we can retrieve all users, we'll also go into retrieving a single user. The userObject is the same as we've looked at before, so I won't go over that again, but the field declaration for "user" has changed a little bit compared to "users" and so has the query. Let's look a the field declaration first. It's located at [queries/user.go](https://github.com/roelofjan-elsinga/graphql-rest-abstraction/blob/master/queries/user.go) and looks like this:

<script src="https://gist.github.com/roelofjan-elsinga/085f23bc3e9255c06f6d7aa106087f31.js"></script>

There are three main differences:

1. The type we expect is now userObject instead of graphql.NewList(userObject). We only expect 1 user.
2. Our field declaration has an Args key. We use this to tell the server that we need a user ID for this query and that it cannot be empty: graphql.NewNonNull(graphql.Int)
3. We pass the user ID to the fetchSingleUser method and append it to the REST endpoint

I mentioned that the GraphQL query now has changed as well, so let's look at what it looks like:

<script src="https://gist.github.com/roelofjan-elsinga/6de71af5f280ba0c9df539a665d77f13.js"></script>

This query needs a user_id to be submitted (of type Int!), so we can do that using {"user_id": 1}, or whichever user_id you want to retrieve from the API endpoint.

This query results in the following response:

<script src="https://gist.github.com/roelofjan-elsinga/df938bf1d98c0095afca0cdbb1ea3398.js"></script>

As you can see, we now only have the user with ID of 1.

## Conclusion
This guide has shown you how to can create an API Gateway using GraphQL, to create an abstraction layer in front of your existing REST API endpoints. There are a few things missing, like Authentication, a DataLoader for efficient data fetching, but this is a simple example to show how this works. Using this method, you can piece by piece expand your API Gateway in GraphQL and Go to cover your entire list of REST API endpoints, without disturbing your existing customers. Your existing customers will still be able to fetch data from your REST API, but over time you can help them migrate to your easy-to-use GraphQL API Gateway.