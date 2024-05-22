<?php
session_start();
//verificar que el usuario este identificado
if (!isset($_SESSION['usuario'])) {
    header("Location: vistas\login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vistas/css/estilosIndex.css">
    <link rel="icon" href="vistas\css\imagenes\icono.png" type="image/x-icon">
    <title>Hola</title>
</head>
<body>
    <div class="menu">
        <p>Bienvenido, <?php echo $usuario['nombre']; ?></p>
        <a href="modelos\cerrar_sesion.php">Cerrar Sesión</a>
    
</body>
</html>
