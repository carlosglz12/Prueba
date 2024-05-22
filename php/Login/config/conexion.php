<?php
class Conexion {
    //Datos de la base de datos
    private $db_host = "localhost";
    private $nom_bd = "sistema_login";
    private $us_bd = "root";
    private $con_bd = "";
    private $conexion;

    public function __construct() {
        //establecer la conexión con la base de datos
        $this->conexion = mysqli_connect($this->db_host, $this->us_bd, $this->con_bd);
        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la base de datos";
            exit();
        }
        //seleccionar la base de datos
        mysqli_select_db($this->conexion, $this->nom_bd) or die("No se encuentra la base de datos");
        mysqli_set_charset($this->conexion, "utf8");
    }
//obtener la conexion
    public function getConexion() {
        return $this->conexion;
    }
}
?>
