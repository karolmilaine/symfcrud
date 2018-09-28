# symfcrud
Very-very-very basic CRUD test in Symfony.

## What do I need?
SQLite3, Symfony, Crud

## How to use?
Run `composer install` in the directory, and create a SQLite3 database "crudbase.db" outside of the folder.
SQL code:

    create table crud (
    data varchar(128),
    deleted boolean
    );

## After setup
To try and run the CRUD test, use a PHP server, for example:

    php bin/console server:run
    
If you're using a virtual machine, you have to run:

    php bin/console server:start 0.0.0.0:8000
