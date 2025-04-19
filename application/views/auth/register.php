<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestamos</title>
    <!--========================================
        Fuentes - Tipo de letra - Iconografia
    ==========================================-->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url("assets/static/images/favicon/favicon.png") ?>" type="image/x-icon">
    <!--========================================
    STYLES CSS
    ==========================================-->
    <link rel="stylesheet" href="<?= base_url("assets/static/css/auth/fontawesome.css") ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="<?= base_url("assets/static/css/style.css") ?>">
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
                    <img src="<?= base_url("assets/static/images/backgrounds/1.png") ?>" alt="">
                </div>
                <!-- Slide 3 -->
                <div class="slide fade">
                    <img src="<?= base_url("assets/static/images/backgrounds/3.jpg") ?> " alt="">
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
                    <h1 class="titulo"><img src="<?= base_url("assets/static/images/favicon/logoc.png") ?>" alt=""
                            class="log_free">
                    </h1>
                    <h1 class="titulo_login">Registrarme </h1>
                    <p class="descripcion">Ingresa tus credenciales para continuar.</p>
                    <!-- Tabs -->
                    <ul class="tabs-links">
                    </ul>
                    <!--========================================
                        Formulario login
                    ==========================================-->
                    <form method="post" action="<?= base_url('welcome/register') ?>" autocomplete="off" id="formLogin"
                        class="formulario active">
                        <input type="email" autofocus placeholder="Ingresa tu mail" class="input-text" name="email"
                            required>
                        <input type="text" placeholder="Ingresa tus nombres" class="input-text" name="names" required>
                        <input type="text" placeholder="Ingresa tus apellidos" class="input-text" name="surnames"
                            required>
                        <input type="number" placeholder="Ingresa tu documento" class="input-text" name="id" required>
                        <input type="hidden" name="id_type_user" value="1">
                        <input type="hidden" name="id_state" value="1">
                        <div class="grupo-input">
                            <input type="password" placeholder="Ingresa tu contraseña" name="password"
                                class="input-text clave" title="Debe tener de 6 a 12 digitos" required
                                onkeyup="espacios(this)" minlength="6" maxlength="100">
                            <button type="button" class="icono fas fa-eye mostrarClave"></button>
                        </div>
                        <input class="btn" type="submit" name="iniciarSesion" value="Registrarme">
                        <?php
                        if ($this->session->flashdata('success')) {
                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
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