<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

class StrictValidationFromSchema extends StrictValidation
{
    /**
     * StrictValidationFromSchema constructor.
     * @param Schema $schema
     * @param array $data
     * @param Validator|null $arrayValidation
     * @throws Exception\InvalidStructureException
     * @throws Exception\InvalidTypeException
     */
    public function __construct(
        Schema $schema,
        array $data,
        Validator $arrayValidation = null
    ) {
        parent::__construct($data, $schema->getName(), $arrayValidation);

        $validationDefinition = $schema->compile();
        foreach ($validationDefinition->getValidations() as $name => $args) {
            $callable = [$this, $name];
            if (is_callable($callable)) {
                call_user_func_array($callable, $args);
            }
        }
    }
}