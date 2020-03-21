<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

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
}