--TEST--
Top-level document validity: Bad DBpointer (extra field)
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

throws(function() {
    fromJSON('{"a": {"$dbPointer": {"a": {"$numberInt": "1"}, "$id": {"$oid": "56e1fc72e0c917e9c4714161"}, "c": {"$numberInt": "2"}, "$ref": "b"}}}');
}, 'MongoDB\Driver\Exception\UnexpectedValueException');

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\UnexpectedValueException
===DONE===