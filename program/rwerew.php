<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Client.php";
require_once "model\ObjProperty.php";


/*$ops = ObjProperty::Select();
$last = end($ops);
$last->City = "воркута";
$last->Update();*/

$client = new Client();
$client->FIO = 'gnome';
$client->Phone = '123456';
$client->Email = 'gonme@gmail.com';
$client->Insert();
?>