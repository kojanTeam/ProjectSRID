<?php
namespace Model;
require_once "ModelBase.php";

class Status extends ModelBase
{
	public $ID_Status;

	public $Name;


	
	protected static $select =
		"SELECT * FROM Status";

	protected static $table = 'Status';
	protected static $id = 'ID_Status';
	protected static $fields = array('Name');
	protected static $types = "s";
}
?>