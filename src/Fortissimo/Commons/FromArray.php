<?php
namespace Fortissimo\Commons;
/**
 * Extract values from a given array and put them into the context.
 *
 * This allows you to take an associative or indexed array and put the values into the context.
 *
 * Params:
 * - array: The array of data to use as a source.
 * - keys: The keys that should be extracted from `array`.
 * - prefix: If set, this string will be prepended to each key before the key is put into context.
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
 * The 'prefix' parameter can be used to avoid context collisions with existing names.
 *
 */
class FromArray extends \Fortissimo\Command\Base {
  public function expects() {
    return $this
      ->description('Extract data from an array into the context.')
      ->usesParam('array', 'The array to extract from.')->whichIsRequired()
      ->usesParam('keys', 'The keys. These can be numeric or string')->whichIsRequired()
      ->usesParam('prefix', 'An optional prefix that will be added to the key name before the keyname is put into context.')
      ->andReturns('Each key is inserted into the context with the value found in the array (or NULL if none is found).')
      ;
  }
  public function doCommand() {
    $array = $this->param('array');
    $keys = $this->param('keys');
    $prefix = $this->param('prefix', '');

    foreach ($keys as $key) {
      $val = isset($array[$key]) ? $array[$key] : NULL;
      $this->context->add($prefix . $key, $val);
    }
  }
}

