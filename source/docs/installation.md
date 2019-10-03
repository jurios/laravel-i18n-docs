---
title: Installation
description: Install Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Installation {#installation}

## Requirements {#requirements}
TODO

## Add dependencies

`Laravel i18n` is published as a `laravel package` and must be installed using `composer`.

```
composer require kodilab/laravel-i18n
```

## Publish migrations
`Laravel i18n` will use a database table for persist the `locales`. In order to create it, a migration file must be
created.

```
php artisan i18n:migrations
```

A group of migration files will be added in your `database/migrations` directory. Those migrations will create 
the table and the [`fallback locale`](#).

By convention, the locale table name is `locales`. You can change the name through the 
[laravel-i18n configuration file](#).

The `fallback locale` will be created based on the `fallback_locale` parameter in your `config/app.php` file. If you want
to modify the `fallback_locale` attributes you can do it modifying the migration file called 
`*_create_i18n_fallback_locale.php`. 
 
You can change the `locales` table name through the [laravel-i18n configuration file](#).


## Install
The install process will perform the following tasks:

* Apply the migrations
* Start a `sync` process (this process parses your project files in order to find new translatable texts).
* Add the `i18nServiceProvicer` to the providers in your `config/app.php` file

You can install with:

```
php artisan i18n:install
```

As the sync process has been called, a new file should be generated in `resources/lang/{fallback_locale}.json` 
with all the texts found. As `laravel i18n` only works with JSON files, 
all the PHP translation files found in the `resources/lang` directory has been exported and included in the json.
(3th party exported translations included).

Let's speak more about `locales` and how manage them in the [next section](#).