<?php
//  REGISTRO DE GRADO
if ((isset($_POST["MM_formRegisterLibrary"])) && ($_POST["MM_formRegisterLibrary"] == "formRegisterLibrary")) {
    // VARIABLES DE ASIGNACION DE VALORES QUE SE ENVIA DEL FORMULARIO REGISTRO DE GRADO
    $nombre_libro = $_POST['nombre_libro'];
    $descripcion_libro = $_POST['descripcion_libro'];
    $codigo_libro = $_POST['codigo_libro'];
    $cantidad_total = $_POST['cantidad_total'];

    // validamos que no hayamos recibido ningun dato vacio
    if (isEmpty([$nombre_libro, $descripcion_libro, $codigo_libro, $cantidad_total])) {
        showErrorFieldsEmpty("registrar_libro.php");
        exit();
    }

    // VALIDACION DE IMAGEN
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $fileTmpPath = $_FILES['imagen']['tmp_name'];
        $fileName = $_FILES['imagen']['name'];
        $fileSize = $_FILES['imagen']['size'];
        $fileType = $_FILES['imagen']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            if ($fileSize <= 10 * 1024 * 1024) { // 10 MB en bytes
                $uploadFileDir = '../assets/img/';
                // Normalizamos el nombre del libro para el nombre de la imagen
                $nombreImagen = 'libro_' . strtolower(str_replace(' ', '_', $nombre_libro)) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $nombreImagen;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // CONSULTA SQL PARA VERIFICAR SI EL REGISTRO YA EXISTE EN LA BASE DE DATOS
                    $existLibrary = $connection->prepare("SELECT * FROM libros AS l WHERE l.nombre_libro = :nombre_libro");
                    $existLibrary->bindParam(':nombre_libro', $nombre_libro);
                    $existLibrary->execute();
                    $queryLibrary = $existLibrary->fetchAll();

                    if ($queryLibrary) {
                        // Si ya existe un libro con ese nombre
                        showErrorOrSuccessAndRedirect("error", "Error de registro", "El libro ya esta registrado, por favor verifica los datos.", "registrar_libro.php");
                        exit();
                    } else {
                        // Inserta los datos en la base de datos
                        $registerLibrary = $connection->prepare("INSERT INTO libros(nombre_libro, codigo_libro, cantidad_total, cantidad_disponible, detalle, imagen) VALUES(:nombre_libro, :codigo_libro, :cantidad_total, :cantidad_disponible,  :descripcion_libro, :imagen)");
                        $registerLibrary->bindParam(':nombre_libro', $nombre_libro);
                        $registerLibrary->bindParam(':codigo_libro', $codigo_libro);
                        $registerLibrary->bindParam(':cantidad_total', $cantidad_total);
                        $registerLibrary->bindParam(':cantidad_disponible', $cantidad_total);
                        $registerLibrary->bindParam(':descripcion_libro', $descripcion_libro);
                        $registerLibrary->bindParam(':imagen', $nombreImagen);
                        $registerLibrary->execute();

                        if ($registerLibrary) {
                            showErrorOrSuccessAndRedirect("success", "Registro Exitoso", "Los datos se han registrado correctamente", "listar_libros.php");
                            exit();
                        } else {
                            showErrorOrSuccessAndRedirect("error", "Error de registro", "Error al momento de registrar los datos, por favor intentalo nuevamente", "registrar_libro.php");
                            exit();
                        }
                    }
                } else {
                    showErrorOrSuccessAndRedirect("error", "Error de carga", "Hubo un problema al subir la imagen.", "registrar_libro.php");
                    exit();
                }
            } else {
                showErrorOrSuccessAndRedirect("error", "Imagen muy grande", "La imagen debe pesar menos de 10MB.", "registrar_libro.php");
                exit();
            }
        } else {
            showErrorOrSuccessAndRedirect("error", "Formato no permitido", "Solo se permiten archivos JPG, JPEG, PNG.", "registrar_libro.php");
            exit();
        }
    } else {
        showErrorOrSuccessAndRedirect("error", "Error de imagen", "No se ha cargado ninguna imagen válida.", "registrar_libro.php");
        exit();
    }
}