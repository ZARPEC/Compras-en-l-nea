<?php
use Controller\UserController\UserC;

$userController = new UserC;
$user = $userController;

?>

<div class="mask d-flex align-items-center h-50 gradient-custom-3">
    <div class="container h-100 ">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body bg-light border border-primary rounded p-5">
                        <h2 class="text-uppercase text-center mb-5">Crear Cuenta</h2>

                        <form method="post" >

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" />
                                <label class="form-label" for="nombre">Nombre</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="apellido" name="apellido" class="form-control form-control-lg" />
                                <label class="form-label" for="apellido">Apellido</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" />
                                <label class="form-label" for="usuario">Usuario</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="contraseña" name="contra"
                                    class="form-control form-control-lg" />
                                <label class="form-label" for="contraseña">Contraseña</label>
                            </div>


                            <div class="d-flex justify-content-center">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Registrarse</button>
                            </div>

                            <p class="text-center text-muted mt-5 mb-0">¿Ya tienes cuenta? <a href="?action=login"
                                    class="fw-bold text-body"><u>Iniciar sesion</u></a></p>
                        </form>

                    </div>
                </div>
                <?php
                $resultado = $user->UsuarioNuevo();
                if ($resultado == "Error") {

                    echo "<div class='alert alert-danger mt-5' role='alert'>
        Error en los datos
        </div>";
                } else if ($resultado == "guardado") {
                    echo "<div class='alert alert-dismissible alert-success mt-5' role='alert'>
        Usuario creado correctamente
        </div>";
                }

                ?>
            </div>
        </div>
    </div>
</div>