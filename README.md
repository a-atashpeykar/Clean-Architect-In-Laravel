Laravel API Project
=============
Description
-----------
- This is a simple sample project in Product to display implementation of a clean architecture derived from Laravel Beyond The CRUD book.

Run Project Using Docker
---
- make sure you are running docker
- Run `./vendor/bin/sail up -d` to run the dependencies and project.
- Run `./vendor/bin/sail composer install`.
- Run `./vendor/bin/sail artisan storage:link` to generate swagger docs.
- Run `./vendor/bin/sail artisan migrate` to run the dependencies and project.

Stop Containers
---
- Run `./vendor/bin/sail stop` to stop the project.

Test
---
- run `./vendor/bin/sail artisan test` to run all the tests

Project Structure
-----------------
- The project is structured in a way that it is easy to understand and navigate through.
- The project uses `src/Domain` folder to store all the domains.
- The project uses `src/Support` folder to store all the support codes, like helper functions, classes and packages.
- The project uses `src/App` folder to store all the application code.
    - we have `src/App/Admin` contains all the `actions, requests` for the Admin Panel (which uses blade).
        - `actions`: You can find business logic here.
        - `requests`: You can find data validation and maybe Authorization logic over here.
        - `resources`: we use laravel resource collections in order to customize our api structure.
        - `middlwares`: Define your middlewares here.
    - we have `src/App/Api` contains all the `actions, requests` for the API.
    - we have `src/App/Console` contains all the code for Console.

```tree-extended
📁 bootstrap
📁 config
📁 ...
├───📁src
│   ├───📁App/
│   │   ├───📁Admin/
│   │   │   └───📁Product/
│   │   │        ├───📁Actions/
│   │   │        ├───📁Middlewares/
│   │   │        ├───📁Requests/
│   │   │        └───📁Resources/
│   │   │
│   │   │───📁Api/
│   │   │   └───📁Product/
│   │   │        ├───📁Actions/
│   │   │        ├───📁Middlewares/
│   │   │        ├───📁Requests/
│   │   │        └───📁Resources/
│   │   │
│   │   │───📁Console/
│   │   │───📁Exceptions/
│   │   │───📁Middlewares/
│   │   └───📁Providers/
│   │
│   ├───📁Domain/
│   │   │───📁Product/
│   │   │   ├───📁Collections/
│   │   │   ├───📁DataTransferObjects/
│   │   │   ├───📁Enums/
│   │   │   ├───📁Models/
│   │   │   ├───📁Observers/
│   │   │   ├───📁QueryBuilders/
│   │   │   ├───📁Repositories/
│   │   │   ├───📁Events/
│   │   │   ├───📁Listeners/
│   │   │   ├───📁Jobs/
│   │   │   └───📁Services/
│   │   │
│   │   │───📁User/
│   │   │───📁.../
│   │   └───📁Auth/
│   │
│   ├───📁Infrastructure/
│   │   └───📁Mail/
│   │
│   └───📁Support/
│       │───📁Packages/
│       │───📄helpers.php
│       │───📄RouteName.php
│       │───📄... .php
│
├───📄.gitignore
└───📄README.md
└───📄...
```

Database
--------
- The project uses MySQL for database.

Cache
-----
- The project uses Redis for caching.
