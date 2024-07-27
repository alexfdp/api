<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', 'Contra_2001005025126.', 'ejercicio');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el parámetro id desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar que id sea un número válido
if ($id > 0) {
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            echo json_encode($usuario);
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
