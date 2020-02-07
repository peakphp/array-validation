<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

use Peak\ArrayValidation\Exception\ArrayValidationException;

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
     * ArrayValidationHelper constructor.
     * @param ArrayValidation $arrayValidation
     * @param array $data
     * @param string|null $dataName
     */
    public function __construct(ArrayValidation $arrayValidation, array $data, string $dataName = null)
    {
        $this->arrayValidation = $arrayValidation;
        $this->data = $data;
        $this->dataName = $dataName;
    }

    /**
     * @param array $keysName
     * @return $this
     * @throws ArrayValidationException
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
            throw new ArrayValidationException($message);
        }
        return $this;
    }

    /**
     * @param array $keysName
     * @return $this
     * @throws ArrayValidationException
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
            throw new ArrayValidationException($message);
        }
        return $this;
    }

    /**
     * @param array $keysName
     * @return $this
     * @throws ArrayValidationException
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
            throw new ArrayValidationException($message);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws ArrayValidationException
     */
    public function expectKeyToBeArray(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeArray($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'array',
            ]);
            throw new ArrayValidationException($message);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws ArrayValidationException
     */
    public function expectKeyToBeInteger(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeInteger($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'integer',
            ]);
            throw new ArrayValidationException($message);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws ArrayValidationException
     */
    public function expectKeyToBeFloat(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeFloat($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'float',
            ]);
            throw new ArrayValidationException($message);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws ArrayValidationException
     */
    public function expectKeyToBeString(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeString($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'string',
            ]);
            throw new ArrayValidationException($message);
        }
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
     * @throws ArrayValidationException
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
     * @throws ArrayValidationException
     */
    public function expectKeysToBeString(array $keys, bool $acceptNull = false)
    {
        foreach ($keys as $key) {
            $this->expectKeyToBeString($key, $acceptNull);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     * @throws ArrayValidationException
     */
    public function expectKeyToBeBoolean(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->arrayValidation->expectKeyToBeBoolean($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'boolean',
            ]);
            throw new ArrayValidationException($message);
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
