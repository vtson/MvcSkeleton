<?php
namespace Cores;
use Cores\Application;
use Cores\View;

class Controller extends Application {
    protected $_module, $_controller, $_action;
    public $view;

    public function __construct($_module, $_controller, $_action)
    {
        parent::__construct();
        $this->_controller = $_controller;
        $this->_module = $_module;
        $this->_action = $_action;
        $this->view = new View();
        $this->view->module = $_module;
    }

    protected function requestParams(){
        return $_POST;
    }

    protected function requestParam($paramName){
        return $_POST[$paramName] ?? '';
    }
}