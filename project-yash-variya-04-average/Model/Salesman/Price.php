<?php 
require_once 'Model/Core/Table.php';

/**
 * 
 */
class Model_Salesman_Price extends Model_Core_Table
{
	function __construct()
	{
		$this->settableName("salesman_price");
		$this->setprimaryKey("entity_id");
	}
	

}




?>