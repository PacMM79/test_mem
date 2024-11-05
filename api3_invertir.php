<?php
// Iniciar la sesión para acceder al último dato guardado
session_start();

// Configuración de cabecera para JSON
header("Content-Type: application/json");

// Definir el parámetro de control (cambiar a FALSE si se necesita solo imprimir)
$devolver_invertido = TRUE;

// Verificar que tenemos datos guardados en la sesión
if (isset($_SESSION["ultimo_dato"])) {
    $nombre = $_SESSION["ultimo_dato"]["nombre"];
    $apellido = $_SESSION["ultimo_dato"]["apellido"];

    // Invertir el nombre
    $nombre_invertido = strrev($nombre);

    // Calcular la frecuencia de cada carácter en el nombre y apellido
    $nombre_completo = $nombre . $apellido;
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

    // Responder según el valor de $devolver_invertido
    if ($devolver_invertido) {
        // Devolver en formato JSON con nombre invertido y frecuencia
        echo json_encode([
            "nombre_invertido" => $nombre_invertido,
            "frecuencia" => $frecuencia
        ]);
    } else {
        // Imprimir el nombre invertido sin formato JSON
        echo $nombre_invertido;
    }
} else {
    // Responder con un error si no hay datos en la sesión
    echo json_encode(["status" => "error", "message" => "No se encontraron datos almacenados."]);
}
?>
