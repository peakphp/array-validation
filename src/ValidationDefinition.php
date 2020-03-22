<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

use \JsonSerializable;

class ValidationDefinition implements ValidationInterface, JsonSerializable
{
    /**
     * @var array
     */
    private $validations = [
        'expectExactlyKeys' => [],
        'expectOnlyOneFromKeys' => [],
        'expectAtLeastKeys' => [],
        'expectOnlyKeys' => [],
        'expectNKeys' => [],
        'expectKeyToBeArray' => [],
        'expectKeysToBeArray' => [],
        'expectKeyToBeInteger' => [],
        'expectKeysToBeInteger' => [],
        'expectKeyToBeFloat' => [],
        'expectKeysToBeFloat' => [],
        'expectKeyToBeString' => [],
        'expectKeysToBeString' => [],
        'expectKeyToBeBoolean' => [],
        'expectKeysToBeBoolean' => [],
    ];

    /**
     * @return array
     */
    public function getValidations(): array
    {
        $validations = [];
        foreach ($this->validations as $name => $args) {
            if (!empty($args)) {
                $validations[$name] = $args;
            }
        }
        return $validations;
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function expectExactlyKeys(array $keys)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function expectOnlyOneFromKeys(array $keys)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function expectAtLeastKeys(array $keys)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function expectOnlyKeys(array $keys)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param int $n
     * @return $this
     */
    public function expectNKeys(int $n)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeArray(string $key, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeArray(array $keys, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeInteger(string $key, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeInteger(array $keys, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeFloat(string $key, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeFloat(array $keys, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeString(string $key, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeString(array $keys, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeBoolean(string $key, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeBoolean(array $keys, bool $acceptNull = false)
    {
        $this->validations[__FUNCTION__][] = func_get_args();
        return $this;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getValidations();
    }
}
