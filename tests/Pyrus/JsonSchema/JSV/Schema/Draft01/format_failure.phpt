--TEST--
JsonSchema: format, schema validation, failure test
--FILE--
<?php
require dirname(__FILE__) . '/setup.php.inc';

$env->createSchema(array('enum' => array('Jan', 'Feb', 'Mar', 'Apr', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov',
                                         'Dec')), null, 'http://example.com/months#');

$test->assertSchemaValidateFail(array('Instance "Oops" is not one of the possible values "Jan", "Feb", "Mar", "Apr", ' .
                                      '"Jun", "Jul", "Aug", "Sep", "Nov", "Dec" [schema path: #]',
                                      'String is not in the required format [schema path: #]'),
                                $env->validate('Oops', array('format' => 'http://example.com/months#')), "uri format");
$test->assertSchemaValidateFail(array('Date-time "2010-13-08T23:15:16Z"is not valid [schema path: #]',
                                      'String is not in the required format [schema path: #]'),
                                $env->validate('2010-13-08T23:15:16Z', array('format' => 'date-time')), "date-time");

?>
===DONE===
--EXPECT--
===DONE===