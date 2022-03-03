<?php 
require_once 'db_conexion.php';

class Alumno extends DBCONEXION {


  function buscar_alumno($codigo){

    $conexion = $this->set_connection();

    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE codigo=:codigo  ORDER BY a_materno,nombres");
    $sentencia->execute(array(':codigo'=>$codigo));
    $data = $sentencia->fetch();
    $this->close();
    return $data;
  }
  function buscar_alumno_completo($codigo){

    $conexion = $this->set_connection();

    $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN especialidades ON alumno.carrera=especialidades.cod_esp WHERE alumno.codigo=:codigo  ORDER BY a_materno,nombres");
    $sentencia->execute(array(':codigo'=>$codigo));
    $data = $sentencia->fetch();

    $this->close();
    return $data;
  }

  function buscar_alumno_pagos($codigo){

    $conexion = $this->set_connection();

    $sentencia = $conexion->prepare("SELECT * FROM economico WHERE codigo=:codigo  ORDER BY fecha DESC");
    $sentencia->execute(array(':codigo'=>$codigo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }

  public function alumnos_por_aula_ciclo($aula, $ciclo){

      $conexion = $this->set_connection();
      $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE aula=:aula AND ciclo =:ciclo  ORDER BY a_paterno,a_materno,nombres");
      $sentencia->execute(array(':aula'=>$aula, ':ciclo'=>$ciclo));
      $data = $sentencia->fetchAll();
      $this->close();
      return $data;
  }

  public function alumnos_por_sede_ciclo($sede, $ciclo){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:sede AND ciclo=:ciclo ORDER BY sede,aula,a_paterno,a_materno,nombres");
    $sentencia->execute(array(':sede'=>$sede,':ciclo'=>$ciclo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }

  public function alumnos_por_sede_codigo($sede, $ciclo){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:sede AND ciclo=:ciclo  ORDER BY codigo,sede,aula,a_paterno,a_materno,nombres");
    $sentencia->execute(array(':sede'=>$sede,':ciclo'=>$ciclo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }

  public function alumnos_por_apellidos($paterno, $materno){

    $conexion = $this->set_connection();

    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE a_paterno=:paterno AND a_materno=:materno  ORDER BY a_materno,nombres");
    $sentencia->execute(array(':paterno'=>utf8_decode($paterno), ':materno'=>utf8_decode($materno) ) );
    $data = $sentencia->fetchAll();

    $this->close();
    return $data;
  }

  public function alumnos_por_apaterno($apellido_paterno){

      $conexion = $this->set_connection();

      $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE a_paterno=:paterno ORDER BY a_materno,nombres");
      $sentencia->execute(array(':paterno'=>utf8_decode($apellido_paterno) ) );
      $data = $sentencia->fetchAll();

      $this->close();
      return $data;
  }

  public function alumnos_por_amaterno($apellido_materno){

    $conexion = $this->set_connection();

    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE a_materno=:materno ORDER BY a_materno,nombres");
    $sentencia->execute(array(':materno'=>utf8_decode($apellido_materno) ) );
    $data = $sentencia->fetchAll();

    $this->close();
    return $data;
  }

  public function insertar_alumno($codigo,$dni,$carrera,$nombres,$paterno,$materno,$sexo,$turno,$aula,$ciclo,$sede){

    $conexion = $this->set_connection();

    $statement = $conexion->prepare('INSERT INTO alumno (codigo, sede,turno, aula,ciclo, a_paterno,a_materno,nombres,dni,carrera,sexo) VALUES (:codigo, :sede,:turno, :aula,:ciclo, :a_paterno,:a_materno,:nombres,:dni,:carrera,:sexo)');
	  $statement->execute(array(':codigo'=>$codigo,':sede'=>$sede,':turno'=>$turno,':aula'=>$aula,':ciclo'=>$ciclo, ':a_paterno'=>$paterno, ':a_materno'=>$materno,':nombres'=>$nombres,':dni'=>$dni,':carrera'=>$carrera,':sexo'=>$sexo));

    $data = $statement->rowCount();

    $this->close();
    return $data;
  }

  public function actualizar_alumno($codigo,$dni,$carrera,$nombres,$paterno,$materno,$sexo,$turno,$aula,$ciclo,$sede,$descuento){

    $conexion = $this->set_connection();

    $statement = $conexion->prepare('UPDATE alumno SET  sede=:sede, turno=:turno, aula=:aula,ciclo=:ciclo, a_paterno=:a_paterno,a_materno=:a_materno,nombres=:nombres,dni=:dni,carrera=:carrera,sexo=:sexo,descuento=:descuento  WHERE codigo =:codigo');
	  $statement->execute(array(':codigo'=>$codigo,':sede'=>$sede,':turno'=>$turno,':aula'=>$aula,':ciclo'=>$ciclo, ':a_paterno'=>utf8_decode($paterno), ':a_materno'=>utf8_decode($materno),':nombres'=>utf8_decode($nombres),':dni'=>$dni,':carrera'=>$carrera,':sexo'=>$sexo,':descuento'=>$descuento));

    $data = $statement->rowCount();

    $this->close();
    return $data;
  }

  public function alumnos_ordenadosXaula($ciclo){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE ciclo=:ciclo ORDER BY aula");
    $sentencia->execute(array(':ciclo'=>$ciclo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }

  public function alumnos_ordenadosXsede($ciclo){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE ciclo=:ciclo  ORDER BY sede,aula,a_paterno,a_materno,nombres");
    $sentencia->execute(array(':ciclo'=>$ciclo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }

  public function alumnos_ordenadosXciclo_alfabetico($ciclo){

    $conexion = $this->set_connection();
    $sentencia = $conexion->prepare("SELECT 
      alu.codigo, alu.sede, alu.turno, alu.aula, alu.ciclo, alu.a_paterno, alu.a_materno, alu.nombres,
      alu.dni, alu.carrera, alu.sexo, alu.descuento
      FROM alumno alu
      WHERE
      alu.ciclo=:ciclo  
      ORDER BY alu.a_paterno,alu.a_materno,alu.nombres,alu.codigo,alu.sede,alu.aula
    ");
    $sentencia->execute(array(':ciclo'=>$ciclo));
    $data = $sentencia->fetchAll();
    $this->close();
    return $data;
  }



}


?>