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
        'expectKeyToBeObject' => [],
        'expectKeysToBeObject' => [],
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
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function expectOnlyOneFromKeys(array $keys)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function expectAtLeastKeys(array $keys)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function expectOnlyKeys(array $keys)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param int $n
     * @return $this
     */
    public function expectNKeys(int $n)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeArray(string $key, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeArray(array $keys, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeInteger(string $key, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeInteger(array $keys, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeFloat(string $key, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeFloat(array $keys, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeString(string $key, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeString(array $keys, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeBoolean(string $key, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeBoolean(array $keys, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeObject(string $key, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeysToBeObject(array $keys, bool $acceptNull = false)
    {
        return $this->addValidation(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getValidations();
    }

    /**
     * @param string $validationName
     * @param array $validationArgs
     * @return $this
     */
    protected function addValidation(string $validationName, array $validationArgs)
    {
        $this->validations[$validationName][] = $validationArgs;
        return $this;
    }
}
