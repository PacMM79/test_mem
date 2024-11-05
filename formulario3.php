<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Validación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #333;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
            text-align: left;
        }

        input[type="text"] {
            width: 95%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
            color: #dc3545; /* Rojo para errores */
        }

        .success {
            color: #28a745; /* Verde para éxito */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Formulario de Validación</h2>

        <!-- Formulario HTML -->
        <form method="post" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            <input type="submit" value="Enviar">
        </form>

        <!-- Mostrar mensaje de resultado -->
        <?php
        function procesarFormulario() {
            // Inicializar variable para almacenar el mensaje
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

            return $mensaje;
        }

        $resultado = procesarFormulario();
        if (!empty($resultado)) : ?>
            <p class="message <?php echo ($resultado === "OK") ? 'success' : ''; ?>">
                <?php echo $resultado; ?>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>
