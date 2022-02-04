<?php
include_once('../controller/controllerUser.php');
include_once('../users/user.php');
$userID = $_POST['userID'];
$shift = $_POST['shift'];
$userController = new UserController();
$userController->changeShift($userID, $shift);
$user = new User();
echo "Turno ". $shift;
?>