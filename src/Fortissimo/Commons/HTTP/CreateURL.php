<?php
namespace Fortissimo\Commons\HTTP;

/**
 * Create a base URL that can be used for generating links back to this site.
 */
class CreateURL extends \Fortissimo\Command\Base {
  public function expects() {
    return $this
      ->description("Create a URL to this server.")
      ->usesParam('path', 'The path relative to the domain name. If NULL, the current path is used.')
      ->usesParam('query', 'The query params. If this is an array, it will be formatted into a string.')
      ->usesParam('forceSSL', 'Force the returned URL to SSL.')
        ->withFilter('boolean')
        ->whichHasDefault(FALSE)
      ->andReturns('The URL')
      ;
  }

  public function doCommand() {
    $root = $this->baseURL();
    $path = $this->path();
    $query = $this->buildQuery();

    return $root . $path . $query;
  }

  protected function baseURL() {
    $proto = 'http';
    if ($this->param('forceSSL') == TRUE || !empty($_SERVER['HTTPS'])) {
      $proto .= 's';
    }

    if(empty($_SEVER['HTTP_HOST'])) {
      $hostname = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['SERVER_ADDR'];
    }
    else {
       $hostname = $_SERVER['HTTP_HOST'];
    }

    return $proto . '://' . $hostname . '/'; 
  }

  protected function path() {
    $path = $this->param('path', NULL);
    if (!isset($path)) {
      if (isset($_SERVER['PATH_INFO'])) {
        $path = $_SERVER['PATH_INFO'];
      }
      else {
        $uri = $_SERVER['REQUEST_URI'];
        $path = substr($uri, 0, strpos($uri, '?'));
      }
    }
    if (strpos($path, '/') === 0) {
      $path = substr($path, 1);
    }

    return $path;
  }

  protected function buildQuery() {
    $q = $this->param('query');

    if (!isset($q)) {
      return '';
    }

    if(is_array($q)) {
      $q = http_build_query($q);
    }

    return '?' . $q;
  }

}

