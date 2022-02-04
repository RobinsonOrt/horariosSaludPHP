<?php
	class  conectionDataBase{
		private static $conexion=NULL;
		private function __construct (){}
		public static function conection(){
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			self::$conexion= new PDO('mysql:host=localhost;dbname=horariossalud','root','',$pdo_options); // changes for your database
			return self::$conexion;
		}	
	} 
?>
