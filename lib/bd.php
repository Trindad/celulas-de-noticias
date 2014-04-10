<?php
//conexão com o banco
$config = array();
$config['host']="localhost";
$config['user']="root";
$config['pass']="enter18";
$config['db']="celulas";

class DB {
	public static $instancia;
	public static function PegaInstancia(){
		global $config;
		
		if(DB::$instancia){
			return DB::$instancia;
		}
		else{
			try {
				DB::$instancia = new PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user'], $config['pass']);
			} catch (PDOException $e) {
			    print "Erro ao conectar com o BD: " . $e->getMessage() . "<br/>";
			    die();
			}

			return DB::$instancia;
		}
	}

}
