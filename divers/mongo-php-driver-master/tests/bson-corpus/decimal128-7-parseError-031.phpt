--TEST--
Decimal128: [basx586] some baddies with dots and Es and dots and specials (Conversion_syntax)
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

throws(function() {
    new MongoDB\BSON\Decimal128('.NaN');
}, 'MongoDB\Driver\Exception\InvalidArgumentException');

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
===DONE===