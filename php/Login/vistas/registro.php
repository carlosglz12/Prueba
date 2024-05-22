<?php
require_once "../controladores/Controlador.php";

// Procesar formulario de registro si se envía
$controlador = new Controlador();
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = $controlador->procesarFormularioRegistro();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vistas/css/estilosInicio.css">
    <link rel="icon" href="vistas\css\imagenes\icono.png" type="image/x-icon">

    <title>Registro</title>
</head>
<body>
    <div class="form">
        <h2>Registrar Usuario</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>"><br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>"><br>
            <label for="username">Correo Electrónico:</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña"><br>
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" name="confirmar_contraseña" id="confirmar_contraseña"><br>
            <label for="genero">Género:</label>
            <select name="genero" id="genero">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                <option value="X">Prefiero no especificar</option>
            </select><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>"><br>
            <input type="submit" value="Registrarse" class="submit">
        </form>
        <?php
        // Mostrar errores si los hay
        if (!empty($errors)) {
            echo "<div class='error'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        }
        ?>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
    </div>
</body>
</html>
