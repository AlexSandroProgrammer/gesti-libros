<?php
session_start();
require_once("../../validation/sessionValidation.php");
require_once("../../../database/connection.php");
$db = new Database();
$connection = $db->conectar();


if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];
        $query = "SELECT u.documento, u.nombres, u.apellidos, u.celular, g.grado, u.tipo_documento FROM usuarios AS u INNER JOIN grados AS g ON u.id_grado = g.id_grado WHERE u.documento = :documento;";
        $queryUser = $connection->prepare($query);
        $queryUser->bindParam(':documento', $documento, PDO::PARAM_INT);
        $queryUser->execute();
        $user = $queryUser->fetch(PDO::FETCH_ASSOC);

        // Verificar si la consulta devuelve resultados
        if (empty($user)) {
        echo json_encode(array(
            'status' => 'error',
        ));
        exit();
        }
        echo json_encode(array(
            'status' => 'success',
            'user' => $user
        ));
        exit();
} else {
    echo json_encode(array(
        'status' => 'info',
    ));
    exit();
}