<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Deal.php";
$deal = new Deal();
$select_deal = $deal->SelectByID($_POST['id']);
$deal_json = json_encode($select_deal);
echo $deal_json;
?>