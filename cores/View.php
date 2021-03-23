<?php
namespace Cores;
class View{
    public $_title, $_module, $_outputBuffer, $_body;


    public function render($viewName, $error){
        $layoutPath = ROOT . DS . 'resources' . DS . 'mainLayout.php';
        $viewArr = explode("/", $viewName);
        $viewName = implode(DS, $viewArr);
        $parentViewPath = $error ? 'errorDirection' : 'modules' . DS . strtolower($this->_module) .  'views';
        $viewPath = ROOT . DS . $parentViewPath . DS . $viewName . '.php';
        if(file_exists($viewPath)){
            include $viewPath;
            include $layoutPath;
            return $this;
        }else{
            die('view not exits');
        }
    }

    public function startBody($type){
        $this->_outputBuffer = $type;
        ob_start();
    }

    public function endBody(){
        $this->_body = ob_get_clean();
    }


    public function setTitle($title){
        $this->_title = $title;
    }

    public function siteTitle(){
        return $this->_title;
    }

    public function siteBody(){
        return $this->_body;
    }
}