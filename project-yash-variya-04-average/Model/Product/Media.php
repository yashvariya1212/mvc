<?php 

// require_once 'Model/Core/Table.php';

class Model_Product_Media extends Model_Core_Table
{
	
	public $tableName = "product_media";	
	public $primaryKey = "image_id";	
	// public $primaryKey = "product_id";	
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

	public function multiple($id,$condition)
	{
		 foreach ($condition as $key => $value) {
			$values[] = "`".$key."`"."="."'".$value."',";
		}
		 echo $query = "UPDATE `$this->tableName` SET".implode("", $values)." `updated_at`= now()  WHERE `$this->primaryKey` IN ($id)";
		 echo "<br>";

		$adapter = $this->getAdapter();
		$result = $adapter->update($query);
	}

	public function remove($condition)
	{
		echo $query = "DELETE FROM `$this->tableName` WHERE `$this->primaryKey` IN ($condition)";
		$adapter = $this->getAdapter();
		$adapter->delete($query);
		return $this;
	}

}


?>