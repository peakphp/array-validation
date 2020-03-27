# Peak/ArrayValidation

<a href="https://packagist.org/packages/peak/array-validation"><img src="https://poser.pugx.org/peak/array-validation/version" alt="version"></a>
<a href="https://packagist.org/packages/peak/array-validation"><img src="https://poser.pugx.org/peak/array-validation/downloads" alt="Total Downloads"></a>
<a href="https://github.com/peakphp/array-validation/blob/master/LICENSE.md"><img src="https://poser.pugx.org/peak/array-validation/license" alt="License"></a>

## Installation

     composer require peak/array-validation

## What is this?

This component help you to validate array structure by:

- validating the type of any key values
- ensuring a data structure with expected keys requirements
- preventing structure pollution by allowing only a set of keys

This is especially useful when dealing with json data request, before using the data, you must validate his content so
you can afterward check the value of those keys with your business logic without worrying about the type or presence of any key value.

# How to use
##### 7 Usages

## 1- General validation "à la carte" (stateless)

```php
$validator = new Validator();

if ($validator->expectExactlyKeys($data, $keys) === true) {
    // ...
}
```

## 2- Validation with fluent interface (stateful)

```php
$data = [ // data
    'tags' => [],
    'name' => 'foobar'
];
$validation = new Validation($data);

$validation
    ->expectExactlyKeys(['tags', 'name'])
    ->expectKeyToBeArray('tags');
    ->expectKeyToBeString('name');

if ($validation->hasErrors()) {
    // $lastError = $validation->getLastError();
    // $errors = $validation->getErrors();
}
```

## 3- Strict validation with fluent interface (stateful)

```php

$validation = new StrictValidation($data);

// will throw an exception if any of tests below fail
$validation
    ->expectOnlyKeys(['id', 'title', 'description', 'isPrivate', 'tags'])
    ->expectAtLeastKeys(['id', 'title', 'description'])
    ->expectKeyToBeInteger('id')
    ->expectKeysToBeString(['title', 'description'])
    ->expectKeyToBeBoolean('isPrivate')
    ->expectKeyToBeArray('tags');

// if we reach this point, it means the array structure is
// valid according to the validation rules above.

```

## 4- Create a ValidationDefinition for later usage

```php
$vDef = new ValidationDefinition();
$vDef
    ->expectOnlyKeys(['title', 'content', 'description'])
    ->expectAtLeastKeys(['title', 'content'])
    ->expectKeysToBeString(['title', 'content', 'description']);

$validation = new ValidationFromDefinition($vDef, $data);

if ($validation->hasErrors()) {
    // $validation->getErrors();
}

```

## 5- Create a validation Schema for later usage

Schema is just another way to write validation definitions. This format is ideal when you want to store schemas in file (ex: json, php array file, yml, etc.)

```php

$mySchema = [
    'title' => [
        'type' => 'string',
        'required' => true
    ],
    'content' => [
        'type' => 'string',
        'nullable' => true,
    ],
];

$schema = new Schema(new SchemaCompiler(), $mySchema, 'mySchemaName');

$validation = new ValidationFromSchema($schema, $data);

if ($validation->hasErrors()) {
    // $validation->getErrors();
}
```



## 6- Strict validation using ValidationDefinition

```php
// all validation definitions are executed at object creation and an exception is thrown if any of tests failed
new StrictValidationFromDefinition($validationDefinition, $arrayToValidate);
```

## 7- Strict validation using Schema

```php
// all validation definitions are executed at object creation and an exception is thrown if any of tests failed
new StrictValidationFromSchema($schema, $arrayToValidate);
```


# Validation methods
```php

interface ValidationInterface
{
    public function expectExactlyKeys(array $keys);
    public function expectOnlyOneFromKeys( array $keys);
    public function expectAtLeastKeys(array $keys);
    public function expectOnlyKeys(array $keys);
    public function expectNKeys(int $n);
    public function expectKeyToBeArray(string $key, bool $acceptNull = false);
    public function expectKeysToBeArray(array $keys, bool $acceptNull = false);
    public function expectKeyToBeInteger(string $key, bool $acceptNull = false);
    public function expectKeysToBeInteger(array $keys, bool $acceptNull = false);
    public function expectKeyToBeFloat(string $key, bool $acceptNull = false);
    public function expectKeysToBeFloat(array $keys, bool $acceptNull = false);
    public function expectKeyToBeString(string $key, bool $acceptNull = false);
    public function expectKeysToBeString(array $keys, bool $acceptNull = false);
    public function expectKeyToBeBoolean(string $key, bool $acceptNull = false);
    public function expectKeysToBeBoolean(array $keys, bool $acceptNull = false);
    public function expectKeyToBeObject(string $key, bool $acceptNull = false);
    public function expectKeysToBeObject(array $keys, bool $acceptNull = false);
}
```