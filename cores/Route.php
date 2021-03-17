<?php
namespace Cores;
use Cores\View;
class Route{
    public function router($url){
        $urlArr = explode(DS,ltrim($url,DS));

        $module = !empty($urlArr[0] ?? '') ? ucwords($urlArr[0]) : DEFAULT_MODULE;

        $controller = !empty($urlArr[1] ?? '') ? ucwords($urlArr[1]) . 'Controller' : DEFAULT_CONTROLLER;

        $action = !empty($urlArr[2] ?? '') ? $urlArr[2] . 'Action' : DEFAULT_ACTION;

        $urlArr = array_slice($urlArr, 3);

        $params = $urlArr;

        $controller = 'modules\\' . $module . '\\' . 'Controller' . '\\' . $controller;

        if(!class_exists($controller)){
            include_once ROOT . DS . 'errorDirection' . DS . 'PageNotFound.php';
            return;
        }else{
            $dispatch = new $controller($module, $controller, $action);
            if(method_exists($controller, $action)){
                call_user_func_array([$dispatch, $action],$params);
            }else{
                include_once ROOT . DS . 'errorDirection' . DS . 'PageNotFound.php';
            }
        }
    }
}