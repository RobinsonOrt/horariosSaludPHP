<?php
session_start();
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dracula';
}
include_once('../backEnd/controller/controllerUser.php');
include_once('../backEnd/users/user.php');
include_once('../backEnd/controller/controllerSpecialty.php');

include_once('../backEnd/specialty/specialty.php');
include_once('../backEnd/controller/controllerShifts.php');
include_once('../backEnd/shifts/shifts.php');

$specialtyController = new SpecialtyController();
$specialty = new Specialty();
$userController = new UserController();
$listUsers = $userController->showAllUsers();
$user = new User();


$shiftsController = new ShiftsController();
$listShiftsAll = $shiftsController->showAllShifts();
$shifts = new Shifts();
?>
<!DOCTYPE html>
<html data-theme=<?php echo $_SESSION['theme'] ?>>
<?php include '../includes/head.php'; ?>

<body id="cambia">
    <div class="overflow-x-auto">
    <button onclick="location.href='index.php?theme=<?php echo $_SESSION['theme']?>'" class="btn btn-success btn-block"> <i class="uil uil-arrow-left"></i> VOLVER</button>
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Turno</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listUsers as $user) {
                ?>
                    <tr>
                        <td>
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <div class="w-12 h-12 mask mask-squircle">
                                        <img src="data:image/jpg;base64, <?php echo base64_encode($user->getUserImage()); ?>" alt="Imagen especialista">
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">
                                        <?php echo $user->getUserName() ?> <?php echo $user->getUserLastName() ?>
                                    </div>
                                    <div class="text-sm opacity-90">
                                        <?php if ($user->getUserAvailability() == 1) {
                                            echo "<p class='text-green-700'>Disponible</p>";
                                        } else {
                                            echo "<p class='text-red-700'>No disponible </p>";
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php
                            $specialtyID = $user->getSpecialtyID();
                            $listSpecialties = $specialtyController->getSpecialty($specialtyID);
                            foreach ($listSpecialties as $specialty) {
                                $specialtyName = $specialty->getSpecialtyName();
                            }
                            ?>
                            <?php echo $specialtyName; ?>
                        </td>
                        <td>
                            <?php
                            $shiftsID = $user->getShiftsID();
                            $listShifts = $shiftsController->showShiftById($shiftsID);
                            $shiftsName = $listShifts[0][1];
                            ?>
                            <?php echo $shiftsName; ?> &nbsp;

                        </td>
                        <th>
                            <button onclick="location.href='configUser.php?userID=<?php echo $user->getId() ?>'" class="btn btn-primary btn-lg">Configurar</button>
                        </th>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>

                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Turno</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>