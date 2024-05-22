<?php
// Definir variables y establecer valores predeterminados
$nombre = $apellidos = $username = $genero = $fecha_nacimiento = "";
$errors = [];


//Funcion para eliminar los espacios en blanco
function validarCampo($campo){
    $campo = trim($campo);
    return $campo;
}

//Funcion para validar que dos usuarios no tengan el mismo correo
function validar_usuario($username){
    $conexionBD = new Conexion();
    $conexion = $conexionBD->getConexion();
    $query = "SELECT * FROM usuarios WHERE username = ?";//consulta SQL que se utilizará para verificar si existe un usuario con el nombre de usuario especificado
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    return $num_rows > 0;
}

//Funcion que registra un usuario nuevo
function registrar_usuario($nombre, $apellidos, $username, $password, $genero, $fecha_nacimiento){
    $conexionBD = new Conexion();
    $conexion = $conexionBD->getConexion();
    // Encriptar la contraseña proporcionada por el usuario usando MD5 de 64 bits
    $contraseña = hash("md5", $password);
    $query = "INSERT INTO usuarios (username, contraseña,  nombre, apellidos, genero, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $username, $contraseña, $nombre, $apellidos, $genero, $fecha_nacimiento);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

?>