<?php
namespace Fortissimo\Commons\Session;

/**
 * Add a value into the session.
 */
class PutValue extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
        ->description('Add a value to the $_SESSION.')
        ->usesParam('name', 'The name to add. This should be a scalar.')
        ->whichIsRequired()
        ->usesParam('value', 'The value to add. This should be serializable.')
        ->andReturns('Nothing.')
        ;
  }

  public function doCommand() {
    $name = $this->param('name');
    $value = $this->param('value', NULL);

    $_SESSION[$name] = $value;
  }

}
