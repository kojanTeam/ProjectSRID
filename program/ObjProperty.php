<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\TypeObj.php";
require_once "model\ObjProperty.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
        <script src="libs/jquery/jquery-2.1.4.min.js"></script>
    <script src="libs/Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="libs/Bootstrap/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <nav>
                <ul class="topmenu">
                    <li><a href="Main.php">Главная</a></li>
                    <li><a>Справочники</a>
                        <ul class="submenu">
                            <li><a href="Client.php">Клиенты</a></li>
                            <li><a href="Realtor.php">Риелторы</a></li>
                            <li><a href="ObjProperty.php">Объекты недвижимости</a></li>
                            <li><a href="Deal.php">Сделки</a></li>
                            <li><a href="Offer.php">Предложения</a></li>
                            <li><a href="Need.php">Потребности</a></li>
                            <li><a href="TypeObj.php">Типы объекта</a></li>
                            <li><a href="Status.php">Статусы</a></li>

                        </ul>
                    </li>
                    <li><a href="Auth.php">Выход</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="row" id="table_objproperty">
            <h3>Объекты недвижимости</h3>
            <?php
            $objproperty = new ObjProperty();

            if(isset($_POST['button_add_ok']))
            {
                $objproperty->CoordX = $_POST['coordX'];
                $objproperty->CoordY = $_POST['coordY'];
                $objproperty->City = $_POST['city'];
                $objproperty->Street = $_POST['street'];
                $objproperty->NumHouse = $_POST['numHouse'];
                $objproperty->NumApart = $_POST['numApart'];
                $objproperty->Floor = $_POST['floor'];
                $objproperty->KolvoRoom = $_POST['countRoom'];
                $objproperty->Area = $_POST['area'];
                $objproperty->NumFloors = $_POST['countFloor'];
                $objproperty->TypeObj_ID = $_POST['typeObj'];
            }
            if(isset($_POST['button_upd_ok']))
            {   
                $update_objproperty = $objproperty->SelectByID($_POST['id']);
                $update_objproperty->CoordX = $_POST['coordX'];
                $update_objproperty->CoordY = $_POST['coordY'];
                $update_objproperty->City = $_POST['city'];
                $update_objproperty->Street = $_POST['street'];
                $update_objproperty->NumHouse = $_POST['numHouse'];
                $update_objproperty->NumApart = $_POST['numApart'];
                $update_objproperty->Floor = $_POST['floor'];
                $update_objproperty->KolvoRoom = $_POST['countRoom'];
                $update_objproperty->Area = $_POST['area'];
                $update_objproperty->NumFloors = $_POST['countFloor'];
                $update_objproperty->TypeObj_ID = $_POST['typeObj'];
                $update_objproperty->Update();
            }
            if(isset($_POST['button_delete_ok']))
            {
                $delete_objproperty = $objproperty->SelectByID($_POST['id']);
                $delete_objproperty->PermamentDelete();
            }

            $all_objpropertys = $objproperty->Select();
            echo '<table class="tableInfo col-lg-2" border="1">';
            echo '<tr><th>ID Объекта</th><th>Координата X</th><th>Координата Y</th><th>Город</th><th>Улица</th><th>Номер дома</th><th>Номер квартиры</th><th>Этаж</th><th>Количество комнат</th><th>Площадь</th><th>Количество этажей</th><th>Типа объекта ID</th><th>Тип объекта</th></tr>';
            foreach ($all_objpropertys as $single_objproperty)
            {
                echo '<tr>';
                echo '<td>' . $single_objproperty->ID_ObjProperty . '</td>';
                echo '<td>' . $single_objproperty->CoordX . '</td>';
                echo '<td>' . $single_objproperty->CoordY . '</td>';
                echo '<td>' . $single_objproperty->City . '</td>';
                echo '<td>' . $single_objproperty->Street . '</td>';
                echo '<td>' . $single_objproperty->NumHouse . '</td>';
                echo '<td>' . $single_objproperty->NumApart . '</td>';
                echo '<td>' . $single_objproperty->Floor . '</td>';
                echo '<td>' . $single_objproperty->KolvoRoom . '</td>';
                echo '<td>' . $single_objproperty->Area . '</td>';
                echo '<td>' . $single_objproperty->NumFloors . '</td>';
                echo '<td>' . $single_objproperty->TypeObj_ID . '</td>';
                echo '<td>' . $single_objproperty->TypeObj_Name . '</td>';
                echo '</tr>';
            }
            echo '</table>';

            function OptionTypeObj()
            {
                $typeobj = new TypeObj();
                $all_typeobjs = $typeobj->Select();
                foreach ($all_typeobjs as $single_typeobj)
                {
                    $id = $single_typeobj->ID_TypeObj;
                    $type = $single_typeobj->Name;
                    echo '<option value="'.$id.'">'.$type.'</option>';
                }
            }

            function OptionObjProperty()
            {
                $objproperty = new ObjProperty();
                $all_objpropertys = $objproperty->Select();
                foreach ($all_objpropertys as $single_objproperty)
                {
                    $id = $single_objproperty->ID_ObjProperty;
                    echo '<option value="'.$id.'">'.$id.'</option>';
                }
            }
            ?>
            <div class="col-lg-2 buttons">
                <button id="button_add">Добавить</button>
                <button id="button_update">Редактировать</button>
                <button id="button_delete">Удалить</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <form class="contact_form" action="#" method="post" name="contact_form" id="contact_form_add">
                <ul>
                    <li>
                        <h2>Добавить</h2>
                    </li>
                    <li>
                        <label for="coordX">Координаты Х:</label>
                        <input type="text" name="coordX" placeholder="156,23" required/>
                    </li>
                    <li>
                        <label for="coordY">Координаты Y:</label>
                        <input type="text" name="coordY" placeholder="156,23" required/>
                    </li>
                    <li>
                        <label for="city">Город:</label>
                        <input type="text" name="city" placeholder="Тюмень" required/>
                    </li>
                    <li>
                        <label for="street">Улица:</label>
                        <input type="text" name="street" placeholder="Республики" required/>
                    </li>
                    <li>
                        <label for="numHouse">№ дома:</label>
                        <input type="text" name="numHouse" placeholder="156" required/>
                    </li>
                    <li>
                        <label for="numApart">Номер квартиры:</label>
                        <input type="text" name="numApart" placeholder="90" required/>
                    </li>
                    <li>
                        <label for="floor">Этаж:</label>
                        <input type="text" name="floor" placeholder="5" required/>
                    </li>
                    <li>
                        <label for="countRoom">Кол-во комнат:</label>
                        <input type="text" name="countRoom" placeholder="4" required/>
                    </li>
                    <li>
                        <label for="area">Площадь(кв.м):</label>
                        <input type="text" name="area" placeholder="100" required/>
                    </li>
                    <li>
                        <label for="countFloor">Кол-во этажей:</label>
                        <input type="text" name="countFloor" placeholder="10" required/>
                    </li>
                    <li>
                        <label for="typeObj">Тип объекта</label>
                        <select name="typeObj">-->
                            <option disabled selected value>Выберите тип объекта</option>
                            <?php
                            OptionTypeObj();
                            ?>
                        </select>
                    </li>
                    <li>
                       <button class="submit button_ok" type="submit" id="button_add_ok" name="button_add_ok">ОК</button>
                        <button class="submit button_cancel" type="button" id="button_add_cancel" name="button_add_cancel">Отмена</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <form class="contact_form" action="#" method="post" name="contact_form" id="contact_form_update">
                <ul>
                    <li>
                        <h2>Редактировать</h2>
                    </li>
                    <li>
                        <label for="name">ID:</label>
                        <input type="text" name="id" placeholder="1" required />
                    </li>
                    <li>
                        <label for="coordX">Координаты Х:</label>
                        <input type="text" name="coordX" placeholder="156,23" required/>
                    </li>
                    <li>
                        <label for="coordY">Координаты Y:</label>
                        <input type="text" name="coordY" placeholder="156,23" required/>
                    </li>
                    <li>
                        <label for="city">Город:</label>
                        <input type="text" name="city" placeholder="Тюмень" required/>
                    </li>
                    <li>
                        <label for="street">Улица:</label>
                        <input type="text" name="street" placeholder="Республики" required/>
                    </li>
                    <li>
                        <label for="numHouse">№ дома:</label>
                        <input type="text" name="numHouse" placeholder="156" required/>
                    </li>
                    <li>
                        <label for="numApart">Номер квартиры:</label>
                        <input type="text" name="numApart" placeholder="90" required/>
                    </li>
                    <li>
                        <label for="floor">Этаж:</label>
                        <input type="text" name="floor" placeholder="5" required/>
                    </li>
                    <li>
                        <label for="countRoom">Кол-во комнат:</label>
                        <input type="text" name="countRoom" placeholder="4" required/>
                    </li>
                    <li>
                        <label for="area">Площадь(кв.м):</label>
                        <input type="text" name="area" placeholder="100" required/>
                    </li>
                    <li>
                        <label for="countFloor">Кол-во этажей:</label>
                        <input type="text" name="countFloor" placeholder="10" required/>
                    </li>
                    <li>
                        <label for="typeObj">Тип объекта</label>
                        <select name="typeObj">-->
                            <option disabled selected value>Выберите тип объекта</option>
                            <?php
                            OptionTypeObj();
                            ?>
                        </select>
                    </li>
                    <li>
                       <button class="submit button_ok" type="submit" id="button_upd_ok" name="button_upd_ok">ОК</button>
                        <button class="submit button_cancel" type="button" id="button_upd_cancel" name="button_upd_cancel">Отмена</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <form class="contact_form" action="#" method="post" name="contact_form" id="contact_form_delete">
                <ul>
                    <li>
                        <h2>Удалить</h2>
                    </li>
                    <li>
                        <label for="id">ID:</label>
                        <select name="id">-->
                            <option disabled selected value>Выберите недвижимость</option>
                            <?php
                            OptionObjProperty();
                            ?>
                        </select>
                    </li>
                    <li>
                        <button class="submit button_ok" type="submit" id="button_delete_ok" name="button_delete_ok">ОК</button>
                        <button class="submit button_cancel" type="button" id="button_delete_cancel" name="button_delete_cancel">Отмена</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>

<script>

    $('body').ready(function( event ){

        $('.contact_form').addClass("nonvisible");       

    });

    $('#button_add').click(function(){

        $('#table_objproperty').addClass("nonvisible");   
        $('#contact_form_add').removeClass("nonvisible");   

    });

    $('#button_update').click(function(){

        $('#table_objproperty').addClass("nonvisible");   
        $('#contact_form_update').removeClass("nonvisible");   

    });

    $('#button_delete').click(function(){

        $('#table_objproperty').addClass("nonvisible");   
        $('#contact_form_delete').removeClass("nonvisible");   

    });

    $('.button_cancel').click(function(){

        $('#table_objproperty').removeClass("nonvisible");   
        $('.contact_form').addClass("nonvisible");     

    });

</script> 

</html>
