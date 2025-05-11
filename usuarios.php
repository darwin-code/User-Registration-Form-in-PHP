<?php
$usuarios = [];

if (file_exists("usuarios.txt")) {
    $contenido = file("usuarios.txt");
    $usuarioTemp = [];

    foreach ($contenido as $linea) {
        if (strpos($linea, "Nombre:") !== false) {
            $usuarioTemp["nombre"] = trim(str_replace("Nombre: ", "", $linea));
        } elseif (strpos($linea, "Email:") !== false) {
            $usuarioTemp["email"] = trim(str_replace("Email: ", "", $linea));
        } elseif (strpos($linea, "Descripción:") !== false) {
            $usuarioTemp["descripcion"] = trim(str_replace("Descripción: ", "", $linea));
        } elseif (trim($linea) == "-----------------------------") {
            $usuarios[] = $usuarioTemp;
            $usuarioTemp = [];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios Registrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #eef;
        }
        .container {
            background: white;
            padding: 20px;
            width: 60%;
            margin: auto;
            box-shadow: 0 0 10px gray;
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid gray;
            padding: 10px;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            display: block;
            margin-top: 20px;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Usuarios Registrados</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Descripción</th>
            </tr>
            <?php if (!empty($usuarios)) : ?>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario["nombre"]) ?></td>
                        <td><?= htmlspecialchars($usuario["email"]) ?></td>
                        <td><?= htmlspecialchars($usuario["descripcion"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </table>
        <a href="index.php">Volver al formulario</a>
    </div>
</body>
</html>
