<?php
namespace Cyprien;

class Autoloader
{
    static function autoload($class)
    {
        // Ignorer les classes qui ne sont pas dans le namespace Cyprien
        if (strpos($class, 'Cyprien\\') !== 0) {
            return;
        }

        $class = str_replace('Cyprien\\', "", $class);
        $class = str_replace('\\', "/", $class);
        $pathFile = 'class/' . $class . '.php';

        if (file_exists($pathFile)) {
            require $pathFile;
        }
    }

    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
}