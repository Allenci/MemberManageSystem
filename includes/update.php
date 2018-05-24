<?php

	include_once("dbtool.php");

	$link=creat_connnect();     
	$sql=sprintf("UPDATE users SET user_level = '%s' , user_realname ='%s' , user_email ='%s' , user_phone ='%s' WHERE id= %d" ,$_POST['user_level'],$_POST['user_realname'],$_POST['user_email'],$_POST['user_phone'],$_GET['userid'] );
	// echo $sql;           
	$link->query($sql);
	$link->close();                    
	header("Location: ./../login-page/index_admin.php");  

?>

 