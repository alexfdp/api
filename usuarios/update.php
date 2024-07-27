<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('193.203.168.5', 'u708242902_eliana_154', ']5sP3hj0i#s', 'u708242902_api');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los parámetros desde la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['id']) ? intval($data['id']) : 0;
$nombre = isset($data['nombre']) ? $conn->real_escape_string($data['nombre']) : '';
$email = isset($data['email']) ? $conn->real_escape_string($data['email']) : '';
$password = isset($data['password']) ? $conn->real_escape_string($data['password']) : '';

// Verificar que id sea un número válido
if ($id > 0 && !empty($nombre) && !empty($email) && !empty($password)) {
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $email, $password, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["message" => "Usuario actualizado con éxito"]);
        } else {
            echo json_encode(["message" => "Usuario no encontrado o sin cambios"]);
        }
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    // Cerrar el statement
    $stmt->close();
} else {
    echo json_encode(["message" => "Datos inválidos"]);
}

// Cerrar la conexión
$conn->close();
?>

