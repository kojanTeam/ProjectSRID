<?php
namespace Model;
require_once "model\ModelBase.php";
require_once "model\Realtor.php";

session_start();

$realtor = new Realtor();
$all_realtors = $realtor->Select();

$email = $_POST['email'];
$password = $_POST['password'];
$check = false;
foreach ($all_realtors as $single_realtor)
{
	if($email==$single_realtor->Email&&$password==$single_realtor->Password)
	{
		$_SESSION['id'] = $single_realtor->ID_Realtor;
		$check = true;
		echo "<script> document.location = 'Main.php'</script>";
	}
}
if (!$check)
{
	echo "Неправильные логин или пароль!";
}
?>