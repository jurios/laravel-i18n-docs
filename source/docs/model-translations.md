---
title: Model translations
description: Model attributes translations in Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Model translations {#model-translations}
`Laravel i18n` provides a translatable model attributes solution making translatable attributes something really easy to
implement.

## Design
When you want to make translatable some attributes of a given `model`, a new table must be created in your database in order
to persist the translations. By convention, that table name will be the same name as the given `model` table (in singular) 
adding the suffix `_translations`.

So, for example, if we want to add translatable attributes to the model `Car` which uses the table `cars`, a
`car_translations` table will be created.

In this new table we'll persist all the translatable attributes. 

## Creating the migration
Laravel i18n provides a `command` for generating a boilerplate migration file:

```
php artisan i18n:translatable
```

This command will ask for which `model` in your `App` namespace do you want to create translatable attributes. 
Once you choose the model a migration file will be created in `database/migrations` folder.

This migration is ready to be applied. You just need to add the columns (attributes) which will be translatable.
To do that, just open the file and add them in the place a comment indicates.

So, for example, let's say that I have the model `Car` which I want to make `description` attribute translatable.
After call to `php artisan i18n:generate translatable` and choose the `Car` when the command ask for it, the migration 
`0000_00_00_000000_create_car_translations_table.php` is generated. Now I should add the attributes I need:

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

Is important to know that `description` attribute value will be taken from the `translation table` if you add this previous
`cast`. That means if you have the duplicated an attribute name between the `model table` and `translation table`, the value
will be taken from `translation table` and ignored from `model table`.

## Translatable attribute methods
Those methods allows you manage attribute translations:

```
    /**
     * Saves (or updates) one translated attribute
     *
     * @param Locale $locale
     * @param string $attribute
     * @param string $translation
     */
    public function setTranslatedAttribute(Locale $locale, string $attribute, string $translation)
    
    /**
     * Saves (or updates) multiple translated attributes
     *
     * @param Locale $locale
     * @param array $translation
     */
    public function setTranslatedAttributes(Locale $locale, array $translation)

    /**
     * Returns whether an attribute is translated for a given locale
     *
     * @param Locale $locale
     * @param string $attribute
     * @return bool
     */
    public function isTranslated(Locale $locale, string $attribute)
    
    /**
     * Returns the translated attribute for a given locale
     *
     * @param Locale $locale
     * @param string $field
     * @return |null
     */
    public function getTranslatedAttribute(Locale $locale, string $field)
```

### Translatable attribute forwarding
Instead of accessing to the translated values through the `getTranslatedAttribute()` method, you can do it as it was
a `Model attribute`. 

```
$locale = Locale::getLocale(i18n::getLocale()); // Loaded locale

$car->getTranslatedAttribute($locale, 'description') // It will return the loaded locale translation of description
$car->description // It will return the same result
```

When you use that feature, the `locale` used is the locale which is [being used during the request](#). 
If the translation is not available for that `locale`, then `fallback locale` is used.

If your `Model` is already extending `__get(string $name)` method, then you need to add the following snippet 
in your `__get(string $name)` method in order to allow translatable attribute forwarding:

```
public function __get($name)
{
    ....

    if ($this->isTranslatableAttribute($name)) {
        return $this->getTranslatedAttribute(
            Locale::getLocaleOrFallback(app('i18n')->getLocale(), 
            $name
        );
    }

    return parent::__get($name);
}
``` 