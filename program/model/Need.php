<?php
namespace Model;
require_once "ModelBase.php";

class Need extends ModelBase
{
	public $ID_Need;			

	public $Realtor_ID;
	public $Client_ID;
	public $TypeObj_ID;
	public $Address;
	public $MinPrice;
	public $MaxPrice;
	public $MinArea;
	public $MaxArea;
	public $MinKolvoRoom;
	public $MaxKolvoRoom;
	public $MinFloor;
	public $MaxFloor;
	public $MinNumFloors;
	public $MaxNumFloors;
	public $Status_ID;

	public $Realtor_FIO;
	public $Client_FIO;
	public $TypeObj_Name;
	public $Status_Name;
	
	protected static $select =
		"SELECT ID_Need,Realtor_ID,Client_ID,TypeObj_ID,Address,MinPrice,MaxPrice,MinArea,MaxArea,MinKolvoRoom, MaxKolvoRoom,MinFloor,MaxFloor,MinNumFloors,MaxNumFloors,Status_ID,Realtor.FIO as Realtor_FIO,Client.FIO as Client_FIO,TypeObj.Name as TypeObj_Name, Status.Name as Status_Name
		FROM Need
		INNER JOIN Realtor on Realtor_ID = ID_Realtor
		INNER JOIN Client on Client_ID = ID_Client
		INNER JOIN TypeObj on TypeObj_ID = ID_TypeObj
		INNER JOIN Status on Status_ID = ID_Status";

	protected static $table = 'Need';
	protected static $id = 'ID_Need';
	protected static $fields = array('Realtor_ID', 'Client_ID', 'TypeObj_ID', 'Address', 'MinPrice', 'MaxPrice', 'MinArea', 'MaxArea', 'MinKolvoRoom', 'MaxKolvoRoom', 'MinFloor','MaxFloor','MinNumFloors','MaxNumFloors','Status_ID');
	protected static $types = "iiisddddiiiiiis";
}
?>