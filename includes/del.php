<?php

	include_once("dbtool.php");

	$link=creat_connnect();					
	$sql=sprintf("SELECT * FROM users WHERE id=%d", $_GET['userid']);
	$result=$link->query($sql);
	$row=$result->fetch_array();
	$sql=sprintf("DELETE FROM users WHERE id = %d",$row['id']);
	$link->query($sql);
	$link->close();		

	header("Location: ./../login-page/index_admin.php");

?>
