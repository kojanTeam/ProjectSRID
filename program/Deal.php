<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Deal.php";
require_once "model\Need.php";
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
                    url: "Deal.php",
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
                    url: "DealSelect.php",
                    type: "post",
                    data: "id="+id,
                    success: function(data){
                        var json = $.parseJSON(data);
                        $("#contact_form_update input[name='id']").val(json.ID_Deal);
                        $("#contact_form_update select[name='offer']").val(json.Offer_ID);
                        $("#contact_form_update select[name='need']").val(json.Need_ID);
                        var arr = json.DateTimeDeal.split(' ');
                        $("#contact_form_update input[name='dateDeal']").val(arr[0]);
                        $("#contact_form_update input[name='timeDeal']").val(arr[1]);
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
        <div class="row" id="table_deal">
            <h3>Сделки</h3>
            <?php
            $deal = new Deal();

            if(isset($_POST['button_add_ok']))
            {
                $deal->Offer_ID = $_POST['offer'];
                $deal->Need_ID =$_POST['need'];
                $deal->DateTimeDeal = $_POST['dateDeal']." ".$_POST['timeDeal'];
                $deal->Insert();
            }
            if(isset($_POST['button_upd_ok']))
            {   
                $update_deal=$deal->SelectByID($_POST['id']);
                $update_deal->Offer_ID = $_POST['offer'];
                $update_deal->Need_ID =$_POST['need'];
                $update_deal->DateTimeDeal = $_POST['dateDeal']." ".$_POST['timeDeal'];
                $update_deal->Update();
            }
            if(isset($_POST['delete_id']))
            {
                $delete_deal = $deal->SelectByID($_POST['delete_id']);
                $delete_deal->PermamentDelete();
            }

            $all_deals = $deal->Select();
            echo '<table class="tableInfo col-lg-2" border="1">';
            echo '<tr><th></th><th>ID Сделки</th><th>Предложения ID</th><th>Потребности ID</th><th>Дата сделки</th><th>Клиента потребности ID</th><th>Клиента предложения ID</th></tr>';
            foreach ($all_deals as $single_deal)
            {
                echo '<tr>';
                echo "<td><input type='radio' name='radio_id' value='$single_deal->ID_Deal'></td>";
                echo '<td>' . $single_deal->ID_Deal . '</td>';
                echo '<td>' . $single_deal->Offer_ID . '</td>';
                echo '<td>' . $single_deal->Need_ID . '</td>';
                echo '<td>' . $single_deal->DateTimeDeal . '</td>';
                echo '<td>' . $single_deal->Need_Client_ID . '</td>';
                echo '<td>' . $single_deal->Offer_Client_ID . '</td>';
                echo '</tr>';
            }
            echo '</table>';

            function OptionOffer()
            {
                $offer = new Offer();
                $all_offers = $offer->Select();
                foreach ($all_offers as $single_offer)
                {
                    $id = $single_offer->ID_Offer;
                    echo '<option value="'.$id.'">'.$id.'</option>';
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
                        <label for="offer">Предложение</label>
                        <select name="offer">-->
                            <option disabled selected value>Выберите предложение</option>
                            <?php
                            OptionOffer();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="need">Потребность</label>
                        <select name="need">-->
                            <option disabled selected value>Выберите потребность</option>
                            <?php
                            OptionNeed();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="dateTimeDeal">Дата:</label>
                        <input type="date" name="dateDeal">
                        <input type="time" name="timeDeal" required/>
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
                        <label for="offer">Предложение</label>
                        <select name="offer">-->
                            <option disabled selected value>Выберите предложение</option>
                            <?php
                            OptionOffer();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="need">Потребность</label>
                        <select name="need">-->

                            <?php
                            OptionNeed();
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="dateTimeDeal">Дата:</label>
                        <input type="date" name="dateDeal">
                        <input type="time" name="timeDeal" required/>
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

        $('#table_deal').addClass("nonvisible");   
        $('#contact_form_add').removeClass("nonvisible");   

    });

    $('#button_update').click(function(){

        $('#table_deal').addClass("nonvisible");   
        $('#contact_form_update').removeClass("nonvisible");   

    });

    $('.button_cancel').click(function(){

        $('#table_deal').removeClass("nonvisible");   
        $('.contact_form').addClass("nonvisible");     

    });

</script> 

</html>
