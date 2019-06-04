<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\ObjProperty.php";
$objproperty = new ObjProperty();
$select_objproperty = $objproperty->SelectByID($_POST['id']);
$objproperty_json = json_encode($select_objproperty);
echo $objproperty_json;
?>