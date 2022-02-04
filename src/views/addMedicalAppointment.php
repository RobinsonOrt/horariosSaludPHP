<?php
session_start();

if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dracula';
}
date_default_timezone_set('America/Bogota');
$dateNow = date('Y-m-d H:i');
include_once('../backEnd/controller/controllerSpecialty.php');
include_once('../backEnd/specialty/specialty.php');

include_once('../backEnd/users/user.php');
include_once('../backEnd/controller/controllerUser.php');


include_once('../backEnd/controller/controllerMedicalAppointment.php');


$specialtyController = new SpecialtyController();
$listSpecialties = $specialtyController->showSpecialtiesWithoutNurses();
$specialty = new Specialty();

$userController = new UserController();
$listUsers = $userController->showUsers();
$user = new User();

$medicalAppointmentController = new MedicalAppointmentController();
$medicalAppointmentController -> updateMedicalAppointment($dateNow);
?>
<!DOCTYPE html>
<html data-theme=<?php echo $_SESSION['theme'] ?>>
<?php include '../includes/head.php' ?>


<body class="justify-center flex w-screen h-screen">

    <div class="card shadow-xl flex my-auto">
        <h2 class="card-title text-center">AGREGAR NUEVA CITA MEDICA</h2>
        <hr>
        </hr>
        <form  action="../backEnd/medicalAppointment/adminMedicalAppointment.php" method="post">
            <div id="medical" class="p-4 flex">
                &nbsp;
                <div>
                    <h4 class="text-center text-lg font-semibold my-2">DATOS DEL PACIENTES</h4>
                    <div class="form-control">
                        <label class="input-group input-group-vertical input-group-lg indicator">
                            <span>Nombre del paciente</span>
                            <input required type="text" id="patientName" name="patientName" class="input input-bordered input-lg">

                        </label>
                    </div>
                    &nbsp;
                    <select required class="select select-bordered w-full max-w-xs" name="sex">
                        <option disabled="" selected="" value="">Sexo del paciente </option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                    &nbsp;
                    <div class="form-control">
                        <label class="input-group input-group-vertical input-group-lg indicator">
                            <span>Cedula del paciente</span>
                            <input required type="number" id="patientCitizenshipID" name="patientCitizenshipID" class="input input-bordered input-lg">
                        </label>
                    </div>
                </div>
                &nbsp;
                <div class="ml-3">

                    <h4 class="text-center text-lg font-semibold my-2">DATOS DE LA CITA</h4>
                    <div class="form-control">
                        <label class="input-group input-group-vertical input-group-lg indicator">

                            <span>Fecha</span>
                            <input required min=<?php $hoy=date("Y-m-d"); echo $hoy;?> type="date" id="dateAppointment" name="dateAppointment" class="input input-bordered input-lg">

                        </label>
                        &nbsp;
                    </div>
                    <div class="form-control">
                        <label class="input-group input-group-vertical input-group-lg indicator">

                            <span>Hora</span>
                            <input require type="time" id="timeAppointment" name="timeAppointment" class="input input-bordered input-lg">

                        </label>
                        &nbsp;
                    </div>
                    
                    <select class="select select-bordered w-full max-w-xs" id="selectSpecialty" name="specialtyID" required>
                        <option disabled="" value="" selected="" >Seleccione la especialidad </option>
                        <?php foreach ($listSpecialties as $specialty) { ?> <option value="<?php echo $specialty->getId() ?>">
                                <?php echo $specialty->getSpecialtyName() ?>
                            </option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>
            <h4 class="text-center text-lg font-semibold my-2">ESPECIALISTAS DISPONIBLES</h4>
 
                <select  class="select select-bordered w-full "  id="selectUsers" name="userID" required>
                    <option disabled="" value="" selected="" >Seleccione especialista </option>
                </select>
 
            &nbsp;
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Motivo de la cita</span>
                </label>
                <textarea name="descriptionMedicalAppointment" class="textarea h-24 textarea-bordered" placeholder="Motivo de la cita" required></textarea>
            </div>
            &nbsp;
            <input id="savedButton" class="btn btn-block btn-primary" name="submit" type='submit' value='Guardar'>
            <input type='hidden' name='agregar' value='agregar'>
        </form>
        <button class="btn btn-block btn-secundary mt-2 " onclick="location.href='index.php?theme=<?php echo $_SESSION['theme'] ?>'">Volver</button>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#medical').change(function() {
            recargarLista();
        });
    })
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "../backEnd/jquerySnippet/specialtyCall.php",
            data: {"specialty":  $('#selectSpecialty').val(), "dateAppointment": $('#dateAppointment').val(), "timeAppointment": $('#timeAppointment').val()},
            success: function(r) {
                $('#selectUsers').html(r);
            }
        })
    }

</script>


</html>