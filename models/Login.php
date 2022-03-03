<?php 
require_once 'db_conexion.php';

class Login extends DBCONEXION {


  function buscar_usuario($usuario, $password){
    $conexion = $this->set_connection();
    $statement = $conexion->prepare('SELECT *FROM admin WHERE username=:username AND pass=:password');
    $statement->execute(array(':username'=>$usuario, ':password'=>$password));
    $resultado = $statement->fetch();
    $this->close();

    return $resultado;
  }
  
}


?>