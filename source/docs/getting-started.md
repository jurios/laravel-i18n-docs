---
title: Getting Started
description: Getting started with Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Getting Started {#getting-started}

`Laravel i18n` is a laravel package which provides additional features to the Laravel out of the box localization system.

Those are the main features:

* Translation files generation based on the `locales` defined
* `locale` capabilities to work with specific timezones, currency and number format (decimals, punctuation and so on...)
* Automatically translatable text detection (calls to `__()` method) which will keep your translation files updated. 
    It detects 3th-party package exported translations also.
* Deprecated translations detection
* `Eloquent Models` translation attributes capabilities.
* Optional full customizable and full integrable web editor

#### A note about locales
`locale` represents a language and, at the same time, might represents a currency, number formatting
(decimals, punctuation and so on...) and timezone. Due to that, `laravel i18n` is full compatible with 
specific-regional locales. That means that you can create locales which represents a language 
(`en` would represent English) and/or locales which represents a language from a region/country 
(`en_GB` would represents English from Great Britain). The language code is always written using lowercase and the region,
separated by `_`, is always written in uppercase.


Please, follow the [installation instructions](#) in order to add `laravel-i18n` package in your laravel project!