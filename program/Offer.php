<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Realtor.php";
require_once "model\Client.php";
require_once "model\ObjProperty.php";
require_once "model\Status.php";
require_once "model\Offer.php";
session_start();
if(!isset($_SESSION['id']))
{
    echo "<script> document.location = 'Auth.php'</script>";
}
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("button[name ='button_delete']").click(function(){
                var radioValue = $("input[name='radio_id']:checked").val();
                var id = radioValue;
                var result = confirm( "Вы точно хотите удалить эту запись?" );
                if (result)
                {
                   request = $.ajax({
                    url: "Offer.php",
                    type: "post",
                    data: "delete_id="+id,
                    success: document.location = document.location});
                }
            });        
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("button[name ='button_update']").click(function(){
                var radioValue = $("input[name='radio_id']:checked").val();
                var id = radioValue;
                var response = $.ajax({
                    url: "OfferSelect.php",
                    type: "post",
                    data: "id="+id,
                    success: function(data){
                        var json = $.parseJSON(data);
                        $("#contact_form_update input[name='id']").val(json.ID_Offer);
                        $("#contact_form_update select[name='realtor']").val(json.Realtor_ID);
                        $("#contact_form_update select[name='client']").val(json.Client_ID);
                        $("#contact_form_update select[name='objProperty']").val(json.ObjProperty_ID);
                        $("#contact_form_update input[name='price']").val(json.Price);
                        $("#contact_form_update select[name='status']").val(json.Status_ID);
                    }
                });
            });        
        });
    </script>
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
                    <li><a href="Logout.php">Выход</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="row" id="table_offer">
            <h3>Предложения</h3>
            <?php
            $offer = new Offer();

            if(isset($_POST['button_add_ok']))
            {
                $offer->Realtor_ID = $_POST['realtor'];
                $offer->Client_ID = $_POST['client'];
                $offer->ObjProperty_ID = $_POST['objProperty'];
                $offer->Price = $_POST['price'];
                $offer->Status_ID = $_POST['status'];
                $offer->Insert();
            }
            if(isset($_POST['button_upd_ok']))
            {   
                $update_offer = $offer->SelectByID($_POST['id']);
                $update_offer->Realtor_ID = $_POST['realtor'];
                $update_offer->Client_ID = $_POST['client'];
                $update_offer->ObjProperty_ID = $_POST['objProperty'];
                $update_offer->Price = $_POST['price'];
                $update_offer->Status_ID = $_POST['status'];
                $update_offer->Update();
            }
            if(isset($_POST['delete_id']))
            {
                $delete_offer = $offer->SelectByID($_POST['delete_id']);
                $delete_offer->PermamentDelete();
            }

            $all_offers = $offer->Select();
            echo '<table class="tableInfo col-lg-2" border="1">';
            echo '<tr><th></th><th>ID Предложения</th><th>Риелтора ID</th><th>Риелтора ФИО</th><th>Клиента ID</th><th>Клиента ФИО</th><th>Недвижимости ID</th><th>Цена</th><th>Статусa ID</th><th>Статус</th></tr>';
            foreach ($all_offers as $single_offer)
            {
                echo '<tr>';
                echo "<td><input type='radio' name = 'radio_id' value='$single_offer->ID_Offer'></td>";
                echo '<td>' . $single_offer->ID_Offer . '</td>';
                echo '<td>' . $single_offer->Realtor_ID . '</td>';
                echo '<td>' . $single_offer->Realtor_FIO . '</td>';
                echo '<td>' . $single_offer->Client_ID . '</td>';
                echo '<td>' . $single_offer->Client_FIO . '</td>';
                echo '<td>' . $single_offer->ObjProperty_ID . '</td>';
                echo '<td>' . $single_offer->Price . '</td>';
                echo '<td>' . $single_offer->Status_ID . '</td>';
                echo '<td>' . $single_offer->Status_Name . '</td>';
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

            ?>
            <div class="col-lg-2 buttons">
                <button id="button_add">Добавить</button>
                <button id="button_update" name="button_update">Редактировать</button>
                <button id="button_delete" name="button_delete">Удалить</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <form class="contact_form" method="post" name="contact_form" id="contact_form_add">
                <ul>
                    <li>
                        <h2>Добавить</h2>
                    </li>
                    <li>
                        <label for="realtor">Риэлтор</label>
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
                        <label for="objProperty">Объект недвижимости</label>
                        <select name="objProperty">-->
                            <option disabled selected value>Выберите недвижимость</option>
                            <?php
                            OptionObjProperty();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="price">Стоимость(Руб.):</label>
                        <input type="text" name="price"  placeholder="1000000" required />
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
            <form class="contact_form" method="post" name="contact_form" id="contact_form_update">
                <ul>
                    <li>
                        <h2>Редактировать</h2>
                    </li>
                    <input type="hidden" name="id"/>
                    <li>
                        <label for="realtor">Риэлтор</label>
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
                        <label for="objProperty">Объект недвижимости</label>
                        <select name="objProperty">-->
                            <option disabled selected value>Выберите недвижимость</option>
                           <?php
                            OptionObjProperty();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="price">Стоимость(Руб.):</label>
                        <input type="text" name="price"  placeholder="1000000" required />
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
</div>
</body>

<script>

    $('body').ready(function( event ){

        $('.contact_form').addClass("nonvisible");       

    });

    $('#button_add').click(function(){

        $('#table_offer').addClass("nonvisible");   
        $('#contact_form_add').removeClass("nonvisible");   

    });

    $('#button_update').click(function(){

        $('#table_offer').addClass("nonvisible");   
        $('#contact_form_update').removeClass("nonvisible");   

    });

    $('.button_cancel').click(function(){

        $('#table_offer').removeClass("nonvisible");   
        $('.contact_form').addClass("nonvisible");     

    });

</script> 

</html>
