---
title: Locales
description: Locales in Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Locales {#getting-started}

A `locale` is a set of parameters that defines the user's language, region and any special variant preferences that the
user wants to see in their user interface.
 
In Laravel i18n a `locale` might contains language, currency symbol, number formatting (decimals, punctuation 
and so on...) and timezone information.

The `locales` are persisted on database in the `locales` table which has been created during the `install` process.

When you want to use a `locale` on your project, you must create it first.

## Locale identification
A locale is identified by its `reference` which follows the format: `language[_TERRITORY]` being language the 
language code (based on the [ISO 639-1:2002](https://en.wikipedia.org/wiki/ISO_639-1)) using lowercase letters and the 
optional `region` a region/country code (based on the [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)) 
using uppercase letters.

However, `reference` is not a regular attribute. It's generated (is an [accessor](#)) based on the `language` and `region`
attribute. 
 
For example, if your `$locale->language = en` and `$locale->region = GB`, then the `$locale->reference === 'en_GB'`. 
If your don't define the `region`, then `$locale->reference === 'en'`.

#### The fallback locale
There is an special locale which is the `fallback locale`. This `locale` will be used as a default `locale` when a text
is not translated or during the request a `locale` doesn't exist.

At least a `fallback locale` must exists. You won't be able to remove a `fallback locale` using the methods that
Laravel i18n provides for deleting locales. However, you can create a new `fallback locale` (which remove the `fallback`
label to the previous one) and then, remove the previous `locale`.

## Locale attributes
A `locale` is an `Eloquen model` which has the following attributes (marked with `*` the mandatory items. 
Default values are indicated):

```(php)
[
    *'language' =>, // Language code
    'region' => null, // Country/Region code
    'name' => null, // Locale name. If null, then locale reference is used
    'fallback' => false, //Indicates whether the locale is the fallback locale
    'laravel_locale' => null, // Value set in the Laravel locale setting
    'decimals' => 2, // Decimals when represent a number using __number() or __price()
    'decimals_punctuation' => '.', // Decimal punctuation when represent a number using __number() or __price()
    'thousands_separator' => '', // Thousands separator when represents a number using __number() or __price() 
    'currency_symbol' => €, // Currency symbol when represents a number using __price()
    'currency_symbol_position' => 'after', // Currency symbol position after the value or before when using __price()
    'carbon_locale' => null, // Carbon locale. If null, language attribute will be used
    'tz' => 'UTC', // Timezone when use DateTime functions (Carbon included)
]
```
A few notes about those attributes:

* **laravel_locale**: Laravel i18n uses the out of the box Laravel localization system under the hood. Due to that, when
a `locale` is loaded to be used in a request, the `locale parameter` in the Laravel configuration must be changed to 
set the chosen locale. By default, the `reference` value is set. However, you can define what value should be set in 
the Laravel setting through the `laravel_locale` attribute.

## Creating and removing a locale
You can create a `Locale` using the `Eloquent Model` method for creating. What's more, Laravel i18n provides an artisan
`command` for creating and removing locales quickly:

```
php artisan make:locale
            {--reference= : Locale reference}
            {--name= : Locale name}
            {--fallback= : (true|false) Set the locale as fallback locale}
            {--laravel-locale= : Laravel locale setting value}
            {--carbon-locale= : Laravel locale setting value}
            {--tz= : Locale timezone}
            {--decimals= : Decimals when show float values}
            {--decimals-punctuation= : Decimals when show localized float values}
            {--thousands-separator= : Thousands separator when show localized values}
            {--currency-symbol= : Currency symbol when show localized currency value}
            {--currency_symbol_position= : Currency symbol position when show a localized currency value (after|before)}'
```

## Removing a locale
```
php artisan locale:remove reference
```

## Retrieving locales {#retrieving-locales}
The `Locale` model contains some static helper methods to retrieve `locales`:

```(php)
    /**
     * Get the fallback locale. If it does not exits, then an exception is sent.
     *
     * @return Locale
     * @throws MissingFallbackLocaleException
     */
    public static function getFallbackLocale()

    /**
     * Returns a locale by reference. If it does not exist, then null is returned.
     *
     * @param string $reference
     * @return mixed
     */
    public static function getLocale(string $reference)
    
    /**
     * Returns a locale by reference. If it does not exist, then fallback locale is returned
     *
     * @param string $reference
     * @return Locale
     * @throws MissingFallbackLocaleException
     */
    public static function getLocaleOrFallback(string $reference)
```

## Locale factory {#locale-factory}
If you need a `locale factory`, you can use the following `artisan command` in order to generate it:

```
php artisan locale:factory
```

A new factory will be generated in `database/factories/LocaleFactory.php`.