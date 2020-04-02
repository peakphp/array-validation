<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

class ValidationBuilder extends ValidationDefinition
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var null
     */
    protected $lastError = null;

    /**
     * @param array $data
     * @return bool
     */
    public function validate(array $data): bool
    {
        $validation = new ValidationFromDefinition($this, $data);
        $this->errors = $validation->getErrors();
        $this->lastError = $validation->getLastError();
        return !$validation->hasErrors();
    }

    /**
     * @param array $data
     * @throw InvalidStructureException
     * @throw InvalidTypeException
     */
    public function strictValidate(array $data): void
    {
        new StrictValidationFromDefinition($this, $data);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string|null
     */
    public function getLastError(): ?string
    {
        return $this->lastError;
    }
}
