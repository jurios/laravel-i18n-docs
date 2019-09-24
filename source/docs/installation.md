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

## Generate the config file (optional) {#generate-the-config-file}
You can generate the `laravel i18n` config file if you want to change some configuration parameters. 
If you want to use default values, this step is not necessary.
```
php artisan i18n:generate config
```

The previous command will generate a config file located in `config/i18n.php`.

## Generate migrations (optional) {#generate-migrations}
The `install` process will generate the migration, but if you want to check the migration before install you can 
generate it manually with the following command:
```
php artisan i18n:generate migration
```

A migration will be added in `databases/migration` directory. 

**Please, don't modify the migration filename in any case and don't modify its content if you don't know what are you doing.**

The migration file will generate the required  table where `locale` information will be persisted. 
By default, and following the laravel convention, that table will be called `locales`. If you want to change the name 
you can do it [through the config file](#generate-the-config-file). You must do it before install it.

## Update the fallback_locale parameter
When you install the package, a `fallback locale` will be created based on the Laravel 
`fallback_locale` parameter in your `config/app.php` file.

As `laravel i18n` will consider the texts found as written in the `fallback locale` language, is a **good practice define
the `fallback_locale` in the `config/app.php` the same locale that used in the texts in your code**. 

```
// config/app.php

<?php
return [
    ...
    'fallback_locale' => 'en',
    
    // You can use a region also in case you are going to create 
    // region-specific locales 
    'fallback_locale' => 'en_GB',
    ...
];
```

## Install
Once everything is ready, you can install the package. Install the package will:

* Generates the migration file if you didn't do it
* Apply the migration previously generated
* Create the `fallback locale`
* Start a `sync` process 

You can install with:

```
php artisan i18n:install
```

If everything works as expected, you will see a new locale on your `locales` table which `language` and `region` corresponds
to the parameter defined in your `fallback locale` setting.

You'll see a new generated file in `resources/lang/{fallback_locale}.json` with the texts found in your project translated
with the same text.

Congratulations, `laravel i18n` is installed!.

Let's speak more about `locales` and how manage them in the [next section](#).