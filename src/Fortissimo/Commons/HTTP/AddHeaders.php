<?php
namespace Fortissimo\Commons\HTTP;

/**
 * Set HTTP header information.
 *
 * Headers are not actively sent until the first byte of the body is written
 * or the request is done. So this command can be followed by another that
 * changes headers.
 *
 * This command MUST be used before any body data is sent to the client.
 *
 * Params:
 * - 'code': An HTTP response code. By default this is 200 (OK).
 * - 'headers': An associative array of headers. HEADERS ARE NOT ENCODED. The
 *   HTTP spec is vague as to how we ought to encode headers, so we don't
 *   presume to know how you want your headers encoded.
 */
class AddHeaders extends \Fortissimo\Command\Base {
  public function expects() {
    return $this
      ->description('Set header information for an HTTP response.')
      ->usesParam('code', 'HTTP error code')->withFilter('int')->whichHasDefault(200)
      ->usesParam('headers', 'HTTP headers')
      ->andReturns('Nothing.')
      ;
  }
  public function doCommand() {
    $code = $this->param('code', 200);
    $headers = $this->param('headers', array());

    if ($code != 200) {
      $this->setStatusCode($code);
    }
    foreach ($headers as $name => $value) {
      $header = $name . ': ' . $value;
      header($header, true);
    }
  }

  protected function setStatusCode($code) {
    if (function_exists('http_response_code')) {
      http_response_code($code);
    }
    else {
      // Hack for older PHP's.
      header('X-Fortissimo-Commons: true', false, $code);
    }
  }
}
