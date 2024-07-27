<?php

// $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// $data = json_decode(file_get_contents('php://input'), true);

// $nombre = isset($data['nombre']) ? $data['nombre'] : '';
// $id_data = isset($data['id']) ? intval($data['id']) : 0;
// $descripcion = isset($data['descripcion']);
// $id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

// if ($id > 0 && empty($nombre)) {
//     include 'usuarios/read.php';
// }

// if ($id == 0 && !empty($nombre) && $id_data == 0 && empty($descripcion)) {
//     include 'usuarios/create.php';
// }

// if ($id_data > 0 && empty($nombre)) {
//     include 'usuarios/delete.php';
// }

// if ($id_data > 0 && !empty($nombre)) {
//     include 'usuarios/update.php';
// }

// if (!empty($descripcion)) {
//     include 'productos/create.php';
// }

// if (empty($descripcion) && $id_usuario) {
//     include 'productos/list.php';
// }

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //header("HTTP/1.1 404 Not Found");
    echo 'ok todo';
    exit();
} else {
    echo 'ok nada';
}