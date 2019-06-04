<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Realtor.php";
$realtor = new Realtor();
$select_realtor = $realtor->SelectByID($_POST['id']);
$realtor_json = json_encode($select_realtor);
echo $realtor_json;
?>