<?php
namespace Model;
require_once "ModelBase.php";

class Offer extends ModelBase
{
	public $ID_Offer;

	public $Realtor_ID;
	public $Client_ID;
	public $ObjProperty_ID;
	public $Price;
	public $Status;

	public $Realtor_FIO;
	public $Client_FIO;
	
	protected static $select =
		"SELECT ID_Offer, Realtor_ID, Client_ID, ObjProperty_ID, Price, Status, Realtor.FIO as Realtor_FIO, Client.FIO as Client_FIO 
		FROM Offer
		INNER JOIN Realtor on Realtor_ID = ID_Realtor
		INNER JOIN Client on Client_ID = ID_Client";

	protected static $table = 'Offer';	//название таблицы в бд
	protected static $id = 'ID_Offer';	//название поля с id
	protected static $fields = array('Realtor_ID', 'Client_ID', 'ObjProperty_ID', 'Price', 'Status');
	protected static $types = "iiids";
}
?>