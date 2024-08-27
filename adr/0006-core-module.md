# 8. Core Module

Date: 2024-08-27

___

## Status

Accepted

___

## Context

Having separated modules in the system, there will always be some parts of code / services common for each module.
We don't want to break DRY rule and copy / paste those things into each module.

___

## Decision

We decided to created module called `Core`, where the common parts of the system will be stored. An example of those
parts could be:

- CQRS services (Commands, Handlers, Buses, etc.)

All the stuff from this module can be used in any part of the other modules. So this is an exception from Module Facade
approach. But remember, every peace of code placed in this module should be generic, reusable and free from domain
connection.

___

## Consequences

Having `Core` module there's a risk that it will become a kind of trash for these parts of code that cannot be 
classified to any existing module. Putting anything in the `Core` space we have to remember that it should be
generic, reusable and not connected with domain and business logic at all.

This approach does not solve the problem at all. What should we do when some module will be taken out as a microservice?
Then we should also put content of `Core` module in it and again break the DRY principle. In the future we should
consider creating separate repository for `Core` module and loading it via composer to vendor of the microservice 
that needs it.
