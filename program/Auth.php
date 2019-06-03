<?php
function whoIsPeople(){
    $client = "visible";
    echo $client;
}
?>
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
    <div class=" form-wrap <?php whoIsPeople()?>">
        <div class="profile"><img src="https://coubsecure-s.akamaihd.net/get/b5/p/coub/simple/cw_timeline_pic/54354333582/fbfdcab7ed7250a53d8b0/med_1543231880_image.jpg" width="120" height="120" class="round">
            <h1>Авторизация</h1>
        </div>
        <form method="post" action="Auth.php">
            <!--        <div>-->
            <!--            <label for="name">Имя</label>-->
            <!--            <input type="text" name="name" required>-->
            <!--        </div>-->
            <!--        <div class="radio">-->
            <!--            <span>Пол</span>-->
            <!--            <label>-->
            <!--                <input type="radio" name="sex" value="мужской">мужской-->
            <!--                <div class="radio-control male"></div>-->
            <!--            </label>-->
            <!--            <label>-->
            <!--                <input type="radio" name="sex" value="женский">женский-->
            <!--                <div class="radio-control female"></div>-->
            <!--            </label>-->
            <!--        </div>-->
            <div>
                <label for="email">Электронная почта</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="password">Пароль</label>
                <input type="password" name="password" required>
            </div>
            <!--        <div>-->
            <!--            <label for="country">Страна</label>-->
            <!--            <select name="country">-->
            <!--                <option>Выберите страну проживания</option>-->
            <!--                <option value="Россия">Россия</option>-->
            <!--                <option value="Украина">Украина</option>-->
            <!--                <option value="Беларусь">Беларусь</option>-->
            <!--            </select>-->
            <!--            <div class="select-arrow"></div>-->
            <!--        </div>-->
            <button class="btn" type="submit">На работу</button>
        </form>
    </div>
</div>

</body>
</html>
<?php
$name = trim(strip_tags($_POST["name"]));
$sex = trim(strip_tags($_POST["sex"]));
$email = trim(strip_tags($_POST["email"]));
$country = trim(strip_tags($_POST["country"]));
$subject = "Регистрация на сайте url_вашего_сайта";
$msg = "Ваши данные формы регистрации:\n" ."Имя: $name\n" ."Пол: $sex\n" ."Ваш email: $email\n" ."Страна: $country";
$headers = "Content-type: text/plain; charset=UTF-8" . "\r\n";
$headers .= "From: Ваше_имя <ваш_email>" . "\r\n";
$headers .= "Bcc: ваш_email". "\r\n";
if(!empty($name) && !empty($sex) && !empty($email) && !empty($country) && filter_var($email, FILTER_VALIDATE_EMAIL)){
    mail($email, $subject, $msg, $headers);
    echo "Спасибо! Вы успешно зарегистрировались.";
}
?>
