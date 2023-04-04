<?php 

// require_once 'Adapter.php';

class Model_Core_Table
{
	public $tableName = NULL;
	public $primaryKey = NULL;
	public $adapter = NULL;

	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter) {
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function settableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function gettableName()
	{
		return $this->tableName;
	}

	public function setprimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getprimaryKey()
	{
		return $this->primaryKey;
	}

	public function fetchAll($query)
	{
		$adapter = $this->getAdapter();
		$results = $adapter->fetchAll($query);
		return $results;
	}

	public function insert($data)
	{
		if(is_array($data)) 
		{
			$keyString = implode("`,`", array_keys($data));
			$valueString = implode('\',\'', $data);
			
			echo $query = "INSERT INTO `$this->tableName`(`{$keyString}`) VALUES ('{$valueString}')";
			
			return $this->getAdapter()->insert($query);
		}
	}

	public function fetchRow($query)
	{
		$adapter = $this->getAdapter();
		$result = $adapter->fetchRow($query);
		return $result;	
	}

	public function update($condition,$data)  
	{
		$set = [];
		foreach ($data as $key => $value) {
			$set[] = "`".$key."`"."="."'".$value."',";
		}

		$where = "";								
		if (is_array($condition)) {  
			foreach ($condition as $column => $value) {
				$where .= '`'.$column.'` = "'.$value.'" AND ' ;
			}
		}else{
			$where = '`'.$this->getPrimaryKey().'` = "'.$condition.'"'; 
		}

        date_default_timezone_set('Asia/Kolkata');
        $updateAt =	date('Y-m-d H:i:s');

		echo  $query = "UPDATE `$this->tableName` SET ".implode("", $set)." `updated_at`= '{$updateAt}'  WHERE $where ";

		$adapter = $this->getAdapter();
		$result = $adapter->update($query);
	}

	public function delete($condition)
	{
		$where = "";
		if (is_array($condition)) {
			foreach ($condition as $column => $value) {
				$where .= '`'.$column.'` = "'.$value.'" AND ' ;
			}
		} else {
			$where = "`".$this->primaryKey."`='".$condition."'";
		}
		echo $query = "DELETE FROM `$this->tableName` WHERE $where";
		$adapter = $this->getAdapter();
		$adapter->delete($query);
	}



}

?>