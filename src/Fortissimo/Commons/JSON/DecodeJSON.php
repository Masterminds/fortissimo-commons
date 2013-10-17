<?php
namespace Fortissimo\Commons\JSON;

class DecodeJSON extends \Fortissimo\Command\Base {
  public function expects() {
    return $this
      ->description('Parse a JSON string into an object or array')
      ->usesParam('data', 'Data to decode.')->whichIsRequired()
      ->usesParam('asArray', 'Convert to array instead of to an object.')->whichHasDefault(FALSE)
      ->andReturns('The decoded data.')
      ;
  }

  public function doCommand() {
    $data = $this->param('data');
    $asArray = $this->param('asArray', FALSE);
    return json_decode($data, $asArray);
  }
}
