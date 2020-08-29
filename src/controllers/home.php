<?php

namespace App\Controllers;

use Jaw\GauntCore\Controller;

class homeController extends Controller {
    
    public function index(){
        return $this->render();
    }

    public function videos(){

        $this->setTemplate('home/index');

        return $this->render();
    }

    public function error404(){
        return $this->render();
    }
}