<?php 
session_start();

//設定為台北時間
date_default_timezone_set("Asia/Taipei");
	function creat_connnect(){
		// $conn= new mysqli("localhost","root","","pet_db");
		$conn= new mysqli("localhost","root","","pet_db");
		 
		if($conn->connect_error){
			die("連線錯誤".$conn->connect_error);
		}
		// $conn->query("SET NAMES utf8")
		mysqli_set_charset($conn,"utf8");  //強制UTF-8
		// echo "連線成功";
		return $conn;

		}
	function excute_sql($link,$sql){
		$result=$link->query($sql);
		return $result;
	}
	function input_sql($link,$sql){
		$link->query($sql);
	}
 ?>