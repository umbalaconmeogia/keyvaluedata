# keyvaluedata
A tool to store values of data set or configuration setting.

There are two ways using KeyValueData extension.
1. To use as value set for an attribute.
  For example, gender as male, female.
2. To use as configuration.
  For example, system setting.

```php
    'modules' => [
        'keyvaluedata' => [
            'class' => 'common\module\keyvaluedata\Module',
        ],
    ],
```