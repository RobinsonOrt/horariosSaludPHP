<?php

require_once('../controller/controllerMedicalAppointment.php');
require_once('medicalAppointment.php');

$medicalAppointmentController = new MedicalAppointmentController();
$medicalAppointment = new MedicalAppointment();

if (isset($_POST['agregar'])) {
    $appointmentDay = $_POST['dateAppointment']. " " .$_POST['timeAppointment'];
    $medicalAppointment->setUserID($_POST['userID']);
    $medicalAppointment->setSpecialtyID($_POST['specialtyID']);
    $medicalAppointment->setAppointmentDay($appointmentDay);
    $medicalAppointment->setPatientName($_POST['patientName']);
    $medicalAppointment->setPatientCitizenshipID($_POST['patientCitizenshipID']);
    $medicalAppointment->setSex($_POST['sex']);
    $medicalAppointment->setDescriptionMedicalAppointment($_POST['descriptionMedicalAppointment']);
    $medicalAppointment->setAppointmentAvailability('1');

    $medicalAppointmentController->registerMedicalAppointment($medicalAppointment);
    header('Location: ../../views/index.php');
    
}



?>