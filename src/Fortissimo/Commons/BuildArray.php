<?php
namespace Fortissimo\Commons;
/**
 * Create a new array (associative or indexed).
 *
 * This allows you to inject data from contexts and other sources into an array.
 *
 * This differs from AddToContext in that it does the opposite: it pulls data
 * out of Fortissimo sources and into an array.
 *
 * It differs from IntoArray in that it does not merely take values out of
 * the context. It can take values from any source, including literals.
 *
 * Params:
 * - Any name becomes a key, and any value becomes that key's value.
 *
 * Example:
 * ->does('BuildArray', 'myData')
 * ->using('foo', 'bar)
 * ->using('baz')->from('get:baz')
 *
 * The above will put an array named 'myData' into the context. Assuming that 
 * `$_GET['baz']` is '123', the generated array will look like this:
 *
 * array(
 *   'foo' => 'bar',
 *   'baz' => '123'
 * );
 */
class BuildArray implements \Fortissimo\Command, \Fortissimo\Explainable {
  protected $name, $caching;

  public function __construct($name, $caching = TRUE) {
    $this->name = $name;
    $this->caching = $caching;
  }

  public function isCacheable() {
    return TRUE;
  }

  public function execute($params, \Fortissimo\ExecutionContext $cxt) {
    $buffer = array();
    foreach ($params as $name => $value) {
      $buffer[$name] = $value;
    }
    $cxt->add($this->name, $buffer);
  }

  public function explain() {
    $klass = new \ReflectionClass($this);
    $desc = 'CMD: %s (%s): Add all params into a single array.\n\tRETURNS: The array\n\n';
    return sprintf($desc, $this->name, $klass->name);
  }
}

