<?php
//  REGISTRO DE GRADO
if ((isset($_POST["MM_formRegisterGrade"])) && ($_POST["MM_formRegisterGrade"] == "formRegisterGrade")) {
    // VARIABLES DE ASIGNACION DE VALORES QUE SE ENVIA DEL FORMULARIO REGISTRO DE GRADO
    $grado = $_POST['grado'];

    // validamos que no hayamos recibido ningun dato vacio
    if (isEmpty([$grado])) {
        showErrorFieldsEmpty("listar_grados.php");
        exit();
    }
    
    // CONSULTA SQL PARA VERIFICAR SI EL REGISTRO YA EXISTE EN LA BASE DE DATOS
    $existGrade = $connection->prepare("SELECT * FROM grados WHERE grado = :grado");
    $existGrade->bindParam(':grado', $grado);
    $existGrade->execute();
    $queryGrade = $existGrade->fetchAll();
    // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
    if ($queryGrade) {
        // Si ya existe una grado con ese nombre entonces cancelamos el registro y le indicamos al usuario
        showErrorOrSuccessAndRedirect("error", "Error de registro", "El grado ya esta registrado.", "listar_grados.php");
        exit();
    } else {
        // Inserta los datos en la base de datos
        $registerGrade = $connection->prepare("INSERT INTO grados(grado) VALUES(:grado)");
        $registerGrade->bindParam(':grado', $grado);
        $registerGrade->execute();
        if ($registerGrade) {
            showErrorOrSuccessAndRedirect("success", "Registro Exitoso", "Los datos se han registrado correctamente", "listar_grados.php");
            exit();
        } else {
            showErrorOrSuccessAndRedirect("error", "Error de registro", "Error al momento de registrar los datos, por favor intentalo nuevamente", "listar_grados.php");
            exit();
        }
    }
}