<?php

declare(strict_types=1);

namespace Peak\ArrayValidation;

use \JsonSerializable;

class Schema implements SchemaInterface, JsonSerializable
{
    /**
     * @var SchemaCompilerInterface
     */
    private $compiler;

    /**
     * @var array
     */
    private $schema;

    /**
     * @var string
     */
    private $schemaName;

    /**
     * Schema constructor.
     * @param SchemaCompilerInterface $compiler
     * @param array $schema
     * @param string $schemaName
     */
    public function __construct(
        SchemaCompilerInterface $compiler,
        array $schema,
        string $schemaName = ''
    ) {
        $this->compiler = $compiler;
        $this->schema = $schema;
        $this->schemaName = $schemaName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->schemaName;
    }

    /**
     * @return ValidationDefinition
     * @throws Exception\InvalidStructureException
     * @throws Exception\InvalidTypeException
     */
    public function compile(): ValidationDefinition
    {
        return $this->compiler->compileSchema($this->schema);
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->schema;
    }
}
