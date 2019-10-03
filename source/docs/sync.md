---
title: Sync process
description: Sync process in Laravel i18n package.
extends: _layouts.documentation
section: content
---

# Sync process {#sync-process}
The `sync` process is an `artisan command` which perform the following tasks:

* Look for new translatable texts on your project (call to `__()` method) and add them to each `locale` translation file.
* Removes deprecated translations from each `locale` translation file.

This process is necessary to keep your translations files updated thus it must be called as frequently as possible.
Is a good idea to call this process as part of your deployment process. 

In order to call the process, you can do it with:

```
php artisan i18n:sync
```

