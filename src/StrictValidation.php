<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

use Peak\ArrayValidation\Exception\InvalidStructureException;
use Peak\ArrayValidation\Exception\InvalidTypeException;

class StrictValidation implements ValidationInterface
{
    /**
     * @var Validator
     */
    private $validator;

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
        'expectedN' => '{dataName}invalid data, expected {nExpected} element(s), received {nReceived} element(s)',
        'expected' => '{dataName}invalid data, expected {expectedType} [{keysExpected}], received [{keysReceived}]',
        'type' => '{dataName}invalid type for key [{key}], type {expectedType} is expected',
    ];

    /**
     * StrictValidation constructor.
     * @param array $data
     * @param string|null $dataName
     * @param Validator|null $validator
     */
    public function __construct(array $data, string $dataName = null, Validator $validator = null)
    {
        $this->data = $data;
        $this->dataName = $dataName;
        if (!isset($validator)) {
            $validator = new Validator();
        }
        $this->validator = $validator;
    }

    /**
     * @param array $keys
     * @return $this
     * @throws InvalidStructureException
     */
    public function expectExactlyKeys(array $keys)
    {
        if ($this->validator->expectExactlyKeys($this->data, $keys) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keys);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expected', [
                'expectedType' => 'exactly keys',
                'keysExpected' => implode(', ', $keys),
                'keysReceived' => implode(', ', $keysReceived)
            ]);
            throw new InvalidStructureException($message);
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
        if ($this->validator->expectAtLeastKeys($this->data, $keys) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keys);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expected', [
                'expectedType' => 'at least keys',
                'keysExpected' => implode(', ', $keys),
                'keysReceived' => implode(', ', $keysReceived)
            ]);
            throw new InvalidStructureException($message);
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
        if ($this->validator->expectOnlyKeys($this->data, $keys) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keys);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expected', [
                'expectedType' => 'only keys',
                'keysExpected' => implode(', ', $keys),
                'keysReceived' => implode(', ', $keysReceived)
            ]);
            throw new InvalidStructureException($message);
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
        if ($this->validator->expectOnlyOneFromKeys($this->data, $keys) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keys);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expected', [
                'expectedType' => 'only one of keys',
                'keysExpected' => implode(', ', $keys),
                'keysReceived' => implode(', ', $keysReceived)
            ]);
            throw new InvalidStructureException($message);
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
        if ($this->validator->expectNKeys($this->data, $n) === false) {
            $keysReceived = array_keys($this->data);
            natsort($keysReceived);
            $message = $this->getErrorMessage('expectedN', [
                'expectedType' => 'only N keys',
                'nExpected' => $n,
                'nReceived' => count($keysReceived)
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
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeArray($this->data, $key, $acceptNull) === false) {
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
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeInteger($this->data, $key, $acceptNull) === false) {
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
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeFloat($this->data, $key, $acceptNull) === false) {
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
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeString($this->data, $key, $acceptNull) === false) {
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
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeBoolean($this->data, $key, $acceptNull) === false) {
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
