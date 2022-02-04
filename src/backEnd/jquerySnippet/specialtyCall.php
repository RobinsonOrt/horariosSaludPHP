<?php
require_once('../controller/controllerUser.php');
require_once('../controller/controllerMedicalAppointment.php');
require_once('../users/user.php');
require_once('../medicalAppointment/medicalAppointment.php');
require_once('../shifts/shifts.php');
require_once('../controller/controllerShifts.php');
$specialty = $_POST['specialty'];
$appointmentDay = $_POST['dateAppointment'] . " " . $_POST['timeAppointment'];

$userController = new UserController();
$medicalAppointmentController = new MedicalAppointmentController();
$shiftsController = new ShiftsController();
$listMedicalAppointment = $medicalAppointmentController->showUserHour($appointmentDay, $specialty);


$result = '<option disabled="" selected="">Seleccione especialista </option>';

$listUser = $userController->showUserSpecialty($specialty);
foreach ($listUser as $user) {
    $listMedicalAppointment = $medicalAppointmentController->showUserHourByID($user->getId());
    $schedule = $shiftsController->showShiftById($user->getShiftsID());
    $bussyUsers = false;
    $schedulex =  $schedule[0][2];
    $hourNumber = date('H', strtotime($appointmentDay));
    $dayNumber =  date('N', strtotime($appointmentDay)) - 1;
    $hor = 'default';
    
    if($hourNumber >= '06' && $hourNumber < '18'){
        $hor = "d";
    }else{
        $hor = "n";
    }
    if ($schedulex[$dayNumber] == "b") {
        $bussyUsers = true;
    }elseif ($schedulex[$dayNumber] == $hor) {
        if (!empty($listMedicalAppointment)) {
            foreach ($listMedicalAppointment as $medicalAppointment) {
                $appointmenthour = $medicalAppointment->getAppointmentDay();
                $dataBaseAppointment = date_create($appointmenthour);
                $resetDataBaseAppointment = date_format($dataBaseAppointment, 'Y-m-d H:i');
                $dateForm = new DateTime($resetDataBaseAppointment);
                $dateForm->modify('+30 minute');
                $nextDataBaseApp =  $dateForm->format('Y-m-d H:i');
                if ($appointmentDay >= $resetDataBaseAppointment && $appointmentDay < $nextDataBaseApp) {
                    $bussyUsers = true;
                }
            }
        }
    }else{
        $bussyUsers = true;
    }
    if ($bussyUsers == false) {
        $result .= '<option value="' . $user->getId() . '">' . $user->getUserName() . " " . $user->getUserLastName() . '</option>';
    }
}
echo $result;
