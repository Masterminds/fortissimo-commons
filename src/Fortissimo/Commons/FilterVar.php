<?php
namespace Fortissimo\Commons;

/**
 * This command provides arbitrary filtering on variables.
 *
 * While validation and sanitization are built into Fortissimo, 
 * sometimes it is useful to be able to do an ad-hoc filter or sanitize 
 * operation.
 */
class FilterVar extends \Fortissimo\Command\Base {
  public function expects() {
    return $this
       ->description('Perform arbitrary validation/sanitizing using filter_var.')
       ->usesParam('value', 'The value to convert.')->whichIsRequired()
       ->usesParam('filter', 'The named filter. If none is specified, FILTER_DEFAULT is used.')
       ->usesParam('options', 'Options ot pass to filter_var')
       ->andReturns('A boolean')
       ;
  }

  public function doCommand() {
    $v = $this->param('value');
    $filter = $this->param('filter', FILTER_DEFAULT);
    $opts = $this->param('options', NULL);

    return filter_var($v, $filter, $opts);
  }
}
