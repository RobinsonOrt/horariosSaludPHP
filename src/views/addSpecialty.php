<?php
session_start();
if(!isset($_SESSION['theme'])){
    $_SESSION['theme'] = 'dracula';
}
include_once('../backEnd/controller/controllerUser.php');
include_once('../backEnd/controller/controllerSpecialty.php');
include_once('../backEnd/specialty/specialty.php');
$specialtyController = new SpecialtyController();
$listSpecialties = $specialtyController->showAllSpecialties();
$specialty = new Specialty();
$userController = new UserController();
?>
<!DOCTYPE html>
<html data-theme=<?php echo $_SESSION['theme'] ?>>
<?php include_once('../includes/head.php'); ?>

<body>
    <div class="flex justify-center content-center mt-10 ">
        <div class="my-auto flex">
            <div class="card shadow-xl">
                <h2 class="card-title text-center">AGREGAR NUEVA ESPECIALIDAD</h2>
                <hr>
                </hr>
                <form action="../backEnd/specialty/adminSpecialty.php" method="post">
                    <div class="card-body flex flex-row">

                        &nbsp;
                        <div>
                            <div class="form-control">
                                <label class="input-group input-group-vertical input-group-lg indicator">
                                    <div hidden id="errorSpecialty" class="indicator-item indicator-center badge badge-error">ESPECIALIDAD YA REGISTRADA</div>
                                    <span>Nombre de la especialidad</span>
                                    <input require type="text" id="specialtyNameID" name="specialtyName" class="input input-bordered input-lg">

                                </label>
                            </div>
                            &nbsp;
                            
                        </div>
                    </div>
                    <input disabled id="savedButton" class="btn btn-block btn-primary" name="submit" type='submit' value='Guardar'>
                    <input type='hidden' name='agregar' value='agregar'>
                </form>
                <button class="btn btn-block btn-secundary mt-2" onclick="location.href='index.php?theme=<?php echo $_SESSION['theme']?>'">Volver</button>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4stats m-4 my-auto">
            <?php
            foreach ($listSpecialties as $specialty) {
            ?>
                <div class="stat">
                    <div class="stat-title">Existen</div>
                    <div class="stat-value"><?php echo $userController->numberUsers($specialty->getId()) ?></div>
                    <div class="stat-desc">Usuarios con el rol de <?php echo $specialty->getSpecialtyName()  ?></div>
                </div>
            <?php
            }
            ?>
        
        </div>
    </div>

    <script>
        let specialtyarr = [];
        const specialty = document.getElementById('specialtyNameID');
        const sendInformation = document.getElementById('savedButton');
        const errorSpecialty = document.getElementById('errorSpecialty');

        <?php
        foreach ($listSpecialties as $specialty) {
        ?>
            specialtyarr.push("<?php echo $specialty->getSpecialtyName(); ?>".toLowerCase());
        <?php
        }
        ?>
        specialty.addEventListener('keyup', function(e) {
            if (specialtyarr.includes(specialty.value.toLowerCase().trim())) {
                errorSpecialty.hidden = false;
                sendInformation.disabled = true;

            } else {
                errorSpecialty.hidden = true;
                sendInformation.disabled = false;
            }
        });
    </script>
    <?php
    include_once("../includes/footer.php");
    ?>
</body>

</html>