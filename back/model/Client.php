<?php
namespace Model;
require_once "ModelBase.php";



class Client extends ModelBase
{
	public $ID_Client;

	public $FIO;
	public $Phone;
	public $Email;



	protected static $select = "SELECT * FROM Client";

	protected static $table = 'Client';
	protected static $id = 'ID_Client';
	protected static $fields = array('FIO', 'Phone', 'Email');
	protected static $types = "sss";
}
?>