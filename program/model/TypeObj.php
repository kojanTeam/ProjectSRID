<?php
namespace Model;
require_once "ModelBase.php";

class TypeObj extends ModelBase
{
	
	public $ID_TypeObj;

	public $Name;
	


	protected static $select = "SELECT * FROM TypeObj";

	protected static $table = 'TypeObj';
	protected static $id = 'ID_TypeObj';
	protected static $fields = array('Name');
	protected static $types = "s";
}
?>