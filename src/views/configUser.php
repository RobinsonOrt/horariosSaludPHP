<?php
session_start();
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dracula';
}
include_once('../backEnd/users/user.php');
include_once('../backEnd/controller/controllerUser.php');
include_once('../backEnd/controller/controllerShifts.php');
include_once('../backEnd/controller/controllerMedicalAppointment.php');
include_once('../backEnd/shifts/shifts.php');
include_once('../backEnd/medicalAppointment/medicalAppointment.php');
include_once('../backEnd/controller/controllerShifts.php');
include_once('../backEnd/shifts/shifts.php');
include_once('../backEnd/controller/controllerSpecialty.php');
include_once('../backEnd/specialty/specialty.php');
$specialtyController = new SpecialtyController();
$specialty = new Specialty();
$userID = $_GET['userID'];
$controllerUser = new UserController();
$shifts = new Shifts();
$controllerMedicalAppointment = new MedicalAppointmentController();
$medicalAppointment = new MedicalAppointment();
$userData = $controllerUser->searchUser(NULL, NULL, $userID);
$shiftsController = new ShiftsController();
$listShiftsAll = $shiftsController->showAllShifts();
?>
<html data-theme=<?php echo $_SESSION['theme'] ?>>

<head>
    <?php include '../includes/head.php'; ?>
</head>

<body>
    <?php
    foreach ($userData as $user) {
    ?>


        <div class="filter drop-shadow-lg  min-h-screen flex justify-center items-center shadow-xl">
        
            <div class="flex flex-col lg:flex-row w-full justify-center gap-7">

                <div class="bg-white w-full lg:w-1/3 p-10 rounded-lg order-2 lg:order-first">

                    <button class="btn " onclick="location.href='showUsers.php'">  <i class="uil uil-arrow-left"></i> VOLVER</button>
                    <h1 class="text-gray-700 font-bold tracking-wider">Citas del especialista</h1>
                    <div class="my-10">

                        <?php
                        $medicalAppointmentList = $controllerMedicalAppointment->showUserHourByID($userID);
                        if (!empty($medicalAppointmentList)) {
                            foreach ($medicalAppointmentList as $medicalAppointment) { ?>
                                <div id="CitaId" class="flex justify-between items-center mt-2">
                                    <div class="flex justify-items-start gap-3 items-stretch">
                                        <div class="bg-green-200 w-4"></div>
                                        <div>
                                            <h1 class="font-bold text-gray-700"><?php echo $medicalAppointment->getPatientName() ?></h1>
                                            <p class="text-sm text-gray-500"><?php echo $medicalAppointment->getAppointmentDay() ?></p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-error" onclick="location.href='../backEnd/medicalAppointment/cancelAppointment.php?appoimentID=<?php echo $medicalAppointment->getId() ?>&userID=<?php echo $userID ?>'">cancelar cita</button>

                                    </div>
                                </div>

                            <?php }
                        } else { ?>
                            <div class="alert alert-info">
                                <div class="flex-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <label>El especialista no tiene citas</label>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>
                <div class="w-full lg:w-1/5 order-1 lg:order-last flex flex-col justify-start gap-7">
                    <div class="bg-white p-2 rounded-lg text-center">
                        <img src="data:image/jpg;base64, <?php echo base64_encode($user->getUserImage()); ?>" class="h-20 w-full object-cover content-center rounded-t-lg" />
                        <div class="flex justify-center">
                            <img src="data:image/jpg;base64, <?php echo base64_encode($user->getUserImage()); ?>" class="w-20 h-20 rounded-full object-cover content-center -mt-10 border-4 border-white" />
                        </div>
                        <h1 class="text-center font-bold tracking-wider text-gray-700 mt-4"><?php echo $user->getUserName() . " " .  $user->getUserLastName()  ?></h1>
                        <p class="text-gray-500 mt-1 text-center">
                            <?php
                            $specialtyID = $user->getSpecialtyID();
                            $listSpecialties = $specialtyController->getSpecialty($specialtyID);
                            foreach ($listSpecialties as $specialty) {
                                $specialtyName = $specialty->getSpecialtyName();
                            }
                            ?>
                            <?php echo $specialtyName; ?></p>
                        <div id="availabityDiv">
                            <?php if ($user->getUserAvailability() == 1) {
                                echo "<p class='text-green-700'>Disponible</p>";
                            } else {
                                echo "<p class='text-red-700'>No disponible </p>";
                            } ?>
                        </div>

                        <br />

                        <select id="availabity" class="select select-bordered w-full max-w-xs">
                            <option disabled="disabled" selected="selected">Cambiar disponibilidad</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>
                    </div>
                    <div class="bg-white rounded-lg p-6">
                        <h1 class="font-bold tracking-wider text-gray-800">Cambiar Horario</h1>
                        <p class="text-sm text-gray-500 mt-2">
                            Horario Actual:
                            <?php
                            $shiftsID = $user->getShiftsID();
                            $listShift = $shiftsController->showShiftById($shiftsID);
                            $shiftsName = $listShift[0][1];
                            ?>

                            <span id="actualityShift">
                                <?php
                                echo $shiftsName; ?> &nbsp;
                            </span>

                        </p>
                        <div class="my-4 flex justify-between gap-5">
                            <select id="shift" class="select select-bordered w-full max-w-xs">
                                <option disabled="disabled" selected="selected">Cambiar turno</option>
                                <?php foreach ($listShiftsAll as $shifts) { ?> <option value="<?php echo $shifts->getId() ?>">
                                        <?php echo $shifts->getShiftsName() ?>
                                    </option>
                                <?php }
                                ?>
                            </select>

                        </div>
                        <p hidden id="userID"> <?php echo $userID ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</body>
<script>
    $(document).ready(function() {
        $('#shift').change(function() {
            changeShift();
        });
        $('#availabity').change(function() {
            changeAvailabity();
        });
    })

    function changeShift() {
        $.ajax({
            type: "POST",
            url: "../backEnd/jquerySnippet/changeUserShift.php",
            data: {
                "shift": $('#shift').val(),
                "userID": $('#userID').text()
            },
            success: function(r) {
                $('#actualityShift').html(r);
            }
        })
    }

    function changeAvailabity() {
        $.ajax({
            type: "POST",
            url: "../backEnd/jquerySnippet/changeAvailabity.php",
            data: {
                "userID": $('#userID').text(),
                "availabity": $('#availabity').val()
            },
            success: function(r) {
                $('#availabityDiv').html(r);
            }
        })
    }
</script>


</html>