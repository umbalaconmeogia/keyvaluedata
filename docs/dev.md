# yii2-worldclock dev note

## Add library to devmyext

* In devmyext's yii2/composer.json, add into "repositories"
  ```json
    {
        "type": "path",
        "url": "../../../yii2-worldclock",
        "symlink": true
    },
  ```
* Run
  ```shell
    composer require umbalaconmeogia/yii2-worldclock
  ```
* Add to common/config/main.php
  ```php
      'modules' => [
        'worldclock' => [
            'class' => 'umbalaconmeogia\worldclock\Module',
        ],
        // Other module settings.
    ],
  ```
* Define translation
  This setting does not need for using this module. But need when use gii to generate code for this module itself.
  ```php
    'components' => [
        'i18n' => [
            'translations' => [
                'worldclock' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'forceTranslation' => true,
                    'basePath' => '@umbalaconmeogia/worldclock/messages',
                    'fileMap' => [
                        'worldclock' => 'worldclock.php',
                    ],
                ],
                // Other translation settings.
            ],
        ],
    ],
  ```
## Run migration

To run with namespace (the migration class should decrlare namespace)
```shell
yii migrate --migrationNamespaces=umbalaconmeogia\\worldclock\\migrations
```

To run without namespace (the migration class should not decrlare namespace)
```shell
yii migrate/down --migrationPath=@vendor/umbalaconmeogia/yii2-worldclock/src/migrations
```

## Start local web server

```shell
./yii serve --docroot="frontend/web/"
```