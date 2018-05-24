<?PHP session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>寵物管理介面</title>
  <!--import bootstrap start-->
  <link href='https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
  <link href='//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css' rel='stylesheet' type='text/css'>
  <link href='//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/css/bootstrap-switch.css' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js' type='text/javascript'></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js' type='text/javascript'></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js' type='text/javascript'></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/js/bootstrap-switch.min.js' type='text/javascript'></script>
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <!--import bootstrap end-->
  <!--google font 思源黑體 start-->
  <style>
    body { overflow-y:hidden; }
  @import url(//fonts.googleapis.com/earlyaccess/notosanstc.css); 
  </style>
  <!--google font 思源黑體 end-->
  <!--本身的css-->
  <link rel="stylesheet" href="style/style.css">
  <script src="./jquerymobile/jquery-2.1.0.min.js"></script>
  <script src="./jquerymobile/jquery.mobile-1.4.5.min.js"></script>

  
<script> 

//確定表格是否全部都填寫正確
sign_up_username_check = false;
sign_up_password_check = false;
sign_up_re_password_check = false;
sign_up_email_check = false;
sign_up_realname_check = false;

function logincallback() {
/* 這裡可執行提交表單的動作 */ 
 login_checkbox = true;
}

$(document).ready(function(){
  //註冊帳號監聽
  $("#user_name").bind('input propertychange',function(){

    //確認是否有相同帳號
      $.ajax({
    type:"POST",
    url:"./includes/input.php",
    data:{ user_name:$("#user_name").val(),
        action:"checkusername"
      },
    success:showcheckusername,
    error:function(data){
      alert("連線失敗");
        },
      });


    });

$("#email").bind('input propertychange',function(){
      var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
      if ( reg.test(  $("#email").val())){
        $("#checkemail").text("").css("color","white");
        $("#email_form-group").attr("class","form-group has-success");
        $("#email").attr("class","form-control form-control-success");   
        sign_up_email_check = true;    
      }else{
        $("#checkemail").text("請確認mail格式").css("color","red");
        $("#email_form-group").attr("class","form-group has-danger");
        $("#email").attr("class","form-control form-control-danger");
       sign_up_email_check = false;
      }
    });
//新增姓名驗證,  限定輸入 中文 與 英文大小寫 且長度小於16字元
$("#user_realname").bind('input propertychange',function(){
        // var regx = /[a-zA-Z ^\u4e00-\u9fa5]/;
         var regx =  /^[a-zA-Z\u4e00-\u9fa5]+$/;

      if ( regx.test(  $("#user_realname").val() )  &&   $("#user_realname").val().length < 15 ){
        $("#checkuser_realmname").text("").css("color","white");
        $("#name_form-group").attr("class","form-group has-success");
        $("#user_realname").attr("class","form-control form-control-success");   
        sign_up_realname_check = true;    
      }else{
        $("#checkuser_realmname").text("請確認姓名格式, 可選中/英文姓名, 小於15個字").css("color","red");
        $("#name_form-group").attr("class","form-group has-danger");
        $("#user_realname").attr("class","form-control form-control-danger");
       sign_up_realname_check = false;
      }
    });



 // 驗證密碼
  $("#password").bind('input propertychange',function(){
      var regg = /^[a-zA-Z0-9]+$/ ;
       if ( $(this).val().length >=8  &&  regg.test( $("#password").val())) {
        $("#checkpassword").text("");
        $("#password_form-group").attr("class","form-group has-success");
        $("#password").attr("class","form-control form-control-success");
        sign_up_password_check = true;
      }else{
        $("#checkpassword").text("大小寫英數字組合, 小於20字元").css("color","red");
        $("#password_form-group").attr("class","form-group has-danger");
        $("#password").attr("class","form-control form-control-danger");
        sign_up_password_check = false;
      }

        //避免重新改密碼後沒有呼叫到驗證密碼的即時監聽，所以在這裡也做一次驗證密碼
      if ( $("#re_password").val() === $("#password").val()) {
        $("#checkre_password").text("").css("color","white");
        $("#re_password_form-group").attr("class","form-group has-success");
        $("#re_password").attr("class","form-control form-control-success");  
        sign_up_re_password_check = true;
      }else{
        $("#checkre_password").text("請確認密碼一致").css("color","red");
        $("#re_password_form-group").attr("class","form-group has-danger");
        $("#re_password").attr("class","form-control form-control-danger");  
        sign_up_re_password_check = false;
      }



    });

    //密碼確認欄位必須與密碼欄位字串相符
    $("#re_password").bind('input propertychange',function(){
      if ( $(this).val() === $("#password").val()) {
        $("#checkre_password").text("").css("color","white");
        $("#re_password_form-group").attr("class","form-group has-success");
        $("#re_password").attr("class","form-control form-control-success");  
        sign_up_re_password_check = true;
      }else{
        $("#checkre_password").text("請確認密碼一致").css("color","red");
        $("#re_password_form-group").attr("class","form-group has-danger");
        $("#re_password").attr("class","form-control form-control-danger");  
        sign_up_re_password_check = false;
      }
    });
 
    // 限定電話只能為數字   09xxaaabbb  國內門號標準格式
    $("#phone").bind('input propertychange',function(){
      var regx = /^09\d{8}$/;  
      if ( regx.test( $("#phone").val() ) ) {
        $("#checkphone").text("").css("color","white");
        $("#phone_form-group").attr("class","form-group has-success");
        $("#phone").attr("class","form-control form-control-success"); 
        sign_up_phone_check = true;
      }else{
        $("#checkphone").text("請確認行動電話格式為09開頭").css("color","red");
        $("#phone_form-group").attr("class","form-group has-danger");
        $("#phone").attr("class","form-control form-control-danger");   
        sign_up_phone_check = false; 
      }

    });

      //登入按鈕監聽
       $("#login").bind("click",loginsubmit);

       //使用Enter來登入
         $('#login-username').keypress(function (event) {
            if (event.which === 13)
                {
                    loginsubmit();
                }
            });
        $('#login-password').keypress(function (event) {
          if (event.which === 13)
              {
                   loginsubmit();
              }
          });        

    //註冊按鈕監聽
    $("#sign_up").bind("click",function(){

          if (sign_up_username_check == false||sign_up_password_check == false||sign_up_re_password_check == false||sign_up_email_check == false||sign_up_realname_check == false) {
            alert("請確認資料完整性");

          }else if(sign_up_username_check == true&&sign_up_password_check == true&&sign_up_re_password_check == true&&sign_up_email_check == true&&sign_up_realname_check == true){

                    $.ajax({
                  type:"POST",
                  url:"./includes/input.php",
                  data:{ user_name:$("#user_name").val(),
                    password:$("#password").val(),
                    email:$("#email").val(),
                    user_realname:$("#user_realname").val(),
                    phone:$("#phone").val(),
                    action:"sign_up"},
                  success:sinupresult,
                  error:function(data){
                    alert("連線失敗");
                      },
                    });
               }
      });

}); //-----$(document).ready(function結尾

//檢查帳號使否有人使用
function showcheckusername(data){ 
       var userstr =/^[a-zA-Z0-9]+$/ ;
    if (data=="這個帳號已經有人使用") {
      $("#checkusername").text(data).css("color","red");
      $("#username_form-group").attr("class","form-group has-danger");
      $("#user_name").attr("class","form-control form-control-danger");
      sign_up_username_check = false;

    }else if(data=="這個帳號可以使用"){

        if ($("#user_name").val().length <21  && userstr.test($("#user_name").val())) {

            $("#checkusername").text("").css("color","white");
            $("#username_form-group").attr("class","form-group has-success");
            $("#user_name").attr("class","form-control form-control-success");
            sign_up_username_check = true;
        }else{
             $("#checkusername").text("請使用大小寫英文字及數字，小於21個字").css("color","red");
            $("#username_form-group").attr("class","form-group has-danger");
            $("#user_name").attr("class","form-control form-control-danger");
            sign_up_username_check = false;
        }
       
    }

}

//註冊後先帶入一般會員頁面
function sinupresult(){

  window.location.assign("./login-page/index_user.php");
}

//按下登入後送出的ajax
function loginsubmit(){
     $.ajax({
            type:"POST",
            url:"./includes/input.php",
            data:{ user_name:$("#login-username").val(),
            password:$("#login-password").val(),
            action:"login"},
            success:loginresult,
            error:function(data){
              alert("連線失敗");
                },
              });
}

//登入後PHP回傳的結果處理
function loginresult(data){

             if (data == "user") {
                
              window.location.assign("./login-page/index_user.php");

            }else if (data =="host") {
               
                window.location.assign("./login-page/index_host.php");

            }else if (data =="admin") {
              window.location.assign("./login-page/index_admin.php");
                

            }else {

                alert("帳號密碼輸入錯誤，請重新輸入");
            }
    }

</script>
</head>
<body>
<h1 class="tip">寵物管理平台</h1>
<div class="cont"> 
<!--   login 登入畫面 START    -->
  <div class="form sign-in">
    <h2 class="__welcome">歡迎回來</h2>
    <label>
      <span>帳號</span>
      <input id="login-username" type="username"/>
    </label>
    <label>
      <span>密碼</span>
      <input id="login-password" type="password"/>
    </label>
    <p class="forgot-pass"><a href="" id="forget-pw">忘記密碼?</a>

    </p>
    <button type="button" id="login" class="submit ">登入</button>
  </div> 
<!---   login 登入畫面 END   -->
<div class="sub-cont">
    <!--- 滑動 畫面 START  -->
    <div class="img">
      <div class="img__text m--up">
        <h2>成為新會員:D?</h2>
        <p>填寫幾個欄位, <br/> 馬上成為我們的一份子。</p>
      </div>
      <div class="img__text m--in">
        <h2>已經是會員了:D?</h2>
        <p>登入以管理所有資訊</p>
      </div>
      <div class="img__btn">
        <span class="m--up">註冊</span>
        <span class="m--in">登入</span>
      </div>
    </div>
    <!--- 滑動 畫面 END  -->
    <!-- 註冊畫面 START  Bootstarp的相關class也是寫在這裡面-->
    <div class="form sign-up">
      <div class='container'>
        <div class='panel panel-primary dialog-panel'>
        <h2 class="__welcome">歡迎註冊</h2>
        <div class='panel-body'>

        <form class='form-horizontal' role='form' method="post" >
          <!-- 帳號 欄位 START -->
          <div class='form-group' id="username_form-group">
            <label class='control-label col-md-2 col-md-offset-2' for='user_name'>帳號</label>
            <div class='col-md-6'>             
                  <input class="form-control" id='user_name' placeholder='輸入帳號' type='text' name='user_name'>
                  <div id="checkusername"></div>
            </div>
          </div>
          <!-- 帳號 欄位 END -->
          <!-- 密碼 欄位 START -->
          <div class='form-group' id="password_form-group">
            <label class='control-label col-md-2 col-md-offset-2' for='password'>密碼</label>
            <div class='col-md-6'>
                  <input class='form-control' id='password' placeholder='輸入密碼' type='password' name='password'>
                  <div id="checkpassword"></div>
            </div>  
          </div>
          <!-- 密碼 欄位 END -->
          <!-- 密碼確認 欄位 START -->
          <div class='form-group' id="re_password_form-group">
            <label class='control-label  col-md-2 col-md-offset-2' for='re_password'>確認密碼</label>
             <div class='col-md-6'>             
                  <input class='form-control' id='re_password' placeholder='確認密碼' type='password' name='re_password' >
                  <div id="checkre_password"></div>
            </div>
          </div>
          <!-- 密碼確認 欄位 END -->
          <!-- Mail 欄位 START -->
          <div class='form-group' id="email_form-group">
            <label class='control-label col-md-2 col-md-offset-2' for='email'>Email</label>
            <div class='col-md-6'>             
                  <input class='form-control' id='email' placeholder='tim@gmail.com' type='text' name='email'>
                  <div id="checkemail"></div>
            </div>
          </div>
          <!-- Mail 欄位 END --> 
          <!-- 姓名 欄位 START -->
          <div class='form-group' id="name_form-group">
            <label class='control-label col-md-2 col-md-offset-2' for='user_realname'>姓名</label>
            <div class='col-md-6'>             
                  <input class='form-control' id='user_realname' placeholder='中/英文姓名' type='text' name='user_realname'>
                  <div id="checkuser_realmname"></div>
            </div>
          </div>
          <!-- 姓名 欄位 END -->

          <!-- 電話 欄位 START -->
          <div class='form-group' id="phone_form-group">
            <label class='control-label col-md-2 col-md-offset-2' for='phone'>行動電話</label>
              <div class='col-md-6'>             
                  <input class='form-control' id='phone' placeholder='09xxxxxxxx' type='text' name='phone' >
                  <div id="checkphone"></div>
              </div>
          </div>
          <!-- 電話 欄位 END -->
          <!-- 可能需要跟 會員登入的那顆 button 用不一樣的 ID -->
          <div class='form-group'>
              <button type="button" name="sign_up" class="submit" id="sign_up">送出</button>               
          </div>
        </form>
      </div>
  </div>
  </div>
</div>
<!--目的是確保整個HTML檔案都讀取完畢, 否則滑動監聽會error -->
<script src="./js/javascript.js" type="text/javascript"></script>
</body>
</html>