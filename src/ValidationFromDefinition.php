<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

class ValidationFromDefinition extends Validation
{
    /**
     * @var ValidationDefinition
     */
    private $arrayValidationDefinition;

    /**
     * ValidationFromDefinition constructor.
     * @param ValidationDefinition $arrayValidationDefinition
     * @param array $data
     * @param string|null $dataName
     * @param Validator|null $arrayValidation
     */
    public function __construct(
        ValidationDefinition $arrayValidationDefinition,
        array $data,
        string $dataName = null,
        Validator $arrayValidation = null
    ) {
        $this->arrayValidationDefinition = $arrayValidationDefinition;
        parent::__construct($data, $dataName, $arrayValidation);

        $validations = $arrayValidationDefinition->getValidations();
        foreach ($validations as $name => $args) {
            $callable = [$this, $name];
            if (is_callable($callable)) {
                call_user_func_array($callable, $args);
            }
        }
    }
}
