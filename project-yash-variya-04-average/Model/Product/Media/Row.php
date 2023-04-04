<?php 

require_once 'Model/Core/Table/Row.php';


class Model_Product_Media_Row extends Model_Core_Table_Row
{
	// protected $tableName = 'product_media';
	// protected $primaryKey = 'image_id';
	protected $tableClass = 'Model_Product_Media';

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
			return $statuses[$this->status];
		} else {
			return $statuses[Model_Admin::STATUS_DEFAULT];
		}
		
	}

	public function getStatus()
	{
		if ($this->status) {
			return $this->status;
		}
		return Model_Admin::STATUS_DEFAULT;
	}
	
}



?>