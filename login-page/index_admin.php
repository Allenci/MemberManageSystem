<?PHP include '../includes/dbtool.php';
    if (!isset($_SESSION["username"])&& $_SESSION["user_level"]!="admin") {
        header('Location: ./../index.php');
    }else{                
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理員 - 管理介面</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style/style.css">
    <script src="./jquerymobile/jquery-2.1.0.min.js"></script>
    <script src="./jquerymobile/jquery.mobile-1.4.5.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <!-- Navigation -->
       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index_admin.php">管理員 - 資訊管理介面</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav"> 
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 管理員 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                         <li>
                            <a href="index_admin.php"><i class="fa fa-fw fa-gear"></i> 會員管理</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-bolt"></i> 發布新聞</a>
                        </li>
                        <li>
                                <a href="#"><i class="fa fa-fw fa-bolt"></i>新聞前台</a>
                        </li>
                        <li>
                            <a href="pet_charts.php"><i class="fa fa-fw fa-area-chart"></i> 圖表分析</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-paper-plane"></i> 發送廣告</a>
                        </li>
                        <li>
                            <a href="index_admin.php"><i class="fa fa-fw fa-laptop"></i> 客戶預約</a>
                        </li>
                            <li class="divider"></li>
                        <li>
                            <a href="#" onclick="javascript:location.href='./../includes/logout.php'"><i class="fa fa-fw fa-power-off"></i>登出系統</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index_admin.php"><i class="fa fa-fw fa-gear"></i> 會員管理</a>
                    </li>
                    <li>
                        <a href="news/admin/posts.php"><i class="fa fa-fw fa-gear"></i> 新聞功能</a>
                    </li>
                    <li>
                        <a href="pet_charts.php"><i class="fa fa-fw fa-area-chart"></i> 圖表分析</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-paper-plane"></i> 發送廣告</a>
                    </li>
                    <li>
                        <a href="index_admin.php"><i class="fa fa-fw fa-laptop"></i> 客戶預約</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                           <h1 class="page-header">
                            歡迎回來
                            <small>管理員</small>
                        </h1>                
                    </div>
                    <div class="col xs-6">
                    <form action="./index_admin.php" method="post">
                    <a href="./../includes/cleansearch.php">清除搜尋條件</a>
                            <div class="input-group col-xs-3 input-lg">                            
                                <input name="search_user" type="text" class="form-control  " placeholder="搜尋會員帳號">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" name="submit" type="submit">
                                        <span class="glyphicon glyphicon-search "></span>
                                </button>
                                </span>
                            </div>
                        </form>
                 
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>帳號權限</th>
                                    <th>帳號</th>
                                    <th>電子郵件</th>
                                    <th>姓名</th>
                                    <th>連絡電話</th>
                                    <th>註冊時間</th>
                                    <th>編輯資訊</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php 
                        $link=creat_connnect();
                        if( isset($_POST["search_user"]) && $_POST["search_user"]!="" ){
                            $_SESSION["search_user"]=$_POST["search_user"];
                            $search=$_POST["search_user"];
                            $sql="SELECT * FROM users WHERE user_name LIKE  '%$search%' ORDER BY id ASC";
                        }else if(isset($_SESSION["search_user"])){
                            $search=$_SESSION["search_user"];
                            $sql="SELECT * FROM users WHERE user_name LIKE  '%$search%' ORDER BY id ASC";

                        }else{
                            $sql="SELECT * FROM users ORDER BY id ASC";
                        }
                        $select_all_users=excute_sql($link, $sql);
                        $count = mysqli_num_rows($select_all_users);
                        if($count == 0){echo "<h1> 查無此使用者 </h1>";}
                             while ($row = mysqli_fetch_assoc($select_all_users)) { 
                                $user_id = $row['id'];
                                $user_level = $row['user_level'];
                                $user_name = $row['user_name'];
                                $user_email = $row['user_email'];
                                // $user_address = $row['user_address'];
                                $user_realname = $row['user_realname'];
                                $user_phone = $row['user_phone'];
                                $sign_up_date = $row['sign_up_date'];

                                if(isset($_GET["userid"])){            
                                        if ($_GET['userid']!=$user_id){
                                            echo "<tr>";
                                            echo " <td>{$user_id}</td> ";
                                            echo " <td>{$user_level}</td> ";
                                            echo " <td>{$user_name}</td> ";
                                            echo " <td>{$user_email}</td> ";
                                            echo " <td>{$user_realname}</td> ";
                                            echo " <td>{$user_phone}</td> ";
                                            echo " <td>{$sign_up_date}</td> ";
                                            echo " <td><a href='?userid=$row[id]'>編輯</a></td> ";
                                            echo " <td><a href='./../includes/del.php?userid=$row[id]' onclick=\"return confirm('確定要刪除嗎?');\" ";
                                            echo "</tr>";
                                        }else if($_GET['userid']==$user_id){
                                            echo "<form name='form1' method='post' action='./../includes/update.php?userid=$row[id]'>";
                                            echo "<tr>";
                                            echo " <td>{$user_id}</td> ";
                                            echo " <td><label for='user_level'></label><input type='text' name='user_level' id='user_level' value='{$user_level}' size='5'></td> ";
                                            echo " <td>{$user_name}</td> ";
                                            echo " <td><label for='user_email'></label><input type='text' name='user_email' id='user_email' value='{$user_email}'></td> ";
                                            echo " <td><label for='user_realname'></label><input type='text' name='user_realname' id='user_realname' value='{$user_realname}'></td> ";
                                            echo " <td><label for='user_phone'></label><input type='text' name='user_phone' id='user_phone' value='{$user_phone}'></td> ";
                                            echo " <td>{$sign_up_date}</td> ";
                                            echo " <td><input type='submit' name='edit' id='edit' value='送出'></td> ";
                                            echo " <td><a href='./../includes/del.php?'>取消</a></td> ";
                                            echo "</tr>";
                                            echo "</form>";
                                        }
                                    }else{
                                            echo "<tr>";
                                            echo " <td>{$user_id}</td> ";
                                            echo " <td>{$user_level}</td> ";
                                            echo " <td>{$user_name}</td> ";
                                            echo " <td>{$user_email}</td> ";
                                            echo " <td>{$user_realname}</td> ";
                                            echo " <td>{$user_phone}</td> ";
                                            echo " <td>{$sign_up_date}</td> ";
                                            echo " <td><a href='?userid=$row[id]'>編輯</a></td> ";
                                            echo " <td><a href='./../includes/del.php?userid=$row[id]' onclick=\"return confirm('確定要刪除嗎?');\">刪除</a></td> ";
                                            echo "</tr>";   
                                    }             
                            }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
</div>
<!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
