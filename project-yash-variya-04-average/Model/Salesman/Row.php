<?php 

// require_once 'Model/Core/Table/Row.php';

class Model_Salesman_Row extends Model_Core_Table_Row
{
	protected $tableClass = 'Model_Salesman';
	
	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
			return $statuses[$this->status];
		}
		return $statuses[Model_Vendor::STATUS_DEFAULT];
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