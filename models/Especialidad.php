<?php 
require_once 'db_conexion.php';

class Especialidad extends DBCONEXION {


  function listar_especialidades(){
    $conexion = $this->set_connection();
    $statement = $conexion->prepare('SELECT * FROM especialidades ORDER BY especialidad');
    $statement->execute();
    $resultado = $statement->fetchAll();
    $this->close();

    return $resultado;
  }

  
}


?>