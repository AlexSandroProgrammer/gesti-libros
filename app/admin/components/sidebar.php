<!DOCTYPE html>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="urbes-admin-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>GestiLibro || <?php echo $titlePage ?> </title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/images/gestilibro.svg" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../../libraries/datatables/datatables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="../../libraries/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <script src="../../assets/vendor/js/helpers.js"></script>
    <script src="../../assets/js/config.js"></script>
    <script src="../../js/functions.js"></script>
    <script src="../../js/sweetalert.js"></script>
    <script src="../../assets/css/sweetalert.css"></script>
</head>

<body>
    <?php
    // iniciamos sesion para obtener los datos del usuario autenticado
    session_start();
    // validamos que el usuario este autenticado
    require_once("../../validation/sessionValidation.php");
    // creamos la conexion a la base de datos
    require_once("../../../database/connection.php");
    $db = new Database();
    $connection = $db->conectar();
    // envolvemos nuestra aplicacion el horario de colombia
    date_default_timezone_set('America/Bogota');
    // importacion de funciones
    require_once("../../functions/functions.php");
    require_once("../auto/automations.php");
    // importacion de controladores
    require_once("../controllers/index.php");
    $documento = $_SESSION['documento'];
    $documentoUserSession = $connection->prepare("SELECT * FROM usuarios WHERE documento = '$documento'");
    $documentoUserSession->execute();
    $documentoSession = $documentoUserSession->fetch(PDO::FETCH_ASSOC);
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location:../../");
        exit();
    }
    // validamos que el usuario sea administrador para ver la pagina
    if ($documentoSession['id_tipo_usuario'] !== 1) {
        // redireccionamos al login si el usuario no es administrador
        session_destroy();
        header("Location:../../");
        exit();
    }
    ?>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand text-center justify-content-center">
                    <a href="index.php" class="justify-content-center text-center items-center">
                        <img src="../../assets/images/gestilibro.svg" width="100" height="100">
                    </a>
                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <ul class="menu-inner">
                    <li class="menu-item active">
                        <a href="index.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Menu Inicial</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Gestion</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Misc">Grados</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="listar_grados.php" class="menu-link">
                                    <div data-i18n="Misc">Listar Grados</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Misc">Estudiantes</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="registrar_estudiante.php" class="menu-link">
                                    <div data-i18n="Misc">Registrar Estudiante</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="estudiantes.php" class="menu-link">
                                    <div data-i18n="Misc">Listar Estudiantes</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Misc">Libros</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="listar_libros.php" class="menu-link">
                                    <div data-i18n="Misc">Listar Libros</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Misc">Usuarios</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="registrar_usuario.php" class="menu-link">
                                    <div data-i18n="Misc">Registrar Usuario</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="listar_usuarios.php" class="menu-link">
                                    <div data-i18n="Misc">Listar Usuarios</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Misc">Prestamos</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="prestamos_pendientes.php" class="menu-link">
                                    <div data-i18n="Misc">Prestamos Pendientes</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="prestamos_realizados.php" class="menu-link">
                                    <div data-i18n="Misc">Prestamos Realizados</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="registrar_prestamo.php" class="menu-link">
                                    <div data-i18n="Misc">Registrar Prestamo</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </aside>
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../../assets/images/urbes.svg" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../../assets/images/urbes.svg" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-semibold d-block"><?php echo $_SESSION['names'] ?></span>
                                                    <small class="text-muted"><?php echo $_SESSION['rol'] ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="perfil.php">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Mi Perfil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item btn btn-outline-danger" href="index.php?logout">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Cerrar Sesion</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->