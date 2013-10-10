<?php
namespace Fortissimo\Commons\HTTP;

class ForceSSL extends \Fortissimo\Command\Base {
  const tpl = 'Location: https://%s%s';
  public function expects() {
    return $this
      ->description("Force the client to use SSL to access this route.")
      ->usesParam('force', 'If this is true, the redirect is forced. Otherwise, noop.')
        ->withFilter('boolean')
        ->whichHasDefault(TRUE)
      ->andReturns("Nothing. Issues a 301 redirect.")
      ;
  }
  public function doCommand() {
    if ($this->param('force') === TRUE) {
      return;
    }
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off') {
      $host = empty($_SERVER['HTTP_HOST']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
      $redirect = sprintf(self::tpl, $host, $_SERVER['REQUEST_URI']);

      header($redirect, true, 301);
      throw new \Fortissimo\Interrupt("Redirect to HTTPS.");
    } 
  }
}
