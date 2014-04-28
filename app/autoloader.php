<?php
namespace App\Autoloader
{ 
  class Autoloader
  {
    public function __construct(){}

    public static function autoload($file)
    {
      $file = str_replace('\\', '/', $file);
      $path = $_SERVER['DOCUMENT_ROOT'];
      $filepath = $_SERVER['DOCUMENT_ROOT'] . '/' . $file . '.php';

      if (file_exists($filepath))
      {
        require_once($filepath); 
      }
      else
      { 
        $flag = true;
        Autoloader::recursive_autoload($file, $path, $flag);
      }
    }

    public static function recursive_autoload($file, $path, $flag)
    {
      if (FALSE !== ($handle = opendir($path)) && $flag)
      {
        while (FAlSE !== ($dir = readdir($handle)) && $flag)
        {
          
          if (strpos($dir, '.') === FALSE)
          {
            $path2 = $path .'/' . $dir;
            $filepath = $path2 . '/' . $file . '.php';

            if (file_exists($filepath))
            {
              $flag = FALSE;
              require_once($filepath);
              break;
            }
            Autoloader::recursive_autoload($file, $path2, $flag); 
          }
        }
        closedir($handle);
      }
    }
    
  }
  \spl_autoload_register('App\Autoloader\Autoloader::autoload');
}