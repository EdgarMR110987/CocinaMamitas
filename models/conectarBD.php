<?php

class Conexion{
	public static function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=kusoftde_cocina_mamitas","root","");
		return $link;
	}
}

?>