<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="Auth.css">
    <style>
   .round {
    border-radius: 100px;
    border: 3px solid magenta;
    box-shadow: 0 0 20px #666;
   }
  </style>
</head>
<body>
<div class="section pos">
    <div class=" form-wrap">
        <div class="profile"><img src="https://coubsecure-s.akamaihd.net/get/b5/p/coub/simple/cw_timeline_pic/54354333582/fbfdcab7ed7250a53d8b0/med_1543231880_image.jpg" width="120" height="120" class="round">
            <h1>Авторизация</h1>
        </div>
        <form method="post">
            <div>
                <label for="email">Электронная почта</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="password">Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn" name="login">Войти</button><br>
        </form>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js""></script>
        <script type="text/javascript">

        $(document).ready(function(){
            $("button[name ='login']").click(function(){
                var email = $("input[name='email']").val();
                var password = $("input[name='password']").val();
                request = $.ajax({
                url: "Login.php",
                type: "post",
                data: "email="+email+"&password="+password,
                success: function(data){
                $('#result').html(data);}
                });
            });        
        });
        </script>
        <div id="result"></div>
    </div>
</div>

</body>
</html>