<?php

namespace Peak\ArrayValidation;

class ValidationDefinitionExecutor
{
    /**
     * @param ValidationDefinition $validationDefinition
     * @param ValidationInterface $validation
     */
    public function execute(ValidationDefinition $validationDefinition, ValidationInterface $validation)
    {
        $validations = $validationDefinition->getValidations();
        foreach ($validations as $name => $multipleArgs) {
            foreach ($multipleArgs as $args) {
                $callable = [$validation, $name];
                if (is_callable($callable)) {
                    call_user_func_array($callable, $args);
                }
            }
        }
    }
}