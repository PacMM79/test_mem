<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Validación</title>
</head>
<body>
    <h2>Formulario de Validación</h2>

    <?php
    // Inicializar variables para almacenar mensajes
    $mensaje = "";

    // Procesar el formulario solo si se ha enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);

        // Validación del nombre: debe empezar con "M"
        if (empty($nombre) || strtoupper($nombre[0]) !== 'M') {
            $mensaje = "Error: El primer nombre debe comenzar con la letra M.";
        }
        // Validación del apellido: máximo 10 caracteres
        elseif (empty($apellido) || strlen($apellido) > 10) {
            $mensaje = "Error: El apellido debe tener como máximo 10 caracteres.";
        } 
        // Si pasa las validaciones
        else {
            $mensaje = "OK";
        }
    }
    ?>

    <!-- Formulario HTML -->
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br><br>
        <input type="submit" value="Enviar">
    </form>

    <!-- Mostrar mensaje de resultado -->
    <?php if (!empty($mensaje)) : ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
