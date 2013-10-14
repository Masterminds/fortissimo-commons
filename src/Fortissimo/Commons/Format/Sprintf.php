<?php
namespace Fortissimo\Commons\format;
/**
 * Run various arguments through sprintf() and put the results in the context.
 *
 * Params:
 * - format: The format string, e.g. "Hello %s"
 * - 0...n: Numeric indexes are sent into sprintf.
 *
 * Example:
 * ->does('sprintf', 'sprintf')
 * ->using('format', 'My name is %s and my favorite digit is %d')
 * ->using('0', 'Matt')
 * ->using('1', '7')
 *
 * The above will add `sprintf` to the context with the value 'My name is Matt and my favorite digit is 7'.
 */
class Sprintf implements \Fortissimo\Command, \Fortissimo\Explainable {
  protected $name, $caching;

  public function __construct($name, $caching = TRUE) {
    $this->name = $name;
    $this->caching = $caching;
  }

  public function isCacheable() {
    return TRUE;
  }

  public function execute($params, \Fortissimo\ExecutionContext $cxt) {
    $format = '';
    $pos = array();
    foreach ($params as $name => $value) {
      if ($name == 'format') {
        $format = $value;
      }
      elseif (!is_numeric($name)) {
        continue;
      }
      else {
        $pos[(int)$name] = $value;
      }
    }
    $cxt->add($this->name, vsprintf($format, $pos));
  }

  public function explain() {
    $klass = new \ReflectionClass($this);
    $desc = 'CMD: %s (%s): Format a string based on the params given.\n\tRETURNS: The formatted string\n\n';
    return sprintf($desc, $this->name, $klass->name);
  }
}

