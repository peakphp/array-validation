<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

abstract class AbstractValidation
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $errorMessages = [
        'expectedN' => '{dataName}invalid data, expected {nExpected} element(s), received {nReceived} element(s)',
        'expected' => '{dataName}invalid data, expected {expectedType} [{keysExpected}], received [{keysReceived}]',
        'type' => '{dataName}invalid type for key [{key}], type {expectedType} is expected',
    ];

    /**
     * @param $type
     * @param array $context
     * @return string
     */
    protected function getErrorMessage($type, array $context): string
    {
        $message = $this->errorMessages[$type];
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

    /**
     * @return string|null
     */
    public function getLastError(): ?string
    {
        $lastKey = array_key_last($this->errors);
        if ($lastKey === null) {
            return $lastKey;
        }
        return $this->errors[$lastKey];
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}