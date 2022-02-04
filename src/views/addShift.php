<?php
session_start();
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dracula';
}
include_once('../backEnd/controller/controllerShifts.php');
include_once('../backEnd/shifts/shifts.php');




$shiftsController = new ShiftsController();
$shift = new Shifts();
$lastshift = $shiftsController->getLastShift();
$nextName = "Turno " . $lastshift[0][0] + 1;

?>
<!DOCTYPE html>
<html data-theme=<?php echo $_SESSION['theme'] ?>>
<?php include '../includes/head.php'; ?>

<body>
    <div class="flex flex-wrap justify-center w-screen h-screen container mx-auto">

        <div class="overflow-x-auto my-auto p-2 flex flex-wrap justify-center">
            <div class="overflow-x-auto my-auto">

                <button onclick="location.href='modifyShifts.php'" class="btn btn-success btn-block"> <i class="uil uil-arrow-left"></i> VOLVER</button>
                <form id="form" action="../backEnd/shifts/adminShifts.php" method="POST">

                    <input hidden id="schud" name="schedule">
                    <input type='hidden' name='agregar' value='agregar'>
                    <input type="submit" value="GUARDAR" class="btn btn-primary btn-block my-1"> </input>

                </form>
                <table class="table w-full table-zebra">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>viernes</th>
                            <th>Sabado</th>
                            <th>Domingo</th>
                        </tr>
                    </thead>
                    <tbody id="scheduleBody">
                        <tr>
                            <th class="uppercase"><?php echo $nextName ?></th>
                            <td>
                                <select id="monday" class="select select-bordered w-full max-w-xs">
                                    <option value="d">DIA</option>
                                    <option value="n">NOCHE</option>
                                    <option value="b">DESCANSO</option>
                                </select>
                            </td>
                            <td>
                                <select id="tuesday" class="select select-bordered w-full max-w-xs">
                                    <option value="d">DIA</option>
                                    <option value="n">NOCHE</option>
                                    <option value="b">DESCANSO</option>
                                </select>
                            </td>
                            <td>
                                <select id="wednesday" class="select select-bordered w-full max-w-xs">
                                    <option value="d">DIA</option>
                                    <option value="n">NOCHE</option>
                                    <option value="b">DESCANSO</option>
                                </select>
                            </td>
                            <td>
                                <select id="thursday" class="select select-bordered w-full max-w-xs">
                                    <option value="d">DIA</option>
                                    <option value="n">NOCHE</option>
                                    <option value="b">DESCANSO</option>
                                </select>
                            </td>
                            <td>
                                <select id="friday" class="select select-bordered w-full max-w-xs">
                                    <option value="d">DIA</option>
                                    <option value="n">NOCHE</option>
                                    <option value="b">DESCANSO</option>
                                </select>
                            </td>
                            <td>
                                <select id="saturday" class="select select-bordered w-full max-w-xs">

                                    <option value="d">DIA</option>
                                    <option value="n">NOCHE</option>
                                    <option value="b">DESCANSO</option>
                                </select>
                            </td>
                            <td>
                                <select id="sunday" class="select select-bordered w-full max-w-xs">
                                    <option value="d">DIA</option>
                                    <option value="n">NOCHE</option>
                                    <option value="b">DESCANSO</option>

                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <script>
            var day;
            $(document).ready(function() {
                $('#scheduleBody').on('change', function() {
                    loadDay();
                });
                document.getElementById("saturday").selectedIndex = 2;
                document.getElementById("sunday").selectedIndex = 2;
                document.getElementById("schud").value = "dddddbb";

            });

            function loadDay() {
                monday = $('#monday').val();
                tuesday = $('#tuesday').val();
                wednesday = $('#wednesday').val();
                thursday = $('#thursday').val();
                friday = $('#friday').val();
                saturday = $('#saturday').val();
                sunday = $('#sunday').val();
                if (monday == 'n') {
                    document.getElementById("tuesday").selectedIndex = 2;
                    document.getElementById("tuesday").disabled = true;
                } else {
                    document.getElementById("tuesday").disabled = false;
                }

                if (tuesday == 'n') {
                    document.getElementById("wednesday").selectedIndex = 2;
                    document.getElementById("wednesday").disabled = true;
                } else {
                    document.getElementById("wednesday").disabled = false;
                }

                if (wednesday == 'n') {
                    document.getElementById("thursday").selectedIndex = 2;
                    document.getElementById("thursday").disabled = true;
                } else {
                    document.getElementById("thursday").disabled = false;
                }

                if (thursday == 'n') {
                    document.getElementById("friday").selectedIndex = 2;
                    document.getElementById("friday").disabled = true;
                } else {
                    document.getElementById("friday").disabled = false;
                }

                if (friday == 'n') {
                    document.getElementById("saturday").selectedIndex = 2;
                    document.getElementById("saturday").disabled = true;
                } else {
                    document.getElementById("saturday").disabled = false;
                }

                if (saturday == 'n') {
                    document.getElementById("sunday").selectedIndex = 2;
                    document.getElementById("sunday").disabled = true;
                } else {
                    document.getElementById("sunday").disabled = false;
                }

                if (sunday == 'n') {
                    document.getElementById("monday").selectedIndex = 2;
                    document.getElementById("monday").disabled = true;
                } else {
                    document.getElementById("monday").disabled = false;
                }
                day = [monday, tuesday, wednesday, thursday, friday, saturday, sunday];
                let count = 0;
                day.forEach(function(element) {
                    if (element == 'b') {
                        count++;
                    }
                });
                if (count < 2) {
                    document.getElementById("sunday").selectedIndex = 2;
                    document.getElementById("saturday").selectedIndex = 2;
                }

                document.getElementById("schud").value = day.join("").toString();

                setTimeout(loadDay, 500);
            }
        </script>

</body>

</html>