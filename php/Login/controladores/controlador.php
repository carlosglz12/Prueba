<?php
require_once "../modelos/inicio_usuario.php";
require_once "../modelos/registrar_usuario.php";

class Controlador {
    public function procesarFormularioLogin() {
        global $error; //variable para los errores obtenidos

        if ($_SERVER["REQUEST_METHOD"] == "POST") { //validar que el metodo sea de envio
            $username = $_POST["username"];
            $contraseña = $_POST["contraseña"];
            
            $usuario = buscar($username, $contraseña);
            //si el usuario es encontrado nos mandará al index de lo contrario se mostrará el mensaje de error
            if ($usuario !== false) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: ../index.php");
                exit();
            } else {
                $error = "Nombre de usuario o contraseña incorrectos.";
            }
        }
    }
        
    public function procesarFormularioRegistro() {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener datos del formulario
            $nombre = validarCampo($_POST["nombre"]);
            $apellidos = validarCampo($_POST["apellidos"]);
            $username = validarCampo($_POST["username"]);
            $contraseña = $_POST["contraseña"];
            $confirmar_contraseña = $_POST["confirmar_contraseña"];
            $genero = validarCampo($_POST["genero"]);
            $fecha_nacimiento = $_POST["fecha_nacimiento"];

            //validar que se haya ingresado correctamente un correo
            if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "El correo electrónico ingresado no es válido.";
            }
    
            // Validar que las contraseñas coincidan
            if ($contraseña != $confirmar_contraseña) {
                $errors[] = "Las contraseñas no coinciden.";
            }
    
            // Validar que no exista otro usuario repetido
            if (validar_usuario($username)) {
                $errors[] = "Ya existe un usuario registrado con este correo electrónico.";
            }
    
            // Si no hay errores, proceder con el registro
            if (empty($errors)) {
                // Registrar el usuario
                if (registrar_usuario($nombre, $apellidos, $username, $contraseña, $genero, $fecha_nacimiento)) {
                    echo "<script>alert('Registro exitoso.'); window.location.href='login.php';</script>";
                    exit();
                } else {
                    $errors[] = "Error al registrar el usuario. Por favor, inténtelo de nuevo.";
                }
            }
            return $errors;
        }
    }
}

?>
