# Importer example

![image](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![image](https://img.shields.io/badge/Symfony-000000?style=for-the-badge&logo=Symfony&logoColor=white)
![image](https://img.shields.io/badge/Docker-2CA5E0?style=for-the-badge&logo=docker&logoColor=white)

This repository contains source code of the heart of our application. This is the place where the biggest part of
business logic takes place and the core ideas are kept. With this service front end will integrate most often and
here will be the biggest network traffic. This application is written with Modular Monolith approach so in any time we can
separate modules into microservices. The application is written in Symfony framework, but we try to be as
framework-agnostic as possible. In case you want to find some business problems solutions or just want to understand
how the whole application is working, you probably should start from this place.

## Getting started

1. Clone repository from `git@gitlab.yetiforce.eu:yetiforce-2.0/core-api.git`
2. Install Makefile - https://makefiletutorial.com/
3. Install Docker - https://docs.docker.com/
4. In the console get into the main project directory and type `make`
5. Wait until the installation process is done
6. Voilà!
7. After the first installation use `make up` and `make stop` to turn on and turn off the project

## Framework - Integrations - Libraries

- Symfony - https://symfony.com/doc/current/index.html
- PHPUnit -https://docs.phpunit.de/en/10.5/

## Project structure and most important directories

- `/adr` - place for Architectural Decision Record files, where we explain some decisions we made during development
- `/app` - main workspace of the application and WORKDIR of Docker environment
- `/docker` - Docker environment configuration
- `/app/config` - config files related with framework
- `/app/src` - source code of the application
- `/app/tests` - all tests (Unit, Integration, Functional) for written code

## Useful commands

- `make` - alias for `make application`, it does the first installation of the application
- `make analyse` - starts static analysis / lints for the source code
- `make bash` - takes you into the console of the main application container
- `make cli-docs` - shows all available cli commands and their descriptions
- `make down` - shortcut for `docker compose down` - stops running containers and also discards them and the networks
  they were utilizing
- `make fix` - runs PHP Code Sniffer fixing mode, so all the code problem will be fixed if possible
- `make logs` - show main application container logs in the following mode
- `make root` - similar to `make bash`, but `root` is the initial user. Be careful!
  `🕷 With great power comes great responsibility! 🕷`
- `make stop` - stops all containers
- `make test` - runs all tests for the application
- `make up` - turns on the project, shortcut for `docker compose up -d`
- `make xon` - turns on xDebug debugging mode
- `make xoff` - turns off xDebug debugging mode

## Environment variables

All the environment variables should be declared in .env.dist file and propagate to .env.

Here is the list of available environment variables with their descriptions:

| Name                     | Description                                                                                                                                                              | Tags                 |
|--------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------|
| APP_MODE                 | Current application mode. `dev` - your local env, `prod` - any not local env, `test` - pipelines.                                                                        |                      |
| HTTP_PORT                | Port where the main application will be available via http protocol.                                                                                                     | `#http`              |
| PHP_IDE_CONFIG           | Required by PHPStorm for xDebug integration.                  <br/>                                                                                                      | `#phpStorm` `#debug` |

## Static analysis tools

- PHP Code Sniffer
- PHPStan - https://phpstan.org/user-guide/getting-started
- PHP Mess Detector - https://phpmd.org/documentation/index.html
- Psalm - https://psalm.dev/docs/

## Assignee

If you have any questions or problems with this service, please contact this people:

- Łukasz Krawczyk `luki.krk@gmail.com`
