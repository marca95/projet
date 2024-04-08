--TEST--
Javascript Code: two-byte UTF-8 (é)
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

$canonicalBson = hex2bin('190000000D61000D000000C3A9C3A9C3A9C3A9C3A9C3A90000');
$canonicalExtJson = '{"a" : {"$code" : "\\u00e9\\u00e9\\u00e9\\u00e9\\u00e9\\u00e9"}}';

// Canonical BSON -> Native -> Canonical BSON
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> BSON object -> Canonical BSON
echo bin2hex((string) MongoDB\BSON\Document::fromBSON($canonicalBson)), "\n";

// Canonical BSON -> Canonical extJSON
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical BSON -> BSON object -> Canonical extJSON
echo json_canonicalize(MongoDB\BSON\Document::fromBSON($canonicalBson)->toCanonicalExtendedJSON()), "\n";

// Canonical extJSON -> Canonical BSON
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

// Canonical extJSON -> BSON object -> Canonical BSON
echo bin2hex((string) MongoDB\BSON\Document::fromJSON($canonicalExtJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
190000000d61000d000000c3a9c3a9c3a9c3a9c3a9c3a90000
190000000d61000d000000c3a9c3a9c3a9c3a9c3a9c3a90000
{"a":{"$code":"\u00e9\u00e9\u00e9\u00e9\u00e9\u00e9"}}
{"a":{"$code":"\u00e9\u00e9\u00e9\u00e9\u00e9\u00e9"}}
190000000d61000d000000c3a9c3a9c3a9c3a9c3a9c3a90000
190000000d61000d000000c3a9c3a9c3a9c3a9c3a9c3a90000
===DONE===