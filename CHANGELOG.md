VERSION 3.0.0
-------------
Release date: 2020-03-21

 - introducing schema which add a new way to define your validations structure
 - added Schema, SchemaInterface, SchemaCompiler and SchemaCompilerInterface
 - added ArrayValidationExceptionInterface to help catching any validation exceptions
 - added StrictValidationFromSchema
 - rewritten StrictValidation and added AbstractValidation
 - added Validation, ValidationFromDefinition and ValidationFromSchema
   which act almost like as Strict* classes but without exceptions

VERSION 2.0.0
-------------
Release date: 2020-02-24

 - [BC] renamed method expectNElement() to expectNKeys() in ArrayValidation
 - added expectNKeys() and expectOnlyOneFromKeys() to StrictArrayValidator
 - added interfaces ArrayValidationInterface and ArrayValidatorInterface
 - [BC] renamed all classes and interfaces with better name
 - added ValidationDefinition and StrictValidationFromDefinition

VERSION 1.1.0
-------------
Release date: 2020-02-20

 - added methods expectKeysToBeArray(), expectKeysToBeBoolean() and expectKeysToBeFloat() to StrictArrayValidator
 - transformed ArrayValidationException to 2 more specific exceptions: InvalidStructureException and InvalidTypeException
 - [BC] simplified and reordered constructor params of StrictArrayValidator

VERSION 1.0.0
-------------
Release date: 2020-02-07

 - Initial release