# 3. Framework Agnostic Approach

Date: 2024-08-27

___

## Status

Accepted

___

## Context

We chose Symfony as our framework, but we want to keep it separated from the rest of the application. We want to be
fully opened for the situation when the framework will be replaced to the other one.

___

## Decision

First of all we have to divide a special directory / layer, where we will put the code related with framework and other 
third party libraries. We will call this `Infrastructure` layer. This layer has to be visible in every module separated
in the application.

Another thing is preparing our internal interfaces for services which we want to use from our framework. Let's see
that approach basing on Serializer example:

<br>
Our internal interface. Could be stored outside `Infrastructure` layer.

```php
interface Serializer
{
    /**
     * @param array<string, mixed> $context
     */
    public function serialize(mixed $data, Format $format = Format::json, array $context = []): string;
}
```
<br>
Specific implementation, also called `Wrapper`, of our internal Serializer interface. In this case we're using Symfony 
Serializer

```php
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

final readonly class Serializer implements SerializerInterface
{
    public function __construct(
        private SymfonySerializerInterface $serializer,
    ) {
    }

    /**
     * @param array<string, mixed> $context
     */
    public function serialize(mixed $data, Format $format = Format::json, array $context = []): string
    {
        return $this->serializer->serialize($data, $format->value, $context);
    }
}
```

Now, when we want to use Serializer in any part of the system, we're using our internal interface as a constructor
argument.

___

## Consequences

We will end up with many interfaces and classes which are only wrappers for services defined in our framework. We will
also have to remember to put `Infrastructure` directory / layer in every newly created module. `Infrastructure` layer
cannot be used in any part of the system except framework configuration files and the `Infrastructure` itself. Finally,
we can use framework services only inside the `Infrastructure` layer.
