# 5. Layered Architecture

Date: 2024-08-27

___

## Status

Accepted

___

## Context

As previously mentioned, we want to be framework-agnostic and keep it separated from the application. We also want to
organise our modules a little bit to keep business logic, application mechanisms and framework / libraries stuff fully
separated. In perfect world business does not know anything about application and the application does not know
anything about framework and other third party libraries we are using.

___

## Decision

![image](https://cdn.hibit.dev/images/posts/2021/ddd_layers.png?fmt=webp)

Let's divide each module into three layers:

1. Domain - place for business logic and rules, entities and interfaces / services for domain objects.
2. Application - place for application mechanisms just like commands, queries and it's handlers.
3. Infrastructure - Space for everything connected with our framework and other external libraries.

Communication between layers is strict and one directional. So:

- Domain cannot read from Application and Infrastructure
- Application can read from Domain but cannot read from Infrastructure
- Infrastructure can read from Application and sometimes Domain

Communication between layers should takes place like in `Ports and Adapters` approach, where:

- port is an interface
- adapter is a specific implementation


<br>
Example port:

```php
interface FileManager
{
    public function write(string $path, mixed $data): void;
}
```

<br>
Example adapter (Local Storage implementation):

```php
final readonly class FileManager implements FileManagerInterface
{
    public function write(string $path, mixed $data): void
    {
        file_put_contents($path, $data);
    }
}
```

___

## Consequences

We have to be careful to not break the communication rules between layers. We will end up with a lot of interfaces.
Finally, we will have to think in which layer specific class or interface should be placed and sometimes it can be hard 
to say.
