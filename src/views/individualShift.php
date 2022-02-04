<?php
session_start();
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dracula';
}
include_once('../backEnd/controller/controllerShifts.php');
include_once('../backEnd/shifts/shifts.php');

$shiftsController = new ShiftsController();
$shift = new Shifts();

$shiftsID = $_GET['shiftsID'];
?>
<!DOCTYPE html>
<html data-theme=<?php echo $_SESSION['theme'] ?>>
<?php include '../includes/head.php'; ?>

<body>
    <?php

    $schedule = $shiftsController->showShiftById($shiftsID);
    $schedulex =  $schedule[0][2];

    ?>
    <div class="flex flex-wrap justify-center w-screen h-screen container mx-auto">

        <div class="overflow-x-auto my-auto p-2 flex flex-wrap justify-center">
            <div class="overflow-x-auto my-auto">

                <button onclick="location.href='modifyShifts.php'" class="btn btn-success btn-block"> <i class="uil uil-arrow-left"></i> VOLVER</button>
                <form id="form" action="../backEnd/shifts/adminShifts.php" method="POST">
                    <input hidden  name="shiftsID" value="<?php echo $shiftsID ?>">
                    <input  hidden id="schud" name="schedule" >
                    <input type='hidden' name='update' value='update'>
                    <input type="submit" value="GUARDAR" class="btn btn-primary btn-block my-1">  </input>
                    
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
                            <th class="uppercase"><?php echo $schedule[0][1] ?></th>
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

                                    <option  value="d">DIA</option>
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

                
                var mondayDataBase = "<?php echo $schedulex[0] ?>";
                var tuesdayDataBase = "<?php echo $schedulex[1] ?>";
                var wednesdayDataBase = "<?php echo $schedulex[2] ?>";
                var thursdayDataBase = "<?php echo $schedulex[3] ?>";
                var fridayDataBase = "<?php echo $schedulex[4] ?>";
                var saturdayDataBase = "<?php echo $schedulex[5] ?>";
                var sundayDataBase = "<?php echo $schedulex[6] ?>";
                day = [mondayDataBase, tuesdayDataBase, wednesdayDataBase, thursdayDataBase, fridayDataBase, saturdayDataBase, sundayDataBase];
                document.getElementById("schud").value = day.join("").toString();
                switch (mondayDataBase) {
                    case 'd':
                        document.getElementById("monday").selectedIndex = 0;
                        break;
                    case 'n':
                        document.getElementById("monday").selectedIndex = 1;
                        break;
                    case 'b':
                        document.getElementById("monday").selectedIndex = 2;
                        document.getElementById("monday").disabled = true;

                        break;
                }
                switch (tuesdayDataBase) {
                    case 'd':
                        document.getElementById("tuesday").selectedIndex = 0;
                        break;
                    case 'n':
                        document.getElementById("tuesday").selectedIndex = 1;
                        break;
                    case 'b':
                        document.getElementById("tuesday").selectedIndex = 2;
                        document.getElementById("tuesday").disabled = true;
                        break;
                }
                switch (wednesdayDataBase) {
                    case 'd':
                        document.getElementById("wednesday").selectedIndex = 0;

                        break;
                    case 'n':
                        document.getElementById("wednesday").selectedIndex = 1;
                        break;
                    case 'b':
                        document.getElementById("wednesday").selectedIndex = 2;
                        document.getElementById("wednesday").disabled = true;

                        break;
                }
                switch (thursdayDataBase) {
                    case 'd':
                        document.getElementById("thursday").selectedIndex = 0;
                        break;
                    case 'n':
                        document.getElementById("thursday").selectedIndex = 1;
                        break;
                    case 'b':
                        document.getElementById("thursday").selectedIndex = 2;
                        document.getElementById("thursday").disabled = true;

                        break;
                }
                switch (fridayDataBase) {
                    case 'd':
                        document.getElementById("friday").selectedIndex = 0;
                        break;
                    case 'n':
                        document.getElementById("friday").selectedIndex = 1;
                        break;
                    case 'b':
                        document.getElementById("friday").selectedIndex = 2;
                        document.getElementById("friday").disabled = true;
                        break;
                }
                switch (saturdayDataBase) {
                    case 'd':
                        document.getElementById("saturday").selectedIndex = 0;
                        break;
                    case 'n':
                        document.getElementById("saturday").selectedIndex = 1;
                        break;
                    case 'b':
                        document.getElementById("saturday").selectedIndex = 2;
                        document.getElementById("saturday").disabled = true;
                        break;
                }
                switch (sundayDataBase) {
                    case 'd':
                        document.getElementById("sunday").selectedIndex = 0;
                        break;
                    case 'n':
                        document.getElementById("sunday").selectedIndex = 1;
                        break;
                    case 'b':
                        document.getElementById("sunday").selectedIndex = 2;
                        document.getElementById("sunday").disabled = true;
                        break;
                }
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
