<?php 
require_once 'db_conexion.php';

class Ciclo extends DBCONEXION {


  function listar_ciclos_alumnos(){
    $conexion = $this->set_connection();
    $statement = $conexion->prepare('SELECT DISTINCT ciclo FROM alumno ORDER BY sede,aula');
    $statement->execute();
    $resultado = $statement->fetchAll();
    $this->close();

    return $resultado;
  }
  
}


?>