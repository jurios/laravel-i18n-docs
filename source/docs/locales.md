---
title: Locales
description: Locales in Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Locales {#getting-started}

A `locale` is a set of parameters that defines the user's language, region and any special variant preferences that the
user wants to see in their user interface (from [Wikipedia](https://en.wikipedia.org/wiki/Locale_(computer_software)).
 
In `Laravel i18n` a locale represents the language and the currency, number formatting (decimals, punctuation 
and so on...) and timezone also.

A locale is identified by its `reference` which follows the format: `[language[_REGION]]` being language the 
language code (based on the [ISO 639-1:2002](https://en.wikipedia.org/wiki/ISO_639-1)) using lowercase letters and the 
optional `region` a region/country code (based on the [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)) 
using uppercase letters.
 
For example, if your `language` is `en` and your region is `GB`, then the `locale reference` would be `en_GB`. 
If your don't define the `region`, then would be `en`.

##### The fallback locale
There is an special locale which is the `fallback locale`. This `locale` will be used as a default `locale` when a text
is not translated or a request is loading a `locale` which doesn't exist.

Apart from that, `laravel i18n` will consider that the texts found as translatable in your project during the `sync` are 
written in the `fallback locale` language. Therefore, all texts found will have empty translations in each `locale`
translation file except in the `fallback locale` where the text will be used as translation.

As the `fallback locale` concept is already used by Laravel, you can modify it through the `fallback_locale` parameter 
in `config/app.php`. You must know that the referenced `locale` must exists, otherwise `laravel i18n` will fail.
However, the `sync` process will check the `fallback locale` existence and if it doesn't exist, it creates the 
`locale` for you. Therefore, is a good idea run a `sync` after modify the `fallback locale` just to be sure.

## Creating locales {#creating-locales}
`Laravel i18n` provides a helper method in order to create `locales`. This method uses `QueryBuilder` under the hood 
thus can be used in `migration files`:

### i18nBuilder::createLocale(array $data);
This methods will create a locale and assign the attributes from the `$data` array. 

The `data` attributes (marked with `*` the mandatory items. Optional default values are indicated):
```
[
    'language'* =>, // Language code
    'region' => null, // Country/Region code
    'description' => null, //Brief description
    'currency_number_decimals' => 2, // Decimals when represent a number using __number() or __price()
    'currency_decimals_punctuation' => '.', // Decimal punctuation when represent a number using __number() or __price()
    'currency_thousands_separator' => '', // Thousands separator when represents a number using __number() or __price() 
    'currency_symbol' => €, // Currency symbol when represents a number using __price()
    'currency_symbol_position' => 'after', // Currency symbol position after the value or before when using __price()
    'carbon_locale' => null, // Carbon locale. If null, language attribute will be used
    'tz' => 'UTC', // Timezone when use DateTime functions (Carbon included)
    'enabled' => true
]
```

Example:
```
use Kodilab\LaravelI18n\Builder\i18nBuilder;  

class CreateLocale extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        i18nBuilder::createLocale([
            'language' => 'en',
            'region' => 'GB',
            'description' => 'English',
            'currency_number_decimals' => 2,
            'currency_decimals_punctuation' => '.',
            'currency_thousands_separator' => ',', 
            'currency_symbol' => '£',
            'currency_symbol_position' => 'before',
            'carbon_locale' => 'en',
            'tz' => 'Europe/London',
            'enabled' => true
        ]);
    }
}
```

## Removing locales {#removing-locales}
`Laravel i18n` provides a helper method in order to remove `locales`. This method uses `QueryBuilder` under the hood 
thus can be used in `migration files`:

### i18nBuilder::removeLocale(string $name);
This methods will remove the locale which name is `$name` if the locale exists and is not the `fallback locale`.

Example:

```
class CreateLocale extends Migration 
{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        i18nBuilder::removeLocale('en_GB');
    }
}
```

## Retrieving locales {#retrieving-locales}

### Locale::getLocale(string $name)
It returns a locale which `name=$name` or `null`.

Example:
```
$locale = Locale::getLocale('en_GB'); //Locale instance
```


### Locale::getFallbackLocale()
Returns the `Locale` instance of the `fallback_locale`:

Example:
```
$fallback = Locale::getFallbackLocale(); //Locale instance
```

### Locale::getLocaleOrFallback(string $name)
The same as `Locale::getLocale(string $name)` but the `fallback locale` is returned if does not exist.

```
$locale = Locale::getLocaleOrFallback('es'); //'es' does not exist, then fallback is returned
```

