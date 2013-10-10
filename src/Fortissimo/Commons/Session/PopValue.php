<?php
namespace Fortissimo\Commons\Session;

/**
 * Take a value out of the session and put it into the context.
 *
 * This is destructive, in that it unsets the session value after fetching it.
 */
class PopValue extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
        ->description('Add a value to the $_SESSION.')
        ->usesParam('name', 'The name to add. This should be a scalar.')
        ->whichIsRequired()
        ->andReturns('The session value, or NULL if no value was found.')
        ;
  }

  public function doCommand() {
    $name = $this->param('name');

    if (!isset($_SESSION[$name])) {
      return;
    }

    $value = $_SESSION[$name];

    unset($_SESSION[$name]);

    return $value;
  }

}
