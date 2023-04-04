<?php 

require_once "Model/Core/Table/Row.php";


class Model_Payment_Row extends Model_Core_Table_Row
{
	
	protected $tableClass = 'Model_Payment';

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
			return $statuses[$this->status];
		} else {
			return $statuses[Model_Shipping::STATUS_DEFAULT];
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