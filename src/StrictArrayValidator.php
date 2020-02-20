<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

use Peak\ArrayValidation\Exception\InvalidStructureException;
use Peak\ArrayValidation\Exception\InvalidTypeException;

class StrictArrayValidator
{
    /**
     * @var ArrayValidation
     */
    private $arrayValidation;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string|null
     */
    private $dataName;

    /**
     * @var array
     */
    private $messages = [
        'expected' => '{dataName}invalid data, expected {expectedType} [{keysExpected}], received [{keysReceived}]',
        'type' => '{dataName}invalid type for key [{key}], type {expectedType} is expected',
    ];

    /**
     * StrictArrayValidator constructor.
     * @param array $data
     * @param string|null $dataName
     * @param ArrayValidation|null $arrayValidation
     */
    public function __construct(array $data, string $dataName = null, ArrayValidation $arrayValidation = null)
    {
        $this->data = $data;
        $this->dataName = $dataName;
        if (!isset($arrayValidation)) {
            $arrayValidation = new ArrayValidation();
        }
        $this->arrayValidation = $arrayValidation;
    }

    /**
     * @param array $keysName
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectExactlyKeys(array $keysName)
    {
        if ($this->arrayValidation->expectExactlyKeys($this->data, $keysName) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keysName);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expected', [
                'expectedType' => 'exactly keys',
                'keysExpected' => implode(', ', $keysName),
                'keysReceived' => implode(', ', $keysReceived)
            ]);
            throw new InvalidStructureException($message);
        }
        return $this;
    }

    /**
     * @param array $keysName
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectAtLeastKeys(array $keysName)
    {
        if ($this->arrayValidation->expectAtLeastKeys($this->data, $keysName) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keysName);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expected', [
                'expectedType' => 'at least keys',
                'keysExpected' => implode(', ', $keysName),
                'keysReceived' => implode(', ', $keysReceived)
            ]);
            throw new InvalidStructureException($message);
        }
        return $this;
    }

    /**
     * @param array $keysName
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectOnlyKeys(array $keysName)
    {
        if ($this->arrayValidation->expectOnlyKeys($this->data, $keysName) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keysName);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expected', [
                'expectedType' => 'only keys',
                'keysExpected' => implode(', ', $keysName),
                'keysReceived' => implode(', ', $keysReceived)
            ]);
            throw new InvalidStructureException($message);
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
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeArray($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'array',
            ]);
            throw new InvalidTypeException($message);
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
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeInteger($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'integer',
            ]);
            throw new InvalidTypeException($message);
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
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeFloat($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'float',
            ]);
            throw new InvalidTypeException($message);
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
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeString($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'string',
            ]);
            throw new InvalidTypeException($message);
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
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeBoolean($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'boolean',
            ]);
            throw new InvalidTypeException($message);
        }
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return string|null
     */
    private function getExceptionDataName(): ?string
    {
        if (isset($this->dataName)) {
            return '['. $this->dataName.'] ';
        }
        return null;
    }

    /**
     * @param $type
     * @param array $context
     * @return string
     */
    private function getErrorMessage($type, array $context): string
    {
        $message = $this->messages[$type];
        $context = array_merge(['dataName' => $this->getExceptionDataName()], $context);
        $replace = [];

        foreach ($context as $key => $val) {
            // check that the value can be casted to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                if (isset($fn)) {
                    $val = $fn($val);
                }
                $replace['{' . $key . '}'] = $val;
            }
        }
        return strtr($message, $replace);
    }
}
