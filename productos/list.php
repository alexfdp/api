<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('193.203.168.5', 'u708242902_eliana_154', ']5sP3hj0i#s', 'u708242902_api');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el parámetro id_usuario desde la URL
$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

// Verificar que id_usuario no sea 0 y sea un número válido
if ($id_usuario > 0) {
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($productos);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    // Cerrar el statement
    $stmt->close();
} else {
    echo json_encode(["message" => "ID de usuario inválido"]);
}

// Cerrar la conexión
$conn->close();