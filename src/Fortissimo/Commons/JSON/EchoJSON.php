<?php
/**
 * Echo an object as JSON.
 */

namespace Fortissimo\Commons\JSON;

/**
 * Print an object as JSON data.
 *
 * This sets the content type to application/json, as the spec indicates.
 *
 * Params:
 *
 * - object: The object to convert to JSON. This can be any data type that json_encode() supports.
 * - headers (array): Other HTTP headers to set.
 * - strip (boolean): If TRUE, null values will be stripped. DANGEROUS: Can have unintented side effects.
 */
class EchoJSON extends \Fortissimo\Command\Base {

  const MIME_TYPE = 'application/json';

  public function expects() {
    return $this
      ->description('Echo the contents of the "text" parameter to standard output.')
      ->usesParam('headers', 'Other HTTP headers to set. This should be an indexed array of header strings, e.g. array("Location: http://example.com").')
      ->usesParam('options', 'A bitmask of JSON options. See json_encode().')
      ->usesParam('object', 'The object to convert to JSON and echo.')
      ->usesParam('strip', 'If true, null values are stripped from output.')->whichHasDefault(FALSE)
      //->withFilter('string')
      ;
  }

  public function doCommand() {
    $headers = $this->param('headers', array());
    $options = $this->param('options');
    $obj = $this->param('object');
    $strip = $this->param('strip');

    header('Content-Type: ' . self::MIME_TYPE);

    foreach ($headers as $header) {
      header($header);
    }

    if ($strip) {
      $obj = $this->stripNullFields($obj);
    }

    print json_encode($obj, $options);
  }

  protected function stripNullFields($obj) {
    if (is_object($obj)) {
      $obj = (array)$obj;
    }

    return $this->_stripNulls($obj);
  }

  protected function _stripNulls($obj) {
    foreach ($obj as $n => $v) {
      if (is_null($v)) {
        unset($obj[$n]);
      }
      elseif (is_object($v)) {
        $obj[$n] = $this->_stripNulls((array)$v);
      }
      elseif (is_array($v)) {
        $obj[$n] = $this->_stripNulls($v);
      }
    }
    return $obj;
  }
}
