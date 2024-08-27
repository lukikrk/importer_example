# 1. Modular Monolith

Date: 2024-08-27

___

## Status

Accepted

___

## Context

Monolith is not a good solution for our project and at the beginning we don't want to finish up with many microservices. 
We need to divide application into independent modules. Then we could easily separate them as microservices when needed.

___

## Decision

We will created separate directory for every module in /src. Every module will have its own architecture and structure.

___

## Consequences

Module independence needs to be preserved. We need to determine only one point of communication between modules and 
avoid database relationships between modules.
