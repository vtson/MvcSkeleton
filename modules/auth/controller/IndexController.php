<?php
namespace Modules\Auth\Controller;

use Cores\Controller;

class IndexController extends Controller {
    public function __construct($_module, $_controller, $_action)
    {
        parent::__construct($_module, $_controller, $_action);
    }

    public function init(){
        echo 'init';
    }

    public function registerAction(){
        echo 'register';
    }
}