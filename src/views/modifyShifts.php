<?php
session_start();
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dracula';
}
require_once('../backEnd/controller/controllerShifts.php');
require_once('../backEnd/shifts/shifts.php');

$shiftsController = new ShiftsController();
$shifts = new Shifts();
$listShifts = $shiftsController->showAllShifts();

?>
<!DOCTYPE html>
<html data-theme=<?php echo $_SESSION['theme'] ?>>
<?php include '../includes/head.php'; ?>

<body>
<button onclick="location.href='index.php?theme=<?php echo $_SESSION['theme']?>'" class="btn btn-success btn-block"> <i class="uil uil-arrow-left"></i> VOLVER</button>

    <div class="flex flex-wrap justify-center w-screen h-screen container mx-auto">
        <?php
        foreach ($listShifts as $shift) {
        ?>
            <div class="my-auto p-2 flex flex-wrap justify-center">
                <button onclick="location.href='individualShift.php?shiftsID=<?php echo $shift -> getId() ?>'" class="btn btn-wide btn-lg m-3"><?php echo $shift->getShiftsName() ?></button>
            </div>
        <?php
        }
        ?>
        <div class="my-auto p-2 flex flex-wrap justify-center">
            <button onClick="location.href='addShift.php'" class="btn btn-wide btn-lg m-3">Agregar turno</button>
        </div>
    </div>

</body>

</html>