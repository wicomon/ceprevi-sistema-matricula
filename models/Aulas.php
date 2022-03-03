<?php 
require_once 'db_conexion.php';

class Aulas extends DBCONEXION {


  function listar_aulasxciclo($ciclo){
    $conexion = $this->set_connection();
    
    $sentencia3 = $conexion->prepare("SELECT DISTINCT aula FROM alumno WHERE ciclo=:ciclo");
    $sentencia3->execute(array(':ciclo'=>$ciclo));
    $resultado = $sentencia3->fetchAll();
    
    $this->close();

    return $resultado;
  }

  function listar_aulas_general($ciclo){
    $conexion = $this->set_connection();
    
    $sentencia3 = $conexion->prepare("SELECT * FROM aulas WHERE ciclo=:ciclo");
    $sentencia3->execute(array(':ciclo'=>$ciclo));
    $resultado = $sentencia3->fetchAll();
    
    $this->close();

    return $resultado;
  }
  
}


?>