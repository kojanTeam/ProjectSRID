<?php
namespace Model;
require_once "ModelBase.php";



class ObjProperty extends ModelBase
{
	
	public $ID_ObjProperty;

	public $CoordX;	
	public $CoordY;
	public $City;
	public $Street;
	public $NumHouse;
	public $NumApart;
	public $Floor;
	public $KolvoRoom;
	public $Area;
	public $NumFloors;
	public $TypeObj_ID;

	public $TypeObj_Name;

	
	protected static $select =
		"SELECT ID_ObjProperty, CoordX, CoordY, City, Street, NumHouse, NumApart, Floor, KolvoRoom, Area, NumFloors, TypeObj_ID,
		TypeObj.Name as TypeObj_Name
		FROM ObjProperty 
		INNER JOIN TypeObj ON ID_TypeObj = TypeObj_ID";

	protected static $table = 'ObjProperty';
	protected static $id = 'ID_ObjProperty';
	protected static $fields = array('CoordX', 'CoordY', 'City', 'Street', 'NumHouse', 'NumApart', 'Floor', 'KolvoRoom', 'Area', 'NumFloors', 'TypeObj_ID');
	protected static $types = "ddssssiidii";
}
?>