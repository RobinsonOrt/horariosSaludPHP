<?php
session_start();
$theme = "dracula";
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
    $_SESSION['theme'] = $theme;
}
$_SESSION['theme'] = $theme;

?>
<!DOCTYPE html>
<html data-theme=<?php echo $theme ?>>
<?php include '../includes/head.php' ?>

<body>
    <div class="navbar mb-2 bg-base-300 rounded-box">
        <div class="flex-1 px-2 lg:flex-none">
            <a class="text-lg font-bold">
                GESTOR DE CITAS Y HORARIOS
            </a>
        </div>

        <div class="flex justify-end flex-1 px-2">
            <div class="flex justify-end  px-2">
            <div id="clock" class=" font-bold text-lg " onload="loadClock();"></div> 
            </div>
            <div class="flex items-stretch">
                <div class="dropdown dropdown-end">
                    <div tabindex="0" class="btn btn-ghost rounded-btn"><i class="uil uil-swatchbook"> &nbsp; </i>Temas </div>
                    <form action="" method="POST">
                        <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                            <li>
                                <a href="index.php?theme=cmyk">cmyk</a>
                            </li>
                            <li>
                                <a href="index.php?theme=dracula">Dracula</a>
                            </li>
                            <li>
                                <a href="index.php?theme=dark">Dark</a>
                            </li>
                            <li>
                                <a href="index.php?theme=luxury">Luxury</a>
                            </li>
                            <li>
                                <a href="index.php?theme=forest">forest</a>
                            </li>
                        </ul>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class=" flex flex-wrap justify-center  md:container md:mx-auto w-screen h-screen">
        <a class="my-auto p-2 zoom" href="addUser.php">
            <div class="card bordered  w-56 ">
                <figure>
                    <img src="../../img/doctors.svg">
                </figure>
                <div class="card-body">
                    <h2 class="card-title uppercase">Agregar Especialista</h2>
                </div>
            </div>
        </a>
        <a class="my-auto p-2 zoom" href="addSpecialty.php">
            <div class="card bordered  w-56 ">
                <figure>
                    <img src="../../img/AddSpecialty.svg">
                </figure>
                <div class="card-body">
                    <h2 class="card-title uppercase">Agregar Especialidad</h2>
                </div>
            </div>
        </a>
        <a class="my-auto p-2 zoom" href="showUsers.php">
            <div class="card bordered w-56">
                <figure>
                    <img src="../../img/ListUsers.svg">
                </figure>
                <div class="card-body">
                    <h2 class="card-title uppercase">Listar Especialistas</h2>
                </div>
            </div>
        </a>
        <a class="my-auto p-2 zoom" href="addMedicalAppointment.php">
            <div class="card bordered w-56">
                <figure>
                    <img src="../../img/CitaMedica.svg">
                </figure>
                <div class="card-body">
                    <h2 class="card-title uppercase">Generar cita medica</h2>
                </div>
            </div>
        </a>
        <a class="my-auto p-2 zoom " href="modifyShifts.php">
            <div class="card bordered w-56">
                <figure>
                    <img src="../../img/shifts.svg">
                </figure>
                <div class="card-body">
                    <h2 class="card-title uppercase">Modificar Turnos</h2>
                </div>
            </div>
        </a>

    </div>
    <script src="../js/clock.js"></script>
</body>

</html>