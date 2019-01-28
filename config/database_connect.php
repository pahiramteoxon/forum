<?php

class User {
	public $con;
	
	public function __construct(){
		$this->con = mysqli_connect("localhost","admin","root","forum");

		if(mysqli_connect_error()){
			echo "Error: Could not connect to database";
			exit;
		}
	}
}

$obj = new User;




?>	