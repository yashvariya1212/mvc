<?php 

require_once "Model/Core/Table/Row.php";

class Model_Admin_Row extends Model_Core_Table_Row
{
	
	// protected $tableName = 'admin';	
	// protected $primaryKey = 'admin_id';	
	protected $tableClass = 'Model_Admin';	

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