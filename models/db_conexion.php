<?php
 
class DBCONEXION
{
 
    private $host;
    private $usuario;
    private $pass;
    private $db;

    private $opciones =array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::MYSQL_ATTR_FOUND_ROWS => true
    );

    private $connection;
    
 
    function __construct($host ='localhost', $usuario='root', $pass='', $db='ceprevi')
    {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->pass = $pass;
        $this->db = $db;
    }

    public function set_connection(){
        $this->connection = new PDO(
            'mysql:host=' . $this->host . ';dbname=' . $this->db,
            $this->usuario,
            $this->pass,
            $this->opciones
        );
        return $this->connection;
    }
 
    function close()
    {
        $this->connection = null;
    }

}