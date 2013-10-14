<?php
namespace Fortissimo\Commons;
/**
 * Extract values from a given array and put them into the context.
 *
 * This allows you to take an associative or indexed array and put the values into the context.
 *
 * Params:
 * - Any name becomes a key, and its value is put into the context with the name as the key.
 *
 * Example:
 * ->does('FromArray', 'myData')
 * ->using('array', array('foo' => 'bar', 'baz' => '123', 'another' => 'test'))
 * ->using('keys', array('foo', 'baz')
 *
 *
 * The above will create the following context values:
 *
 * - 'cxt:foo' is 'bar'
 * - 'cxt:baz' is '123'
 *
 * The 'another' key is not extracted into the context.
 *
 */
class FromArray extends \Fortissimo\Command\Base {
  public function expects() {
    return $this
      ->description('Extract data from an array into the context.')
      ->usesParam('array', 'The array to extract from.')->whichIsRequired()
      ->usesParam('keys', 'The keys. These can be numeric or string')->whichIsRequired()
      ->andReturns('Each key is inserted into the context with the value found in the array (or NULL if none is found).')
      ;
  }
  public function doCommand() {
    $array = $this->param('array');
    $keys = $this->param('keys');

    foreach ($keys as $key) {
      $val = isset($array[$key]) ? $array[$key] : NULL;
      $this->context->add($key, $val);
    }
  }
}

