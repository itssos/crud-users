<?php

require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\userController;

if(isset($_POST['user_action'])){
    $userController = new userController();
    if($_POST['user_action']=="register"){
        echo $userController->registerUserController();
    }
}else{
    session_destroy();
    header("Location: ".APP_URL."login/");
}