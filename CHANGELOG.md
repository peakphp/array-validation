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