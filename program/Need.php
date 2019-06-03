<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Realtor.php";
require_once "model\Need.php";
require_once "model\Client.php";
require_once "model\TypeObj.php";
require_once "model\Status.php";
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
        <div class="row" id="table_need">
            <h3>Потребности</h3>
            <?php
            $need = new Need();

            if(isset($_POST['button_add_ok']))
            {
                $need->Realtor_ID = $_POST['realtor'];
                $need->Client_ID = $_POST['client'];
                $need->TypeObj_ID = $_POST['typeObj'];
                $need->Address = $_POST['address'];
                $need->MinPrice = $_POST['minPrice'];
                $need->MaxPrice = $_POST['maxPrice'];
                $need->MinArea = $_POST['minArea'];
                $need->MaxArea = $_POST['maxArea'];
                $need->MinKolvoRoom = $_POST['minCountRoom'];
                $need->MaxKolvoRoom = $_POST['maxCountRoom'];
                $need->MinFloor = $_POST['minFloor'];
                $need->MaxFloor = $_POST['maxFloor'];
                $need->MinNumFloors = $_POST['minNumFloors'];
                $need->MaxNumFloors = $_POST['maxNumFloors'];
                $need->Status_ID = $_POST['status'];
                $need->Insert();
            }
            if(isset($_POST['button_upd_ok']))
            {   
                $update_need = $need->SelectByID($_POST['id']);
                $update_need->Realtor_ID = $_POST['realtor'];
                $update_need->Client_ID = $_POST['client'];
                $update_need->TypeObj_ID = $_POST['typeObj'];
                $update_need->Address = $_POST['address'];
                $update_need->MinPrice = $_POST['minPrice'];
                $update_need->MaxPrice = $_POST['maxPrice'];
                $update_need->MinArea = $_POST['minArea'];
                $update_need->MaxArea = $_POST['maxArea'];
                $update_need->MinKolvoRoom = $_POST['minCountRoom'];
                $update_need->MaxKolvoRoom = $_POST['maxCountRoom'];
                $update_need->MinFloor = $_POST['minFloor'];
                $update_need->MaxFloor = $_POST['maxFloor'];
                $update_need->MinNumFloors = $_POST['minNumFloors'];
                $update_need->MaxNumFloors = $_POST['maxNumFloors'];
                $update_need->Status_ID = $_POST['status'];
                $update_need->Update();
            }
            if(isset($_POST['button_delete_ok']))
            {
                $delete_need = $need->SelectByID($_POST['id']);
                $delete_need->PermamentDelete();
            }

            $all_needs = $need->Select();
            echo '<table class="tableInfo col-lg-2" border="1">';
            echo '<tr><th>ID Потребности</th><th>Риелтора ID</th><th>Риелтора ФИО</th><th>Клиента ID</th><th>Клиента ФИО</th><th>Типа недвижимости ID</th><th>Тип недвижимости</th><th>Адрес</th><th>Минимальная цена</th><th>Максимальная цена</th><th>Минимальная площадь</th><th>Максимальная площадь</th><th>Минимум комнат</th><th>Максимум комнат</th><th>Минимальный этаж</th><th>Максимальный этаж</th><th>Минимум этажей</th><th>Максимум этажей</th><th>Статуса ID</th><th>Статус</th></tr>';
            foreach ($all_needs as $single_need)
            {
                echo '<tr>';
                echo '<td>' . $single_need->ID_Need . '</td>';
                echo '<td>' . $single_need->Realtor_ID . '</td>';
                echo '<td>' . $single_need->Realtor_FIO . '</td>';
                echo '<td>' . $single_need->Client_ID . '</td>';
                echo '<td>' . $single_need->Client_FIO . '</td>';
                echo '<td>' . $single_need->TypeObj_ID . '</td>';
                echo '<td>' . $single_need->TypeObj_Name . '</td>';
                echo '<td>' . $single_need->Address . '</td>';
                echo '<td>' . $single_need->MinPrice . '</td>';
                echo '<td>' . $single_need->MaxPrice . '</td>';
                echo '<td>' . $single_need->MinArea . '</td>';
                echo '<td>' . $single_need->MaxArea . '</td>';
                echo '<td>' . $single_need->MinKolvoRoom . '</td>';
                echo '<td>' . $single_need->MaxKolvoRoom . '</td>';
                echo '<td>' . $single_need->MinFloor . '</td>';
                echo '<td>' . $single_need->MaxFloor . '</td>';
                echo '<td>' . $single_need->MinNumFloors . '</td>';
                echo '<td>' . $single_need->MaxNumFloors . '</td>';
                echo '<td>' . $single_need->Status_ID . '</td>';
                echo '<td>' . $single_need->Status_Name . '</td>';
                echo '</tr>';
            }
            echo '</table>';

            function OptionRealtor()
            {
                $realtor = new Realtor();
                $all_realtors = $realtor->Select();
                foreach ($all_realtors as $single_realtor)
                {
                    $id = $single_realtor->ID_Realtor;
                    $fio = $single_realtor->FIO;
                    echo '<option value="'.$id.'">'.$fio.'</option>';
                }
            }

            function OptionClient()
            {
                $client = new Client();
                $all_clients = $client->Select();
                foreach ($all_clients as $single_client)
                {
                    $id = $single_client->ID_Client;
                    $fio = $single_client->FIO;
                    echo '<option value="'.$id.'">'.$fio.'</option>';
                }
            }

            function OptionTypeObj()
            {
                $typeobj = new TypeObj();
                $all_typeobjs = $typeobj->Select();
                foreach ($all_typeobjs as $single_typeobj)
                {
                    $id = $single_typeobj->ID_TypeObj;
                    $name = $single_typeobj->Name;
                    echo '<option value="'.$id.'">'.$name.'</option>';
                }
            }

            function OptionStatus()
            {
                $status = new Status();
                $all_statuses = $status->Select();
                foreach ($all_statuses as $single_status)
                {
                    $id = $single_status->ID_Status;
                    $name = $single_status->Name;
                    echo '<option value="'.$id.'">'.$name.'</option>';
                }
            }

            function OptionNeed()
            {
                $need = new Need();
                $all_needs = $need->Select();
                foreach ($all_needs as $single_need)
                {
                    $id = $single_need->ID_Need;
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
                        <label for="realtor">Риелтор</label>
                        <select name="realtor">-->
                            <option disabled selected value>Выберите риелтора</option>
                            <?php
                            OptionRealtor();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="client">Клиент</label>
                        <select name="client">-->
                            <option disabled selected value>Выберите клиента</option>
                            <?php
                            OptionClient();
                            ?>
                        </select>
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
                        <label for="address">Адрес:</label>
                        <input type="text" name="address" placeholder="Ул. Республики, 26" required/>
                    </li>
                    <li>
                        <label for="minPrice">Минимальная цена(Руб.):</label>
                        <input type="text" name="minPrice" placeholder="1000000" required/>
                    </li>
                    <li>
                        <label for="maxPrice">Максимальная цена(Руб.):</label>
                        <input type="text" name="maxPrice" placeholder="9000000" required/>
                    </li>
                    <li>
                        <label for="minArea">Минимальная площадь(кв.м.):</label>
                        <input type="text" name="minArea" placeholder="100" required/>
                    </li>
                    <li>
                        <label for="maxArea">Максимальная площадь(кв.м.):</label>
                        <input type="text" name="maxArea" placeholder="9000" required/>
                    </li>
                    <li>
                        <label for="minCountRoom">Минимальное кол-во комнат:</label>
                        <input type="text" name="minCountRoom" placeholder="1" required/>
                    </li>
                    <li>
                        <label for="maxCountRoom">Максимальное кол-во комнат:</label>
                        <input type="text" name="maxCountRoom" placeholder="9" required/>
                    </li>
                    <li>
                        <label for="minFloor">Минимальный этаж:</label>
                        <input type="text" name="minFloor" placeholder="1" required/>
                    </li>
                    <li>
                        <label for="maxFloor">Максимальный этаж:</label>
                        <input type="text" name="maxFloor" placeholder="9" required/>
                    </li>
                    <li>
                        <label for="minNumFloors">Минимальное кол-во этажей:</label>
                        <input type="text" name="minNumFloors" placeholder="1" required/>
                    </li>
                    <li>
                        <label for="maxNumFloors">Максимальныое кол-во этажей:</label>
                        <input type="text" name="maxNumFloors" placeholder="9" required/>
                    </li>
                    <li>
                        <label for="status">Статус</label>
                        <select name="status">-->
                            <option disabled selected value>Выберите статус</option>
                            <?php
                            OptionStatus();
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
            <form class="contact_form" action="#" method="post" name="contact_form"  id="contact_form_update">
                <ul>
                    <li>
                        <h2>Редактировать</h2>
                    </li>
                    <li>
                        <label for="name">ID:</label>
                        <input type="text" name="id" placeholder="1" required />
                    </li>
                    <li>
                        <label for="realtor">Риелтор</label>
                        <select name="realtor">-->
                            <option disabled selected value>Выберите риелтора</option>
                            <?php
                            OptionRealtor();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="client">Клиент</label>
                        <select name="client">-->
                            <option disabled selected value>Выберите клиента</option>
                            <?php
                            OptionClient();
                            ?>
                        </select>
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
                        <label for="address">Адрес:</label>
                        <input type="text" name="address" placeholder="Ул. Республики, 26" required/>
                    </li>
                    <li>
                        <label for="minPrice">Минимальная цена(Руб.):</label>
                        <input type="text" name="minPrice" placeholder="1000000" required/>
                    </li>
                    <li>
                        <label for="maxPrice">Максимальная цена(Руб.):</label>
                        <input type="text" name="maxPrice" placeholder="9000000" required/>
                    </li>
                    <li>
                        <label for="minArea">Минимальная площадь(кв.м.):</label>
                        <input type="text" name="minArea" placeholder="100" required/>
                    </li>
                    <li>
                        <label for="maxArea">Максимальная площадь(кв.м.):</label>
                        <input type="text" name="maxArea" placeholder="9000" required/>
                    </li>
                    <li>
                        <label for="minCountRoom">Минимальное кол-во комнат:</label>
                        <input type="text" name="minCountRoom" placeholder="1" required/>
                    </li>
                    <li>
                        <label for="maxCountRoom">Максимальное кол-во комнат:</label>
                        <input type="text" name="maxCountRoom" placeholder="9" required/>
                    </li>
                    <li>
                        <label for="minFloor">Минимальный этаж:</label>
                        <input type="text" name="minFloor" placeholder="1" required/>
                    </li>
                    <li>
                        <label for="maxFloor">Максимальный этаж:</label>
                        <input type="text" name="maxFloor" placeholder="9" required/>
                    </li>
                    <li>
                        <label for="minNumFloors">Минимальное кол-во этажей:</label>
                        <input type="text" name="minNumFloors" placeholder="1" required/>
                    </li>
                    <li>
                        <label for="maxNumFloors">Максимальныое кол-во этажей:</label>
                        <input type="text" name="maxNumFloors" placeholder="9" required/>
                    </li>
                    <li>
                        <label for="status">Статус</label>
                        <select name="status">-->
                            <option disabled selected value>Выберите статус</option>
                            <?php
                            OptionStatus();
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
                            <option disabled selected value>Выберите потребность</option>
                            <?php
                            OptionNeed();
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

        $('#table_need').addClass("nonvisible");   
        $('#contact_form_add').removeClass("nonvisible");   

    });

    $('#button_update').click(function(){

        $('#table_need').addClass("nonvisible");   
        $('#contact_form_update').removeClass("nonvisible");   

    });

    $('#button_delete').click(function(){

        $('#table_need').addClass("nonvisible");   
        $('#contact_form_delete').removeClass("nonvisible");   

    });

    $('.button_cancel').click(function(){

        $('#table_need').removeClass("nonvisible");   
        $('.contact_form').addClass("nonvisible");     

    });

</script> 

</html>
