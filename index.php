<?php
function registrarUsuario($nombre, $correo, $descripcion) {
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return "Correo inválido.";
    }

    $archivo = fopen("usuarios.txt", "a");

    if ($archivo) {
        fwrite($archivo, "Nombre: $nombre\n");
        fwrite($archivo, "Email: $correo\n");
        fwrite($archivo, "Descripción: $descripcion\n");
        fwrite($archivo, "-----------------------------\n");
        fclose($archivo);
        return "Usuario registrado con éxito.";
    }
    return "Error al guardar el usuario.";
}

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : "";
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : "";
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : "";

    if (!empty($nombre) && !empty($correo) && !empty($descripcion)) {
        $mensaje = registrarUsuario($nombre, $correo, $descripcion);
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen parcial 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #eef;
        }
        .container {
            background: white;
            padding: 20px;
            width: 40%;
            margin: auto;
            box-shadow: 0 0 10px gray;
            border-radius: 10px;
        }
        input, textarea, button {
            width: 90%;
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .mensaje {
            font-weight: bold;
            color: #218838;;
        }
        .enlace {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <textarea name="descripcion" placeholder="Escribe una breve descripción sobre ti" required></textarea>
            <button type="submit">Registrar</button>
        </form>
        <div class="mensaje"><?= $mensaje; ?></div>
        <div class="enlace">
            <a href="usuarios.php">Ver usuarios registrados</a>
        </div>
    </div>
</body>
</html>
