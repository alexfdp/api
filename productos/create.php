<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'api');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos enviados en la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se han recibido los datos necesarios
if (isset($data['nombre']) && isset($data['descripcion']) && isset($data['precio']) && isset($data['id_usuario'])) {
    $nombre = $data['nombre'];
    $descripcion = $data['descripcion'];
    $precio = $data['precio'];
    $id_usuario = $data['id_usuario'];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, id_usuario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id_usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["message" => "Producto creado con éxito"]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    // Cerrar el statement
    $stmt->close();
} else {
    echo json_encode(["message" => "Datos incompletos"]);
}

// Cerrar la conexión
$conn->close();