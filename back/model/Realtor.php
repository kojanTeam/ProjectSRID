<?php
namespace Model;
require_once "ModelBase.php";

class Realtor extends ModelBase
{
	
	public $ID_Realtor;

	public $Email;
	public $Password;
	public $FIO;
	public $CommissionSare;

	
	
	protected static $select = "SELECT * FROM Realtor";

	protected static $table = 'Realtor';
	protected static $id = 'ID_Realtor';
	protected static $fields = array('Email', 'Password', 'FIO', 'CommissionSare');
	protected static $types = "sssd";
}
?>