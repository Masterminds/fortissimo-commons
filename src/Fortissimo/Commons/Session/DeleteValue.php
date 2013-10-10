<?php
namespace Fortissimo\Commons\Session;

/**
 * Delete something from the session.
 */
class DeleteValue extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
        ->description('Delete a value to the $_SESSION.')
        ->usesParam('name', 'The name of the item to delete.')
        ->whichIsRequired()
        ->andReturns('Boolean indicating whether it was deleted')
        ;
  }

  public function doCommand() {
    $name = $this->param('name');

    if (!isset($_SESSION[$name])) {
      return FALSE;
    }

    unset($_SESSION[$name]);
    return true;
  }

}
