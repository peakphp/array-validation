<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

interface SchemaCompilerInterface
{
    /**
     * @param array $schema
     * @return ValidationDefinition
     * @throws Exception\InvalidStructureException
     * @throws Exception\InvalidTypeException
     */
    public function compileSchema(array $schema): ValidationDefinition;
}
