<?php
namespace Model;
require_once "ModelBase.php";



class ObjProperty extends ModelBase
{
	
	public $ID_ObjProperty;			//id (название как в базе)

	public $CoordX;					//поля таблицы (названия как в базе) = второй "блок"
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

	public $TypeObj_Name;			//поля от внешних ключей (названия как алиасы в запросе)

	
	protected static $select = 		//select запрос вместе с нужной инфой от вн ключей (с алиасами) (можно прикрутить мягкое удаление)
		"SELECT ID_ObjProperty, CoordX, CoordY, City, Street, NumHouse, NumApart, Floor, KolvoRoom, Area, NumFloors, TypeObj_ID,
		TypeObj.Name as TypeObj_Name
		FROM ObjProperty 
		INNER JOIN TypeObj ON ID_TypeObj = TypeObj_ID";

	protected static $table = 'ObjProperty';	//название таблицы в бд
	protected static $id = 'ID_ObjProperty';	//название поля с id
	protected static $fields = array('CoordX', 'CoordY', 'City', 'Street', 'NumHouse', 'NumApart', 'Floor', 'KolvoRoom', 'Area', 'NumFloors', 'TypeObj_ID');	//поля таблицы БЕЗ поля с id и инфой по вн коючам (все что во втором "блоке")
	protected static $types = "ddssssiidii";	//типы данных соотв полям из массива выше// d = double, s = string, i = int, (даты как stirng)
}
?>