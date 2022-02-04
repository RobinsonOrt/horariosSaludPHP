<?php

require_once('../controller/controllerShifts.php');
require_once('shifts.php');

$crud  = new shiftsController();
$lastshift = $crud->getLastShift();
$nextName = "Turno ".$lastshift[0][0] + 1;
$shifts = new Shifts();

if (isset($_POST['agregar'])) {
    
    $shifts->setShiftsName($nextName);
    $shifts->setSchedule($_POST['schedule']);

    $crud->registerShifts($shifts);
    header('Location: ../../views/modifyShifts.php');
}

if (isset($_POST['update'])) {
    $shifts->setId($_POST['shiftsID']);
    $shifts->setSchedule($_POST['schedule']);

    $crud->updateShifts($shifts);
    header('Location: ../../views/modifyShifts.php');
}

?>