<?php

namespace app\controllers;
use app\models\viewsModel;

class viewsController extends viewsModel{
    public function getControllerViews($view){
        if($view != ""){
            $response = $this->getModelViews($view);
        }else{
            $response = "login";
        }
        return $response;
    }
}