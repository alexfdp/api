<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('193.203.168.5', 'u708242902_eliana_154', ']5sP3hj0i#s', 'u708242902_api');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el parámetro id desde la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['id']) ? intval($data['id']) : 0;

// Verificar que id sea un número válido
if ($id > 0) {
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["message" => "Usuario eliminado con éxito"]);
        } else {
            echo json_encode(["message" => "Usuario no encontrado"]);
        }
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    // Cerrar el statement
    $stmt->close();
} else {
    echo json_encode(["message" => "ID inválido"]);
}

// Cerrar la conexión
$conn->close();
?>
