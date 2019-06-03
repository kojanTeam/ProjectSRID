<?php
namespace Model;
require_once "ModelBase.php";

class Deal extends ModelBase
{
	
	public $ID_Deal;			

	public $Offer_ID;
	public $Need_ID;
	public $DateTimeDeal;					

	public $Need_Client_ID;
	public $Offer_Client_ID;

	
	protected static $select =
		"SELECT ID_Deal, Need_ID, Offer_ID, DateTimeDeal, Need.Client_ID as Need_Client_ID, Offer.Client_ID as Offer_Client_ID 
		FROM Deal 
		INNER JOIN Need on Need_ID = ID_Need 
		INNER JOIN Offer on Offer_ID = ID_Offer";

	protected static $table = 'Deal';	
	protected static $id = 'ID_Deal';	
	protected static $fields = array('Offer_ID', 'Need_ID','DateTimeDeal');
	protected static $types = "iis";
}
?>