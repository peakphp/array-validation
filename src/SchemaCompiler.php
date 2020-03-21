<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

class SchemaCompiler implements SchemaCompilerInterface
{
    /**
     * @param array $schema
     * @return ValidationDefinition
     * @throws Exception\InvalidStructureException
     * @throws Exception\InvalidTypeException
     */
    public function compileSchema(array $schema): ValidationDefinition
    {
        $definition = new ValidationDefinition();

        foreach ($schema as $fieldName => $fieldDefinition) {
            if (is_string($fieldName) && is_array($fieldDefinition)) {
                $this->handleFieldDefinition($fieldName, $fieldDefinition, $definition);
            }
        }

        // handle "required"
        $this->handleRequiredFields($schema, $definition);

        return $definition;
    }

    /**
     * @param string $fieldName
     * @param array $fieldDefinition
     * @param ValidationDefinition $definition
     * @throws Exception\InvalidStructureException
     * @throws Exception\InvalidTypeException
     */
    private function handleFieldDefinition(string $fieldName, array $fieldDefinition, ValidationDefinition $definition): void
    {
        (new StrictValidation($fieldDefinition, 'compile.schema.field.' . $fieldName))
            ->expectOnlyKeys([
                'comment', 'type', 'nullable', 'required', 'default', 'values'
            ])
            ->expectKeysToBeBoolean([
                'nullable', 'required'
            ]);

        // handle "type" and "nullable"
        if (isset($fieldDefinition['type'])) {
            $method = 'expectKeyToBe' . ucfirst($fieldDefinition['type']);
            $definition->$method($fieldName, $fieldDefinition['nullable'] ?? false);
        }
    }

    /**
     * @param array $schema
     * @param ValidationDefinition $definition
     */
    private function handleRequiredFields(array $schema, ValidationDefinition $definition): void
    {
        $definition->expectOnlyKeys(array_keys($schema));
        $atLeastKeys = [];
        $fieldCount = 0;
        $requiredFieldCount = 0;
        foreach ($schema as $field => $fieldDef) {
            if (is_array($fieldDef)) {
                ++$fieldCount;
                if (isset($fieldDef['required']) && $fieldDef['required'] === true) {
                    $atLeastKeys[] = $field;
                    ++$requiredFieldCount;
                }
            }
        }

        if ($requiredFieldCount == $fieldCount) {
            $definition->expectExactlyKeys($atLeastKeys);
        } else {
            $definition->expectAtLeastKeys($atLeastKeys);
        }
    }
}