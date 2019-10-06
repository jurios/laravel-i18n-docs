---
title: Locales
description: Locales in Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Locales {#getting-started}

A `locale` is a set of parameters that defines the user's language, region and any special variant preferences that the
user wants to see in their user interface.
 
In Laravel i18n a `locale` might contains language, currency symbol, number formatting (decimals, punctuation ...) 
and timezone information.

The `locales` are persisted on database in the `locales` table which has been created during the `install` process.

You can create as `locale` as your project needs.

## Locale identification {#locale-identification}
A locale is identified by its `reference` attribute which follows the format: `language[_REGION]` being language the 
language code (based on the [ISO 639-1:2002](https://en.wikipedia.org/wiki/ISO_639-1)) using lowercase letters and the 
optional `region` a region/country code (based on the [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)) 
using uppercase letters.

However, `reference` is not a regular attribute. It's generated 
(is an [accessor](https://laravel.com/docs/6.x/eloquent-mutators#accessors-and-mutators)) based on the `language` 
and `region` attribute. So you only have to handle `language` and `region` attributes.
 
For example, if your `$locale->language = en` and `$locale->region = GB`, then the `$locale->reference === 'en_GB'`. 
If your don't define the `region`, then `$locale->reference === 'en'`.

## The fallback locale {#the-fallback-locale}
There is an special locale which is the `fallback locale`. This `locale` will be used as a default `locale` when a text
is not translated or during the request a `locale` doesn't exist.

At least a `fallback locale` must exists. You won't be able to remove a `fallback locale` using the methods that
Laravel i18n provides for deleting locales. However, you can create a new `fallback locale` (which remove the `fallback`
label to the previous one) and then, remove the previous `locale`.

## Locale attributes {#locale-attributes}
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
a `locale` is going to be used in a request, the `locale` parameter in the Laravel configuration must be changed to 
set the chosen locale. The value set in that parameter would be the `laravel_locale` attirubte. In case it is null, 
then the `reference` value is set.

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

For remove a `locale` you can do it with the following `artisan command`:

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

## Locales and requests {#locales-and-requests}
`Laravel i18n` uses the Laravel out of the box localization system under the hood. That means that to set which `locale`
is going to be used during the request it must be done [through the `locale` and `fallback_locale` parameters in the 
`config/app.php` file](https://laravel.com/docs/6.x/localization#configuring-the-locale). 

However instead of dealing with it, `laravel i18n` provides a service which set that parameters based on the `locale`
you provide:  

If you want to change the locale during a request, you can do it just using the service:

```(php) 
$locale = Locale::getLocale('es');

app('i18n')->setLocale($locale);

//Or using the facade
use Kodilab\LaravelI18n\Facades\i18n
i18n::setLocale($locale)
```

### Using a middleware
The best way to handle the locale used in a `request` is through a `middleware` which set the locale based on the
request. You can create your own `middleware` or extending the `SetLocale` middleware provided in `laravel i18n`.

If you extends the `SetLocale` middleware, you can overwrite the `locale()` method to change the locale used. 
This method should return a `locale` instance. 

By default, the `timezone` set is the defined by the `locale`. However, you can extend `timezone(Locale $locale)` 
method if you want to customize the `timezone`. The `locale` argument is the `locale` returned by `locale()`. 

You have access to the request with `$this->request` in both methods.   

In the following example, the `setLocale` middleware is extended in order to set the `locale` based in the `user preferences`.
```
use Kodilab\LaravelI18n\Middleware\SetLocale;

class newMiddleware extends SetLocale
{
    /*
    * The locale to be set during the request
    */
    protected function locale()
    {
        return Auth::user()->locale;
    }

    protected function timezone(Locale $locale)
    {
        return Auth::user()->tz;
    }
}
```

Don't forget to [register the middleware](https://laravel.com/docs/6.x/middleware#registering-middleware) 
in order to be used.