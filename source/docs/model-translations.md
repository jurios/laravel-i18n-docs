---
title: Model translations
description: Model attributes translations in Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Model translations {#model-translations}
`Laravel i18n` provides a translatable model attributes solution. What's more it provides helpers methods and commands
which makes the process easy, fast and maintainable.

## Design
When you want to make translatable some model attributes, a new table must be created in your database in order
to persist the translations. By convention, that table name will be the same name as the `model` table adding the suffix
`_translations`.

As we use a new table to persist that attributes, the columns in the `model` table are no necessary and can be deleted
as they will be ignored.

Following the steps explained in the next sections, you'll be able to retrieve the translated attribute as it was 
part of the `model`.

## Translatable attribute

### Creating the migration
`laravel i18n` provides a wizard `command` to create the translation table easily. In order to do that, just start the
wizard:

```
php artisan i18n:generate translatable
```

It will ask for which `model` in your `App` namespace want to create translatable attributes. Once you choose an option
a `migration` file will be created in `database/migrations` folder.

This migration is ready to be applied. You just need to add the columns (attributes) which will be translatable.
Open the migration and add them.

So, for example, let's say that I have the model `Car` which I want to make `description` attribute translatable.
After call to `php artisan i18n:generate translatable`, the migration 
`0000_00_00_000000_create_car_translations_table.php` is generated and this will added just after the `TODO` comment:

```
    ....
    //TODO: You should add the model translatable attributes here.
    $table->text('description');

```

Then, we can apply the migration:

```
php artisan migrate
```

### Making our model translatable
Once the translations table is created, we need to add the `HasTranslations` trait and add a custom `cast` 
in our `Eloquent Model`:

```
use Kodilab\LaravelI18n\Traits\HasTranslations;

class Car extends Model
{
    use HasTranslations;
    
    protected $casts = [
        ...
        'description' => 'translatable',
        ...
    ];
}
```

Remember that `description` is no longer an attribute of the `Car` model even though it exists as column in the `cars`
table.

## Translatable attribute methods

##### setTranslatedAttribute(Locale $locale, string $attribute, string $translation)
Set the `translation` for the given `attribute` in the `locale` given.

##### setTranslatedAttributes(Locale $locale, array $translation)
Set the `translation` for multiple `attributes` in the `locale` given.

##### getTranslatedAttribute(Locale $locale, string $attribute)
Get the `attribute translation` for a given `locale``

##### isTranslated(Locale $locale, string $attribute)
Return whether an `attribute` has been translated in the `locale` indicated.

### Direct attribute access
Instead of accessing `translated values` through the `getTranslatedAttribute()` method, you can do it as it was
a `Model` attribute:

```
$locale = Locale::getLocale(config('app.locale')); // Loaded locale

$car->getTranslatedAttribute($locale, 'description') // It will return the loaded locale translation of description
$car->description // It will return the same result
```

**This can be done if your `model` is not extending the `__get(string $name)` method.** If your are extending it, you
should add the following snippet in your `__get(string $name)` method:

```
public function __get($name)
{
    ....

    if ($this->isTranslatableAttribute($name)) {
        return $this->getTranslatedAttribute(
            Locale::getLocaleOrFallback(config('app.locale')), 
            $name
        );
    }

    return parent::__get($name);
}
``` 


 