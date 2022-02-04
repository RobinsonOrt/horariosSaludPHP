<?php
require_once('../controller/controllerUser.php');
require_once('user.php');
session_start();
$crud  = new UserController();
$user = new User();
if (isset($_POST['agregar'])) {
    $user->setUserName($_POST['userName']);
    $user->setUserLastName($_POST['userLastName']); 
    $user->setSpecialtyID($_POST['specialtyID']);
    $user->setProfessionalLicenseNumber($_POST['professionalLicenseNumber']);
    $user->setCitizenshipId($_POST['citizenshipID']);
    $user->setPhoneNumber($_POST['phoneNumber']);
    $user->setUserEmail($_POST['userEmail']);
    $user->setUserAvailability(1);
    $user->setUserImage(file_get_contents($_FILES['userImage']['tmp_name']));
    $user->setShiftsID($_POST['shiftsID']);
    $crud -> registerUser($user);
    $location = 'Location: ../../views/index.php?theme='.$_SESSION['theme'];
    header($location);
}
?>