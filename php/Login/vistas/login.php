<?php
require_once "../controladores/Controlador.php";

// Procesar formulario de inicio de sesión si se envía
$controlador = new Controlador();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controlador->procesarFormularioLogin();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vistas/css/estilosInicio.css">
    <link rel="icon" href="vistas\css\imagenes\icono.png" type="image/x-icon">

    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="form">
        <h1>Iniciar Sesión</h1>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Correo:</label>
            <input type="text" name="username" id="username"><br>
            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña"><br>
            <input type="submit" class="submit" value="Iniciar Sesión"><br>
            <a href="registro.php">¿No tienes cuenta? Regístrate.</a><br>
        </form>
    </div>
</body>
</html>
