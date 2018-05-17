<?php 

namespace Conection;

abstract class AbstracDB{

	private static $h = "localhost";
	private static $u = "root";
	private static $dsn = "";
	protected $db = "document";
	private static $p = "mysql:dbname=".$this->db".;host=".self::$h;
	private $mysqli;
	private $rows;
	private $data;
	private $sql;

	private function start(){
		try {
		    $gbd = new PDO(, self::$u, self::$p);
		} catch (PDOException $e) {
		    echo 'Falló la conexión: ' . $e->getMessage();
		}

	}

	abstract function set();
	abstract function get();
	abstract function delete();
	abstract function update();

	protected function runQuery(){
		
	}



/*
	if (!($sentencia = $mysqli->prepare("INSERT INTO test(id) VALUES (?)"))) {
	    echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	$id = 1;
	if (!$sentencia->bind_param("i", $id)) {
	    echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
	}

	if (!$sentencia->execute()) {
	    echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
	}
*/
	private function end(){
		$this->mysqli->close();
	}
}
?>