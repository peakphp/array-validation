# Peak/ArrayValidation

<a href="https://packagist.org/packages/peak/array-validation"><img src="https://poser.pugx.org/peak/array-validation/version" alt="version"></a>
<a href="https://packagist.org/packages/peak/array-validation"><img src="https://poser.pugx.org/peak/array-validation/downloads" alt="Total Downloads"></a>
<a href="https://github.com/peakphp/array-validation/blob/master/LICENSE.md"><img src="https://poser.pugx.org/peak/array-validation/license" alt="License"></a>

## Installation

     composer require peak/array-validation

## Usage

General validation (stateless)

```php
$validator = new Validator();

if ($validator->expectExactlyKeys($array, ['key1', 'key2', 'key3']) === true) {
    // ...
}
```

Advanced validation with fluent interface.

```php

$validation = new StrictValidation($array);

// will throw an exception if any of tests below fail
$validation
    ->expectOnlyKeys(['id', 'title', 'description', 'isPrivate', 'tags'])
    ->expectAtLeastKeys(['id', 'title', 'description'])
    ->expectKeyToBeInteger('id')
    ->expectKeysToBeString(['title', 'description'])
    ->expectKeyToBeBoolean('isPrivate')
    ->expectKeyToBeArray('tags');

// if we reach this point, it means the array is 
// valid according to the validation rules above.

```