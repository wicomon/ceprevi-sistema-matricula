<?php 
require_once 'db_conexion.php';

class Economico extends DBCONEXION {

  public function buscar_por_liquidacion($liquidacion){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT * FROM economico WHERE liquidacion=:liquidacion");
    $sentencia->execute(array(':liquidacion'=>$liquidacion));
    $data = $sentencia->fetch();
    $this->close();
    return $data;
  }

  public function listado_por_ciclo($ciclo){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo ORDER BY codigo,nombres");
    $sentencia->execute(array(':ciclo'=>$ciclo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }
  public function listado_por_ciclo_fecha($ciclo){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo  ORDER BY fecha DESC");
    $sentencia->execute(array(':ciclo'=>$ciclo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }

  public function insertar_pago($codigo,$nombres,$nro_recibo,$liquidacion,$fecha,$monto,$ciclo){

    $conexion = $this->set_connection();

    $statement = $conexion->prepare('INSERT INTO economico (codigo, nombres,nro_recibo, liquidacion,fecha, monto,ciclo) VALUES (:codigo, :nombres, :nro_recibo, :liquidacion, :fecha, :monto, :ciclo)');
	  $statement->execute(array(':codigo'=>$codigo,':nombres'=>$nombres,':nro_recibo'=>$nro_recibo,':liquidacion'=>$liquidacion,':fecha'=>$fecha, ':monto'=>$monto, ':ciclo'=>$ciclo));

    $data = $statement->rowCount();

    $this->close();
    return $data;
  }

  function buscar_alumno($codigo){

    $conexion = $this->set_connection();

    $sentencia = $conexion->prepare("SELECT * FROM economico WHERE codigo=:codigo  ORDER BY fecha DESC");
    $sentencia->execute(array(':codigo'=>$codigo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }

  public function editar_pago($codigo,$nombres,$nro_recibo,$liquidacion,$fecha,$monto,$ciclo){

    $conexion = $this->set_connection();

    $statement = $conexion->prepare('UPDATE economico SET  codigo=:codigo, nombres=:nombres, nro_recibo=:nro_recibo,liquidacion=:liquidacion, fecha=:fecha,monto=:monto,ciclo=:ciclo WHERE liquidacion =:liquidacion');
	  $statement->execute(array(':codigo'=>$codigo,':nombres'=>$nombres,':nro_recibo'=>$nro_recibo,':liquidacion'=>$liquidacion,':fecha'=>$fecha, ':monto'=>$monto, ':ciclo'=>$ciclo));

    $data = $statement->rowCount();

    $this->close();
    return $data;
  }

}


?>