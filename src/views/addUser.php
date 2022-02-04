<?php
session_start();
if(!isset($_SESSION['theme'])){
    $_SESSION['theme'] = 'dracula';
}
include_once('../backEnd/controller/controllerSpecialty.php');
include_once('../backEnd/controller/controllerUser.php');

include_once('../backEnd/specialty/specialty.php');
include_once('../backEnd/users/user.php');
$specialtyController = new SpecialtyController();
$listSpecialties = $specialtyController->showAllSpecialties();
$specialty = new Specialty();

include_once('../backEnd/shifts/shifts.php');
include_once('../backEnd/controller/controllerShifts.php');
$shiftsController = new ShiftsController();
$listShifts = $shiftsController->showAllShifts();
$shifts = new Shifts();


$userController = new UserController();
$listUsers = $userController->showAllUsers();
$user = new User();
?>

<!DOCTYPE html>
<html data-theme=<?php echo $_SESSION['theme'] ?>>
<?php include '../includes/head.php'; ?>

<body>

    <div class=" flex flex-wrap justify-center  md:container md:mx-auto w-screen h-screen">
        <a class="my-auto ">
            <div class="card shadow-xl  ">
                <h2 class="card-title text-center">AGREGAR NUEVO USUARIO</h2>
                <hr>
                </hr>
                <form id="formDispacher" action="../backEnd/users/adminUser.php" method="post" enctype="multipart/form-data">
                    <div class="card-body flex flex-row">

                        &nbsp;
                        <div>
                            <div class="form-control">
                                <label class="input-group input-group-vertical input-group-lg">
                                    <span>Nombres</span>
                                    <input require type="text" name="userName" class="input input-bordered input-lg">

                                </label>
                            </div>
                            &nbsp;

                            <div class="form-control">
                                <label class="input-group input-group-vertical input-group-lg">
                                    <span>Apellidos</span>
                                    <input require type="text" name="userLastName" class="input input-bordered input-lg">
                                </label>
                            </div>
                            &nbsp;

                            <select name="specialtyID" class="select select-bordered w-full max-w-xs" required>
                                <option disabled="disabled" selected="selected" value="">Seleccione su especialidad</option>
                                <?php foreach ($listSpecialties as $specialty) { ?> <option value="<?php echo $specialty->getId() ?>">
                                    <?php echo $specialty->getSpecialtyName() ?>
                                    </option>
                                <?php }
                                ?>
                            </select>
                            &nbsp;

                            <div class="form-control ">
                                <label class="input-group input-group-vertical input-group-lg indicator">
                                    <div hidden id="errorLicenseNumber" class="indicator-item indicator-center badge badge-error">LICENCIA YA REGISTRADA</div>
                                    <span>Numero de licencia profecional</span>
                                    <input require id="professionalLicenseNumber" type="text" name="professionalLicenseNumber" class="input input-bordered input-lg">
                                </label>
                            </div>
                        </div>

                        <div class="ml-4">
                            <div class="form-control">
                                <label class="input-group input-group-vertical input-group-lg indicator">
                                    <div hidden id="errorCitizenship" class="indicator-item indicator-center badge badge-error">IDENTIFICACIÓN YA REGISTRADA</div>
                                    <span>Identificacion del Usuario</span>
                                    <input require id="citizenshipID" type="text" name="citizenshipID" class="input input-bordered input-lg">
                                </label>
                            </div>
                            &nbsp;

                            <div class="form-control">
                                <label class="input-group input-group-vertical input-group-lg">
                                    <span>Telefono</span>
                                    <input require type="text" name="phoneNumber" class="input input-bordered input-lg">
                                </label>
                            </div>
                            &nbsp;

                            <div class="form-control">
                                <label class="input-group input-group-vertical input-group-lg">
                                    <span>Correo</span>
                                    <input require type="email" name="userEmail" class="input input-bordered input-lg">
                                </label>
                            </div>
                            &nbsp;

                            <select class="select select-bordered w-full max-w-xs" name="shiftsID" required>
                                <option disabled="disabled" selected="selected" value="">Seleccione el turno</option>
                                <?php foreach ($listShifts as $shifts) { ?> <option value="<?php echo $shifts->getId() ?>">
                                    <?php echo $shifts->getShiftsName() ?>
                                    </option>
                                <?php }
                                ?>
                            </select>


                        </div>
                    </div>


                    <div class="grid grid-cols-1 mt-5 mb-5 mx-7">
                        <label class="uppercase md:text-sm text-xs font-semibold mb-1">foto de perfil (max 500KB)</label>
                        <div class='flex items-center justify-center w-full'>
                            <label class='flex flex-col border-4 border-dashed w-full h-32 hover:border-purple-300 group'>
                                <div class='flex flex-col items-center justify-center pt-7'>
                                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>
                                        Selecciona un foto</p>

                                </div>
                                <input type='file' name='userImage' class="hidden" required />
                            </label>
                        </div>
                    </div>
                    <input disabled id="savedButton" class="btn btn-block btn-primary " name="submit" type='submit' value='Guardar'>
                    <input type='hidden' name='agregar' value='agregar'>

                </form>
            </div>
            <button class="btn btn-block btn-secundary mt-2 " onclick="location.href='index.php?theme=<?php echo $_SESSION['theme']?>'">Volver</button>
    </div>
    </a>
    </div>
    <script>
        let professionalLicenseNumberList = [];
        let citizenshipIDList = [];
        const professionalLicenseNumber = document.getElementById('professionalLicenseNumber');
        const citizenshipID = document.getElementById('citizenshipID');
        const errorLicenseNumber = document.getElementById('errorLicenseNumber');
        const errorCitizenship = document.getElementById('errorCitizenship');
        const savedButton = document.getElementById('savedButton');
        const formDispacher = document.getElementById('formDispacher');
        <?php
        foreach ($listUsers as $user) {
        ?>
            professionalLicenseNumberList.push("<?php echo $user->getProfessionalLicenseNumber(); ?>".toLowerCase());
            citizenshipIDList.push("<?php echo $user->getCitizenshipID(); ?>");
        <?php
        }
        ?>
        formDispacher.addEventListener('keyup', function(e) {
            if (professionalLicenseNumberList.includes(professionalLicenseNumber.value.toLowerCase().trim())) {
                errorLicenseNumber.hidden = false;
            } else {
                errorLicenseNumber.hidden = true;
            }

            if (citizenshipIDList.includes(citizenshipID.value.trim())) {
                errorCitizenship.hidden = false;
            } else {
                errorCitizenship.hidden = true;
            }
            if(citizenshipID.value.trim() != "" && professionalLicenseNumber.value.trim() != ""){
                if(errorCitizenship.hidden && errorLicenseNumber.hidden){
                    savedButton.disabled = false;
                }
            }
        });
    </script>
</body>

</html>