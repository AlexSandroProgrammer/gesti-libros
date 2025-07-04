<?php
session_start();
require_once("../../validation/sessionValidation.php");
require_once("../../../database/connection.php");
$db = new Database();
$connection = $db->conectar();


if (isset($_GET['libros']) && isset($_GET['documento'])) {
    
    $libros  = isset($_GET['libros']) ? $_GET['libros']   : [];
    $documento   = isset($_GET['documento']) ? $_GET['documento']: '';
    $fecha_registro = date('Y-m-d H:i:s');
    $estado = 'pendiente';
    
    $registerFact = "INSERT INTO general_prestamos(id_usuario, fecha_registro, id_estado) VALUES(:id_usuario, :fecha_registro, :id_estado)";
    $registerFacture = $connection->prepare($registerFact);
    $registerFacture->bindParam(':id_usuario', $documento);
    $registerFacture->bindParam(':fecha_registro', $fecha_registro);
    $registerFacture->bindParam(':id_estado', $estado);
    $registerFacture->execute();

    if($registerFacture){
    $ultimoIdPrestamo = $connection->lastInsertId();

    // Decodificar los libros (vienen como JSON por GET)
    $librosArray = json_decode($libros, true);

    $registroConfirmado = true;
    
    foreach($librosArray as $libro){
        
        $insertLibro = "INSERT INTO d_general_prestamo (id_general, id_libro, cantidad_prestamo, fecha_prestamo, hora_prestamo, fecha_entrega, hora_entrega, estado) VALUES (:id_general, :id_libro, :cantidad_prestamo, :fecha_prestamo, :hora_prestamo, :fecha_entrega, :hora_entrega, :estado)";
            
        $registrarPrestamo = $connection->prepare($insertLibro);
        $registrarPrestamo->bindParam(':id_general', $ultimoIdPrestamo);
        $registrarPrestamo->bindParam(':id_libro', $libro['id_libro_prestamo']);
        $registrarPrestamo->bindParam(':cantidad_prestamo', $libro['cantidad_prestamo']);
        $registrarPrestamo->bindParam(':fecha_prestamo', $libro['fecha_prestamo']);
        $registrarPrestamo->bindParam(':hora_prestamo', $libro['hora_prestamo']);
        $registrarPrestamo->bindParam(':fecha_entrega', $libro['fecha_entrega']);
        $registrarPrestamo->bindParam(':hora_entrega', $libro['hora_entrega']);
        $registrarPrestamo->bindParam(':estado', $estado);
        $registrarPrestamo->execute();
        if(!$registrarPrestamo){
            $registroConfirmado = false;
            break;
        }
    }

    if($registroConfirmado){

        $actualizacionConfirmada = true;
    
        foreach($librosArray as $libro){

            $cantidad_disponible = $libro['cantidad_disponible'];
            
            $cantidad_prestamo = $libro['cantidad_prestamo'];

            $cantidad_sobrante = $cantidad_disponible - $cantidad_prestamo;
            
            $actualizarCantidadLibro = "UPDATE libros AS l SET l.cantidad_disponible = :cantidad_disponible WHERE l.id_libro = :id_libro";
                
            $actualizarPrestamo = $connection->prepare($actualizarCantidadLibro);
            
            $actualizarPrestamo->bindParam(':cantidad_disponible', $cantidad_sobrante);

            $actualizarPrestamo->bindParam(':id_libro', $libro['id_libro_prestamo']);
            $actualizarPrestamo->execute();
            
            if(!$actualizarPrestamo){
                $actualizacionConfirmada = false;
                break;
            }
        }

        if($actualizacionConfirmada){
            echo json_encode(['status' => 'success']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Error al guardar los libros']);
        exit();
    }

    }
} else {
    echo json_encode(array(
        'status' => 'info',
    ));
    exit();
}