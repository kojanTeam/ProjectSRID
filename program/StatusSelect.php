<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Status.php";
$status = new Status();
$select_status = $status->SelectByID($_POST['id']);
$status_json = json_encode($select_status);
echo $status_json;
?>