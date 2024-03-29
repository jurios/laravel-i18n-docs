---
title: Getting Started
description: Getting started with Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Getting Started {#getting-started}

`Laravel i18n` is a laravel package which provides additional features to the Laravel out of the box localization system.

Those are the main features:

* Automatically translation files generation/updating based on the calls to the translation method (`__()`) found
in your project (included 3th party published translations)
* Deprecated translations detection
* `locale` capabilities to work with specific timezones, currency and number format (decimals, punctuation and so on...)
* `Eloquent Models` translation attributes capabilities.
* Translation API allowing update translations 

#### A note about locales
`locale` represents a language and, might represents a currency, number formatting
(decimals, punctuation and so on...) and timezone, also. Due to that, `laravel i18n` is full compatible with 
specific-regional locales. Therefore a locale contains three important attributes:

* language: ISO 639 language code
* region: ISO 3166 country code (optional)
* reference: Autogenerated value with the form `language[_REGION]`

That means that you can work with locales which represents a language (`en` would represent English) and/or 
locales which represents a language from a region/country (`en_GB` would represents English from Great Britain). 

Please, follow the [installation instructions](/docs/installation) in order to add `laravel-i18n` package in your laravel project!