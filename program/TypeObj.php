<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\TypeObj.php";
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
                    url: "TypeObj.php",
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
                    url: "TypeObjSelect.php",
                    type: "post",
                    data: "id="+id,
                    success: function(data){
                        var json = $.parseJSON(data);
                        $("#contact_form_update input[name='id']").val(json.ID_TypeObj);
                        $("#contact_form_update input[name='name']").val(json.Name);
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
        <div class="row" id="table_type">
            <h3>Типы объектов</h3>
            <?php
            $typeobj = new TypeObj();

            if(isset($_POST['button_add_ok']))
            {
                $typeobj->Name = $_POST['name'];
                $typeobj->Insert();
            }
            if(isset($_POST['button_upd_ok']))
            {
                $update_typeobj = $typeobj->SelectByID($_POST['id']);
                $update_typeobj->Name = $_POST['name'];
                $update_typeobj->Update();
            }
            if(isset($_POST['delete_id']))
            {
                $delete_typeobj = $typeobj->SelectByID($_POST['delete_id']);
                $delete_typeobj->PermamentDelete();
            }

            $all_typeobjs = $typeobj->Select();

            echo '<table class="tableInfo col-lg-2" border="1">';
            echo '<tr><th></th><th>ID Типа недвижимости</th><th>Тип недвижимости</th></tr>';
            foreach ($all_typeobjs as $single_typeobj)
            {
                echo '<tr>';
                echo "<td><input type='radio' name = 'radio_id' value='$single_typeobj->ID_TypeObj'></td>";
                echo '<td>' . $single_typeobj->ID_TypeObj . '</td>';
                echo '<td>' . $single_typeobj->Name . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="col-lg-2 buttons">
                <button id="button_add">Добавить</button>
                <button id="button_update" name = "button_update">Редактировать</button>
                <button id="button_delete" name = "button_delete">Удалить</button>
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
                        <label for="name">Наименование:</label>
                        <input type="text" name="name"  placeholder="Дом" required />
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
                        <label for="name">Наименование:</label>
                        <input type="text" name="name" placeholder="Дом" required />
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

        $('#table_type').addClass("nonvisible");   
        $('#contact_form_add').removeClass("nonvisible");   

    });

    $('#button_update').click(function(){

        $('#table_type').addClass("nonvisible");   
        $('#contact_form_update').removeClass("nonvisible");   

    });

    $('.button_cancel').click(function(){

        $('#table_type').removeClass("nonvisible");   
        $('.contact_form').addClass("nonvisible");     

    });

</script> 

</html>