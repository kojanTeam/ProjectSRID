<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Offer.php";
$offer = new Offer();
$select_offer = $offer->SelectByID($_POST['id']);
$offer_json = json_encode($select_offer);
echo $offer_json;
?>