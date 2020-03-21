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
        if ($this->hasErrors()) {
            throw new InvalidStructureException($this->getLastError());
        }
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectAtLeastKeys(array $keys)
    {
        parent::expectAtLeastKeys($keys);
        if ($this->hasErrors()) {
            throw new InvalidStructureException($this->getLastError());
        }
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectOnlyKeys(array $keys)
    {
        parent::expectOnlyKeys($keys);
        if ($this->hasErrors()) {
            throw new InvalidStructureException($this->getLastError());
        }
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectOnlyOneFromKeys(array $keys)
    {
        parent::expectOnlyOneFromKeys($keys);
        if ($this->hasErrors()) {
            throw new InvalidStructureException($this->getLastError());
        }
        return $this;
    }

    /**
     * @param int $n
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectNKeys(int $n)
    {
        parent::expectNKeys($n);
        if ($this->hasErrors()) {
            throw new InvalidStructureException($this->getLastError());
        }
        return $this;
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
        if ($this->hasErrors()) {
            throw new InvalidTypeException($this->getLastError());
        }
        return $this;
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
        if ($this->hasErrors()) {
            throw new InvalidTypeException($this->getLastError());
        }
        return $this;
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
        if ($this->hasErrors()) {
            throw new InvalidTypeException($this->getLastError());
        }
        return $this;
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
        if ($this->hasErrors()) {
            throw new InvalidTypeException($this->getLastError());
        }
        return $this;
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
        if ($this->hasErrors()) {
            throw new InvalidTypeException($this->getLastError());
        }
        return $this;
    }
}
