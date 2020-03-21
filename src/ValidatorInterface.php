<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

interface ValidatorInterface
{
    public function expectExactlyKeys(array $array, array $keys): bool;
    public function expectOnlyOneFromKeys(array $array, array $keys): bool;
    public function expectAtLeastKeys(array $array, array $keys): bool;
    public function expectOnlyKeys(array $array, array $keys): bool;
    public function expectNKeys(array $array, int $n): bool;
    public function expectKeyToBeArray(array $array, string $key, bool $acceptNull = false): bool;
    public function expectKeysToBeArray(array $array, array $keys, bool $acceptNull = false): bool;
    public function expectKeyToBeInteger(array $array, string $key, bool $acceptNull = false): bool;
    public function expectKeysToBeInteger(array $array, array $keys, bool $acceptNull = false): bool;
    public function expectKeyToBeString(array $array, string $key, bool $acceptNull = false): bool;
    public function expectKeysToBeString(array $array, array $keys, bool $acceptNull = false): bool;
    public function expectKeyToBeFloat(array $array, string $key, bool $acceptNull = false): bool;
    public function expectKeysToBeFloat(array $array, array $keys, bool $acceptNull = false): bool;
    public function expectKeyToBeBoolean(array $array, string $key, bool $acceptNull = false): bool;
    public function expectKeysToBeBoolean(array $array, array $keys, bool $acceptNull = false): bool;
}