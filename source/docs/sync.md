---
title: Sync process
description: Sync process in Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Sync process {#sync-process}
The `sync` process does:

* Look for the `fallback locale` existence. If it does not exist, then the `fallback locale` is created.
* Look for new translatable texts on your project (call to `__()` method) and add them to each `locale` translation file
* Removes deprecated translations from each `locale` translation file

This process should be called as frequently as possible in order to keep translation files updated. 
Is recommended adding it as part of your deployment process in order to assure the `fallback locale` existence.

In order to call the process, you can do it with:
```
php artisan i18n:sync
```

