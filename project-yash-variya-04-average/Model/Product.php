<?php 

// require_once 'Core/Table.php';

class Model_Product extends Model_Core_Table
{
	public $tableName = "product";
	public $primaryKey = "product_id";

	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT = 2;

	public function getStatusOptions()
	{
		return [
 					self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
 					self::STATUS_INACTIVE=>self::STATUS_INACTIVE_LBL
				];
	} 

}

?>
