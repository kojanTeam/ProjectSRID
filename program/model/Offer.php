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
	public $Status_ID;

	public $Realtor_FIO;
	public $Client_FIO;
	public $Status_Name;
	
	protected static $select =
		"SELECT ID_Offer, Realtor_ID, Client_ID, ObjProperty_ID, Price, Status_ID, Realtor.FIO as Realtor_FIO, Client.FIO as Client_FIO, Status.Name as Status_Name 
		FROM Offer
		INNER JOIN Realtor on Realtor_ID = ID_Realtor
		INNER JOIN Client on Client_ID = ID_Client
		INNER JOIN Status on Status_ID = ID_Status";

	protected static $table = 'Offer';
	protected static $id = 'ID_Offer';
	protected static $fields = array('Realtor_ID', 'Client_ID', 'ObjProperty_ID', 'Price', 'Status_ID');
	protected static $types = "iiids";
}
?>