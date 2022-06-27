<?php


$db;
class db_conn{
	static $conns, $sql, $queryString, $order, $query;
	var $lastInsertId,$table="";


	function __construct(){
	 self::connect('safimw45_webdb');
		}


	function connect($db){

		self::$conns = new PDO("mysql:host=localhost;dbname=$db;charset=utf8", 'safimw45_sa', 'Safi-admin@2022');
		self::$conns->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$conns->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		return self::$conns;
	}

	function insert($queryString){

		self::$queryString = $queryString;
		try{
			self::$sql = self::$conns->prepare(self::$queryString);
			self::$query = self::$sql->execute();

			return "OK";

		}catch(PDOException $ex){

			return "Error updating: ".$ex;
		}
	}

	function query($query){
		try{

			return self::$conns->query($query);

		}catch(PDOException $ex){

			$this->error = $ex;
		}
	}


	function fetchQuery($queryString){
		self::$queryString = $queryString;
		try{
			self::$sql = self::$conns->prepare(self::$queryString);
			self::$sql->execute();

			return self::$sql->fetchAll();
		}
		catch(PDOException $ex){

			return "Error fetching data: ".$ex;

		}
	}

	function fetchObject($queryString){
		self::$queryString = $queryString;
		try{
			self::$sql = self::$conns->prepare(self::$queryString);
			self::$sql->execute();

			return self::$sql->fetchObject();
		}
		catch(PDOException $ex){

			return "Error fetching data: ".$ex;
		}
	}

	function quote($var){

		return self::$conns->quote($var);
	}

}//end class
