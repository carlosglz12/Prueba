<?php
include __DIR__ . "/../config/conexion.php";

function buscar($username, $contraseña) {
    $conexionBD = new Conexion();
    $conexion = $conexionBD->getConexion();

    // consulta SQL para buscar al usuario por su nombre de usuario
    $query = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    // Obtener el resultado de la consulta
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró un usuario con el nombre de usuario dado
    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Obtener la contraseña encriptada almacenada en la base de datos
        $contraseña_usuario = $row['contraseña'];

        // Encriptar la contraseña proporcionada por el usuario usando MD5 de 64 bits
        $contraseña_ingresada = hash("md5", $contraseña);

        // Convertir el hash generado y el hash almacenado a minúsculas o mayúsculas
        $contraseña_ingresada = strtolower($contraseña_ingresada); 
        $contraseña_usuario = strtolower($contraseña_usuario); 

        // Verificar si la contraseña proporcionada coincide con la almacenada
        if ($contraseña_ingresada === $contraseña_usuario) {
            // Las credenciales son correctas, devuelve los datos del usuario
            return [
                "id" => $row["id"],
                "username" => $row["username"],
                "nombre" => $row["nombre"],
            ];
        }
    }
    // Si no se encontró el usuario o la contraseña no coincide, devuelve false
    return false;        
}

?>
