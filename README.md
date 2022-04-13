# Release notes

## v0.3.6

### Bug fixes

* Fixed namespaces in files:
    * util/lib/Map/MutableArrayMap.php
    * util/lib/Map/MapBuilder.php

# Static analyzer (psalm)

```bash
# Analyzing the current code, ignoring known errors from baseline.xml
./vendor/vimeo/psalm/psalm --use-baseline=baseline.xml --no-cache --no-diff

# Adding new errors to the exception list baseline.xml
./vendor/vimeo/psalm/psalm --set-baseline=baseline.xml --no-cache --no-diff

# Removing fixed errors from exception list baseline.xml
./vendor/vimeo/psalm/psalm --update-baseline --no-cache --no-diff
```

# PHPUnit

```bash
# run phpunit test
./vendor/bin/phpunit

```