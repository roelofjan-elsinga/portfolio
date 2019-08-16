# Building an automatic API Stub generator for PHP
The idea is to build a packages to analyses all API calls you make to external services and record these URL's and/or request headers and save these in a mock file along with the received response. This allows you to run the tests with actual calls to the API only once and return stubbed values in subsequent API calls.

I ran into this problem when moving offices and getting a new IP address. The IP address was of significance, because the API token could only be used from certain IP addresses. Then another layer was added when I started to enable a VPN connection on my laptop by default, this also invalidated the API calls. 

Since I'm testing the handling of data in some of the classes, I still need to make use of these API results, but the added external API call did not benefit the reliability of the acceptance tests, which is the point of writing tests.