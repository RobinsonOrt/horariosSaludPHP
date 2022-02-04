<?php
include_once('../controller/controllerUser.php');
include_once('../users/user.php');
$userID = $_POST['userID'];
$availabity = $_POST['availabity'];
$userController = new UserController();
$user = new User();

if ($availabity == 1) {
    $userController->changeAvailability($userID, 1);
    echo "<p class='text-green-700'>Disponible</p>";
} else {
    echo "<p class='text-red-700'>No disponible </p>";
    $userController->changeAvailability($userID, 0);
}
