<?php
namespace Fortissimo\Commons\JSON;
/**
 * Load a JSON file into the context.
 */

/**
 * Load a JSON file from the filesystem into the context.
 *
 * Internally, this uses file_get_contents, so you can use streams as 
 * well.
 *
 * This is optimized for files under 1M in size.
 *
 * Params:
 * - filename: (required) The name of the file to load.
 * - useIncludePath: (false) Whether to use the include path when 
 * searching for the file.
 * - streamContext: (null) A PHP stream context for the file.
 * - outputAsArray: (false) Whether to parse the JSON data into an array 
 * instead of an object.
 *
 * Reserved for future:
 *
 * - parserOpts: A bitmask of options to pass into the JSON decoder. See 
 * json_decode() for details.
 */
class LoadFile extends \Fortissimo\Command\Base {
  public function expects() {
    return $this
      ->description("Load a file and try to parse it as JSON.")
      ->usesParam("filename", "The full path to the file.")->whichIsRequired()
      ->usesParam("streamContext", "An optional stream context to be passed into the file reader.")
      ->usesParam("useIncludePath", "Whether to search the include path for the file.")
        ->whichHasDefault(FALSE)
      ->usesParam("outputAsArray", "Return the data as an array instead of an object (default: False)")
        ->whichHasDefault(FALSE)
      // ->usesParam("parserOptions", "Bitmask options to pass to json_decode.")->whichHasDefault(NULL)
      ;
  }

  public function doCommand() {
    $file = $this->param("filename");
    $useIncludePath = $this->param("useIncludePath", FALSE);
    $streamContext = $this->param("streamContext", NULL);

    $opts = $this->param("parserOptions", NULL);
    $asArray = $this->param("outputAsArray", FALSE);

    $lines = file_get_contents($file, $useIncludePath, $streamContext);
    $jsonData = json_decode($lines, $asArray);

    return $jsonData;
  }

}

