<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\TypeObj.php";
$typeobj = new TypeObj();
$select_typeobj = $typeobj->SelectByID($_POST['id']);
$typeobj_json = json_encode($select_typeobj);
echo $typeobj_json;
?>