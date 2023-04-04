<?php 

// require_once "Model/Core/Table/Row.php";

class Model_Category_Row extends Model_Core_Table_Row
{

	// protected $tableName = 'category';
	// protected $primaryKey = 'category_id';
	protected $tableClass = 'Model_Category';

	const STATUS_ACTIVE  =  1;
	const STATUS_ACTIVE_LBL = 'Active' ;
	const STATUS_INACTIVE  =  2;
	const STATUS_INACTIVE_LBL = 'Inactive';

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
				return $statuses[$this->status];
		}
		return $statuses[Model_Category::STATUS_DEFAULT];
	}
}

?>