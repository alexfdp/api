<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('193.203.168.5', 'u708242902_eliana_154', ']5sP3hj0i#s', 'u708242902_api');

// Obtener los datos enviados en la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se han recibido los datos necesarios
if (isset($data['nombre']) && isset($data['email']) && isset($data['password'])) {
    $nombre = $data['nombre'];
    $email = $data['email'];
    $password = $data['password'];

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    if ($conn->query($query) === TRUE) {
        echo json_encode(["message" => "Usuario creado con éxito"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["message" => "Datos incompletos"]);
}

$conn->close();
