<?php
// Configuración de cabecera para JSON
header("Content-Type: application/json");

// Comprobar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Leer los datos JSON recibidos
    $input = json_decode(file_get_contents("php://input"), true);

    // Verificar que los campos 'nombre' y 'apellido' están presentes en la entrada
    if (isset($input["nombre"]) && isset($input["apellido"])) {
        $nombre = trim($input["nombre"]);
        $apellido = trim($input["apellido"]);

        // Validación del nombre: debe comenzar con "M"
        if (empty($nombre) || strtoupper($nombre[0]) !== 'M') {
            echo json_encode(["status" => "error", "message" => "El primer nombre debe comenzar con la letra M."]);
        }
        // Validación del apellido: máximo 10 caracteres
        elseif (empty($apellido) || strlen($apellido) > 10) {
            echo json_encode(["status" => "error", "message" => "El apellido debe tener como máximo 10 caracteres."]);
        } 
        // Si pasa las validaciones
        else {
            echo json_encode(["status" => "ok", "message" => "OK"]);
        }
    } else {
        // Respuesta de error si faltan parámetros
        echo json_encode(["status" => "error", "message" => "Parámetros 'nombre' y 'apellido' requeridos."]);
    }
} else {
    // Respuesta de error si no es una solicitud POST
    echo json_encode(["status" => "error", "message" => "Método no permitido. Use POST."]);
}
?>
