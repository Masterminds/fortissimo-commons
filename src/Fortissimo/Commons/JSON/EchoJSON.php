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
 */
class EchoJSON extends \Fortissimo\Command\Base {

  const MIME_TYPE = 'application/json';

  public function expects() {
    return $this
      ->description('Echo the contents of the "text" parameter to standard output.')
      ->usesParam('headers', 'Other HTTP headers to set. This should be an indexed array of header strings, e.g. array("Location: http://example.com").')
      ->usesParam('options', 'A bitmask of JSON options. See json_encode().')
      ->usesParam('object', 'The object to convert to JSON and echo.')
      //->withFilter('string')
      ;
  }

  public function doCommand() {
    $headers = $this->param('headers', array());
    $options = $this->param('options');
    $obj = $this->param('object');

    header('Content-Type: ' . self::MIME_TYPE);

    foreach ($headers as $header) {
      header($header);
    }

    print json_encode($obj, $options);
  }
}
