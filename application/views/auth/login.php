<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WWS || Inicio de Sesion</title>
    <!--========================================
        Fuentes - Tipo de letra - Iconografia
    ==========================================-->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url("assets/images/favicon/favicon.png") ?>" type="image/x-icon">
    <!--========================================
    STYLES CSS
    ==========================================-->
    <link rel="stylesheet" href="<?= base_url("assets/css/auth/fontawesome.css") ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="<?= base_url("assets/css/auth/style.css") ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--========================================
       contenido
    ==========================================-->
    <div class="contenedor-login">
        <!--========================================
            Slider
         ==========================================-->
        <div class="contenedor-slider">
            <div class="slider">
                <!-- Slide 1 -->
                <div class="slide fade">
                    <img src="<?= base_url("assets/images/slide_1.svg") ?>" alt="">
                </div>
                <!-- Slide 2 -->
                <div class="slide fade">
                    <img src="<?= base_url("assets/images/slide_2.svg") ?>" alt="">
                </div>
                <!-- Slide 3 -->
                <div class="slide fade">
                    <img src="<?= base_url("assets/images/slide_3.svg") ?>" alt="">
                </div>

            </div>

            <!-- Botones next y prev -->
            <a href="#" class="prev"><i class="fas fa-chevron-left"></i></a>
            <a href="#" class="next"><i class="fas fa-chevron-right"></i></a>
            <!-- dots -->
            <div class="dots">
            </div>
        </div>
        <!--========================================
            Formularios
        ==========================================-->
        <div class="contenedor-texto">
            <div class="contenedor-form">
                <div class="container-center">
                    <h1 class="titulo"><img src="<?= base_url("assets/images/favicon/logo.png") ?>" alt=""
                            class="log_free">
                    </h1>
                    <h1 class="titulo_login">Iniciar sesion </h1>
                    <p class="descripcion">Bienvenido usuario/a, ingresa por favor tus credenciales para continuar.</p>
                    <!-- Tabs -->
                    <ul class="tabs-links">
                    </ul>
                    <!--========================================
                        Formulario login
                    ==========================================-->
                    <form method="post" action="<?= base_url('welcome/login') ?>" autocomplete="off" id="formLogin"
                        class="formulario active">
                        <input type="email" autofocus placeholder="Ingresa tu mail" class="input-text" name="email"
                            required>
                        <div class="grupo-input">
                            <input type="password" placeholder="Ingresa tu contraseña" name="password"
                                class="input-text clave" title="Debe tener de 6 a 12 digitos" required
                                onkeyup="espacios(this)" minlength="6" maxlength="100">
                            <button type="button" class="icono fas fa-eye mostrarClave"></button>
                        </div>
                        <input class="btn" type="submit" name="iniciarSesion" value="Iniciar Sesion">
                        <?php
                        if ($this->session->flashdata('error')) {
                        ?>
                        <script>
                        Swal.fire({
                            title: 'Error!',
                            text: '<?= $this->session->flashdata('error') ?>',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                        </script>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--========================================
       Mis Scripts
    ==========================================-->
    <script src="<?= base_url("assets/static/js/login.js") ?>"></script>
    <script>
    // FUNCION QUE NO PERMITE INGRESAR ESPACIOS
    function espacios(e) {
        e.value = e.value.replace(/ /g, '');
    }
    </script>

</body>

</html>