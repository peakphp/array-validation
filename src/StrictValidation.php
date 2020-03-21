<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

use Peak\ArrayValidation\Exception\InvalidStructureException;
use Peak\ArrayValidation\Exception\InvalidTypeException;

class StrictValidation extends Validation
{
    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectExactlyKeys(array $keys)
    {
        parent::expectExactlyKeys($keys);
        return $this->checkStructureErrors();
    }

    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectAtLeastKeys(array $keys)
    {
        parent::expectAtLeastKeys($keys);
        return $this->checkStructureErrors();
    }

    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectOnlyKeys(array $keys)
    {
        parent::expectOnlyKeys($keys);
        return $this->checkStructureErrors();
    }

    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectOnlyOneFromKeys(array $keys)
    {
        parent::expectOnlyOneFromKeys($keys);
        return $this->checkStructureErrors();
    }

    /**
     * @param int $n
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectNKeys(int $n)
    {
        parent::expectNKeys($n);
        return $this->checkStructureErrors();
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws InvalidTypeException
     */
    public function expectKeyToBeArray(string $key, bool $acceptNull = false)
    {
        parent::expectKeyToBeArray($key, $acceptNull);
        return $this->checkTypeErrors();
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws InvalidTypeException
     */
    public function expectKeyToBeInteger(string $key, bool $acceptNull = false)
    {
        parent::expectKeyToBeInteger($key, $acceptNull);
        return $this->checkTypeErrors();
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws InvalidTypeException
     */
    public function expectKeyToBeFloat(string $key, bool $acceptNull = false)
    {
        parent::expectKeyToBeFloat($key, $acceptNull);
        return $this->checkTypeErrors();
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws InvalidTypeException
     */
    public function expectKeyToBeString(string $key, bool $acceptNull = false)
    {
        parent::expectKeyToBeString($key, $acceptNull);
        return $this->checkTypeErrors();
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws InvalidTypeException
     */
    public function expectKeyToBeBoolean(string $key, bool $acceptNull = false)
    {
        parent::expectKeyToBeBoolean($key, $acceptNull);
        return $this->checkTypeErrors();
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this|Validation
     * @throws InvalidTypeException
     */
    public function expectKeysToBeString(array $keys, bool $acceptNull = false)
    {
        foreach ($keys as $key) {
            $this->expectKeyToBeString($key, $acceptNull);
        }
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this|Validation
     * @throws InvalidTypeException
     */
    public function expectKeysToBeInteger(array $keys, bool $acceptNull = false)
    {
        foreach ($keys as $key) {
            $this->expectKeyToBeInteger($key, $acceptNull);
        }
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this|Validation
     * @throws InvalidTypeException
     */
    public function expectKeysToBeFloat(array $keys, bool $acceptNull = false)
    {
        foreach ($keys as $key) {
            $this->expectKeyToBeFloat($key, $acceptNull);
        }
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this|Validation
     * @throws InvalidTypeException
     */
    public function expectKeysToBeBoolean(array $keys, bool $acceptNull = false)
    {
        foreach ($keys as $key) {
            $this->expectKeyToBeBoolean($key, $acceptNull);
        }
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this|Validation
     * @throws InvalidTypeException
     */
    public function expectKeysToBeArray(array $keys, bool $acceptNull = false)
    {
        foreach ($keys as $key) {
            $this->expectKeyToBeArray($key, $acceptNull);
        }
        return $this;
    }

    /**
     * @return $this
     * @throws InvalidStructureException
     */
    protected function checkStructureErrors()
    {
        if ($this->hasErrors()) {
            throw new InvalidStructureException($this->getLastError() ?? '');
        }
        return $this;
    }

    /**
     * @return $this
     * @throws InvalidTypeException
     */
    protected function checkTypeErrors()
    {
        if ($this->hasErrors()) {
            throw new InvalidTypeException($this->getLastError() ?? '');
        }
        return $this;
    }
}
