<?php
use Controller\UserController\UserC;

$userController = new UserC;
$user = $userController;


?>

<div class=" row justify-content-center">
    <div class="w-50 bg-light border border-primary rounded p-5" >
        <form method="post" >
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="usuario" name="usuario" class="form-control" />
                <label class="form-label" for="usuario">usuario</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="contraseña" name="password" class="form-control" />
                <label class="form-label" for="contraseña">Contraseña</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Recordar </label>
                    </div>
                </div>

                <div class="col">
                    <!-- Simple link -->
                    <a href="#!">¿Olvidó su contraseña?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Iniciar sesion</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>¿No tiene cuenta? <a href="?action=signUp">Registrarse</a></p>
                
            </div>
            <?php
            $user->login()
            ?>
        </form>
    </div>
</div>