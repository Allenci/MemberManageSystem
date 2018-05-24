<?php
	session_start();
	unset($_SESSION["search_user"]);
	header('Location: ../login-page/index_admin.php');
?>