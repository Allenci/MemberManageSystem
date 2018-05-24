<?php 

function insert_user_register(){
global $conn;
    if(isset($_POST['sign_up'])){
    $username      = $_POST['username'];
    $user_password = $_POST['password'];
    $user_email    = $_POST['email'];
    $user_name     = $_POST['name'];
    $user_phone    = $_POST['phone'];
    header("Location: ../front/welcome.php");
    // $user_address  = $_POST['address'];
   
    if(empty($username)||empty($user_password)||empty($user_email)||empty($user_name)||empty($user_phone)){
        echo "有空白欄位, 請再次確認";
    }else{

            $query = "INSERT INTO users(username, user_password, user_email, user_name, user_phone) ";
            $query .= "VALUES('{$username}','{$user_password}','{$user_email}','{$user_name}','{$user_phone}') ";
           
            $create_user_query = mysqli_query($conn, $query);
            if(!$create_user_query){
                die('query failed' . mysqli_error());
            }
        }
    }

}

?>
