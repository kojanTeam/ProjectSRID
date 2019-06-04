<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Client.php";
$client = new Client();
$select_client = $client->SelectByID($_POST['id']);
$client_json = json_encode($select_client);
echo $client_json;
?>