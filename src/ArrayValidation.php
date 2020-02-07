<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

class ArrayValidation
{
    /**
     * The array should match all expected keys, no more, no less
     * @param array $array
     * @param array $keysName
     * @return bool
     */
    public function expectExactlyKeys(array $array, array $keysName): bool
    {
        $expectedCount = count($keysName);
        if (count($array) <> $expectedCount) {
            return false;
        }
        $actuallyCount = 0;
        foreach ($keysName as $key) {
            if (array_key_exists($key, $array)) {
                ++$actuallyCount;
            }
        }
        return ($actuallyCount === $expectedCount);
    }

    /**
     * The array should be length of 1 and have a key from expected keys
     * @param array $array
     * @param array $keysName
     * @return bool
     */
    public function expectOnlyOneFromKeys(array $array, array $keysName): bool
    {
        if (count($array) <> 1) {
            return false;
        }
        $keys = array_keys($array);
        return in_array($keys[0], $keysName);
    }

    /**
     * The array should have at least expected keys
     * @param array $array
     * @param array $keysName
     * @return bool
     */
    public function expectAtLeastKeys(array $array, array $keysName): bool
    {
        foreach ($keysName as $key) {
            if (!array_key_exists($key, $array)) {
                return false;
            }
        }
        return true;
    }

    /**
     * The array keys must be in keys name.
     * @param array $array
     * @param array $keysName
     * @return bool
     */
    public function expectOnlyKeys(array $array, array $keysName): bool
    {
        foreach (array_keys($array) as $key) {
            if (!in_array($key, $keysName)) {
                return false;
            }
        }
        return true;
    }

    /**
     * The array should be exactly the length of X
     * @param array $array
     * @param int $n
     * @return bool
     */
    public function expectXElement(array $array, int $n): bool
    {
        return ($n == count($array));
    }

    /**
     * @param array $array
     * @param string $key
     * @param bool $acceptNull
     * @return bool
     */
    public function expectKeyToBeArray(array $array, string $key, bool $acceptNull = false): bool
    {
        return $this->internalTypeValidation('is_array', $array, $key, $acceptNull);
    }

    /**
     * @param array $array
     * @param string $key
     * @param bool $acceptNull
     * @return bool
     */
    public function expectKeyToBeInteger(array $array, string $key, bool $acceptNull = false): bool
    {
        return $this->internalTypeValidation('is_integer', $array, $key, $acceptNull);
    }

    /**
     * @param array $array
     * @param string $key
     * @param bool $acceptNull
     * @return bool
     */
    public function expectKeyToBeString(array $array, string $key, bool $acceptNull = false): bool
    {
        return $this->internalTypeValidation('is_string', $array, $key, $acceptNull);
    }

    /**
     * @param array $array
     * @param string $key
     * @param bool $acceptNull
     * @return bool
     */
    public function expectKeyToBeFloat(array $array, string $key, bool $acceptNull = false): bool
    {
        return $this->internalTypeValidation('is_float', $array, $key, $acceptNull);
    }

    /**
     * @param array $array
     * @param string $key
     * @param bool $acceptNull
     * @return bool
     */
    public function expectKeyToBeBoolean(array $array, string $key, bool $acceptNull = false): bool
    {
        return $this->internalTypeValidation('is_bool', $array, $key, $acceptNull);
    }

    /**
     * @param string $method
     * @param array $array
     * @param string $key
     * @param bool $acceptNull
     * @return bool
     */
    private function internalTypeValidation(string $method, array $array, string $key, bool $acceptNull = false): bool
    {
        return !(
            (!array_key_exists($key, $array)) ||
            (!$acceptNull && !$method($array[$key])) ||
            ($acceptNull && ($array[$key] !== null && !$method($array[$key])))
        );
    }
}
