<?php
namespace Cores;
use Cores\View;
class Route{
    public function router($url){
        $urlArr = explode(DS,ltrim($url,DS));

        $module = !empty($urlArr[0] ?? '') ? ucwords($urlArr[0]) : DEFAULT_MODULE;

        $controller = (empty($urlArr[1] ?? '') || count($urlArr) <= 2 ) ? DEFAULT_CONTROLLER : ucwords($urlArr[1]) . 'Controller';

        $action = !empty($urlArr[2] ?? '') ? $urlArr[2] . 'Action' : (!empty($urlArr[1] ?? '') ? $urlArr[1] . 'Action' : DEFAULT_ACTION);

        $urlArr = array_slice($urlArr, 3);

        $params = $urlArr;

        $controller = 'Modules\\' . $module . '\\' . 'Controller' . '\\' . $controller;
        if(!class_exists($controller)){
            $this->setPageError('PageNotFound');
        }else{
            $dispatch = new $controller($module, $controller, $action);
            if(method_exists($controller, 'init')){
                call_user_func_array([$dispatch, 'init'], $params);
            }
            if(method_exists($controller, $action)){
                call_user_func_array([$dispatch, $action],$params);
            }else{
                $this->setPageError('PageNotFound');
            }
        }
    }

    private function setPageError($pageName){
        $view = new View();
        $view->render($pageName, true);
    }
}