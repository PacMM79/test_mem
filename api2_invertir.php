<?php
// Iniciar la sesión para acceder al último dato guardado
session_start();

// Configuración de cabecera para JSON
header("Content-Type: application/json");

// Verificar que tenemos datos guardados en la sesión
if (isset($_SESSION["ultimo_dato"])) {
    $nombre = $_SESSION["ultimo_dato"]["nombre"];
    $apellido = $_SESSION["ultimo_dato"]["apellido"];

    // Invertir el nombre
    $nombre_invertido = strrev($nombre);

    // Concatenar el nombre y apellido para analizar los caracteres
    $nombre_completo = $nombre . $apellido;

    // Calcular la frecuencia de cada carácter en el nombre y apellido
    $frecuencia = [];
    foreach (str_split(strtoupper($nombre_completo)) as $caracter) {
        if (ctype_alpha($caracter)) { // Solo contar letras
            if (isset($frecuencia[$caracter])) {
                $frecuencia[$caracter]++;
            } else {
                $frecuencia[$caracter] = 1;
            }
        }
    }

    // Responder con los datos solicitados en formato JSON
    echo json_encode([
        "nombre_invertido" => $nombre_invertido,
        "frecuencia" => $frecuencia
    ]);
} else {
    // Responder con un error si no hay datos en la sesión
    echo json_encode(["status" => "error", "message" => "No se encontraron datos almacenados."]);
}
?>
