<?php
    $appoimentID = $_GET['appoimentID'];
    $userID = $_GET['userID'];
    include_once('../controller/controllerMedicalAppointment.php');
    $controllerMedicalAppointment = new MedicalAppointmentController();
    $controllerMedicalAppointment->updateMedicalAppointmentById($appoimentID);
    $location = 'Location: ../../views/configUser.php?userID='.$userID;
    header($location);
    
?>