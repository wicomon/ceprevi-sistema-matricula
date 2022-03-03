<?php 
require_once 'db_conexion.php';

class Sedes extends DBCONEXION {


  function listar_sedes(){
    $conexion = $this->set_connection();
    $statement = $conexion->prepare('SELECT DISTINCT sede FROM sedes ORDER BY id');
    $statement->execute();
    $resultado = $statement->fetchAll();
    $this->close();

    return $resultado;
  }

  function listar_sedes_alumnos(){
    $conexion = $this->set_connection();
    $statement = $conexion->prepare('SELECT DISTINCT sede FROM alumno ORDER BY sede');
    $statement->execute();
    $resultado = $statement->fetchAll();
    $this->close();

    return $resultado;
  }
  
}


?>