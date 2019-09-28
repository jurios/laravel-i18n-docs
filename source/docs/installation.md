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

## Install
The installation process will make the following actions:

* Generates the migrations needed by Laravel i18n
* Apply the migrations
* `fallback locale` creation
* Start a `sync` process (this process parses your project files in order to find new translatable texts).
* Add the `i18nServiceProvicer` to the providers in your `config/app.php` file

You can install with:

```
php artisan i18n:install
```

During the process, it will ask for a `locale reference` in order to create your `fallback locale`.

As the sync process has been called, a new file should be generated in `resources/lang/{fallback_locale}.json` 
with all the texts found. As `laravel i18n` only works with JSON files, 
all the PHP translation files found in the `resources/lang` directory has been exported and included in the json.
(3th party exported translations included).

Let's speak more about `locales` and how manage them in the [next section](#).