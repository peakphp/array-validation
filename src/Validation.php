<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

class Validation extends AbstractValidation implements ValidationInterface
{
    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string|null
     */
    protected $dataName;

    /**
     * Validation constructor.
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
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
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
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
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
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
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
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param int $n
     * @return $this
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
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeArray(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeArray($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'array',
            ]);
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeInteger(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeInteger($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'integer',
            ]);
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeFloat(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeFloat($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'float',
            ]);
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeString(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeString($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'string',
            ]);
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param string $key
     * @param bool $acceptNull
     * @return $this
     */
    public function expectKeyToBeBoolean(string $key, bool $acceptNull = false)
    {
        if (array_key_exists($key, $this->data) && $this->validator->expectKeyToBeBoolean($this->data, $key, $acceptNull) === false) {
            $message = $this->getErrorMessage('type', [
                'key' => $key,
                'expectedType' => 'boolean',
            ]);
            $this->errors[] = $message;
        }
        return $this;
    }

    /**
     * @param array $keys
     * @param bool $acceptNull
     * @return $this
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
    protected function getExceptionDataName(): ?string
    {
        if (isset($this->dataName)) {
            return '['. $this->dataName.'] ';
        }
        return null;
    }

    /**
     * @param string $type
     * @param array $context
     * @return string
     */
    protected function getErrorMessage(string $type, array $context): string
    {
        $context = array_merge(['dataName' => $this->getExceptionDataName()], $context);
        return parent::getErrorMessage($type, $context);
    }
}
