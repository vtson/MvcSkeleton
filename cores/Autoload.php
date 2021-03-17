<?php
    require_once ROOT.DS.'config'.DS.'config.php';

    function autoload($class){
        $classes = explode(DS, str_replace('\\', DS, $class));
        $className = array_pop($classes);
        $pathDir = strtolower(implode(DS, $classes));
        $directory = ROOT.DS.$pathDir.DS.$className.'.php';
        if(file_exists($directory)){
            require_once $directory;
        }
    }
    spl_autoload_register('autoload');

    use Cores\Db;
    use Cores\Route;

    $db = Db::getInstance();
    $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    $route = new Route();
    $route->router($url);