<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Need.php";
$need = new Need();
$select_need = $need->SelectByID($_POST['id']);
$need_json = json_encode($select_need);
echo $need_json;
?>