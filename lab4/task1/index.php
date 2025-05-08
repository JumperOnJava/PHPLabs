<?php
include("autoload.php");

use Controllers\UserController;
use Models\UserModel;
use Views\UserView;

$model = new UserModel();
$controller = new UserController($model);
$view = new UserView($model);

$controller->setUserName("Олександр");
$view->render();
