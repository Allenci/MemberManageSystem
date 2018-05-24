<?php
include 'dbtool.php';

	$action=$_POST["action"];
	$action_result="";
	//獲得現在時間---已經有在dbtool.php設定好台北時間
	$datetime=date("Y-m-d G:i:s");
	switch ($action) {
	//註冊
		case ($action=="sign_up"):
		$user_name=$_POST["user_name"];
		$password=md5($_POST["password"]);
		$email=$_POST["email"];
		$user_realname=$_POST["user_realname"];
		$phone=$_POST["phone"]; 
		$link=creat_connnect();
		$sql= sprintf("INSERT INTO users (user_name,user_password,user_email,user_realname,user_phone,user_level,sign_up_date,user_login_count) VALUES ('%s','%s','%s','%s','%s','%s','%s',1) ", $user_name,$password,$email,$user_realname,$phone,"user",$datetime);
		//設定使用者、權限變數
		$_SESSION["user_name"]=$user_name;
		$_SESSION["user_level"]="user";
		input_sql($link, $sql);
		$action_result="註冊";
		break;
							
	//登入
		case ($action=="login"):
			$user_name=$_POST["user_name"];
			$password=md5($_POST["password"]);
			$link=creat_connnect();
			$sql="SELECT id, user_name , user_password , user_level FROM `users` WHERE user_name = '$user_name' && user_password = '$password'";
			// login_sql($link, $sql);	
			if ( mysqli_num_rows($link->query($sql)) ==1) {	
				$row=mysqli_fetch_assoc($link->query($sql));
				//設定使用者、權限變數
				$_SESSION["user_name"]=$row["user_name"];
				$_SESSION["user_level"]=$row["user_level"];
				//回傳登入後的權限給登入頁面判斷要導向到哪一頁
				echo $row["user_level"];							
				$userid = $row['id'];
				$user_name=$row['user_name'];
				$action_result="登入成功";	
				//紀錄登入次數
				$sql="UPDATE users SET user_login_count = user_login_count+1 WHERE user_name = '$user_name'";
				$link->query($sql);									
			} else {
						$action_result="帳號密碼錯誤";											
						echo "帳號密碼錯誤" ;
					}	
						break;
						//檢查是否有重複帳號
						case ($action=="checkusername"):
						$action_result="檢測帳號是否重複";
						$user_name=$_POST["user_name"];
						$link=creat_connnect();
						$sql="SELECT user_name FROM `users` WHERE user_name = '$user_name' ";
						if( mysqli_num_rows($link->query($sql)) ==1){											
							$row=mysqli_fetch_assoc($link->query($sql));										
							echo "這個帳號已經有人使用";
							// echo "登入成功"."<br>"."會員".$_SESSION["user"]."歡迎登入" ;	
						}else{
								echo "這個帳號可以使用";
						}break;
			}
						mysqli_close($link);		
// echo "這是經過PHP接收後傳送回去的值:".$_POST["ProductName"].$_POST["Description"].$_POST["imgname"];
?>