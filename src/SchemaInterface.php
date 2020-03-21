<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

interface SchemaInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return ValidationDefinition
     * @throws Exception\InvalidStructureException
     * @throws Exception\InvalidTypeException
     */
    public function compile(): ValidationDefinition;
}
