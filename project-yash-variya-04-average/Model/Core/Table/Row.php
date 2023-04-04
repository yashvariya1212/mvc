<?php 

// require_once 'Model/Core/Table.php';
// require_once 'Model/Core/Request.php';

class Model_Core_Table_Row
{
	
	// protected $tableName = NULL;
	// protected $primaryKey = NULL;
	protected $tableClass = 'Model_Core_Table';
	protected $data = [];
	protected $table = NULL;

	public function getTableName()
	{
		return $this->getTable()->gettableName();
	}

	public function getPrimaryKey()
	{
		return $this->getTable()->getprimaryKey();
	}

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}

	public function getTable()
	{
		if ($this->table) {
			return $this->table;
		}
		$tableClass = $this->tableClass;
		$table = new $tableClass(); 
		$this->setTable($table);
		return $table;
	}

	public function addData($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function setData($data)
	{
		$this->data = array_merge($this->data,$data);
		return $this;
	}

	public function getData($key = NULL)
	{
		if (!$key) {
			return $this->data;
		}
		if (!array_key_exists($key, $this->data)) {
			return NULL;
		}
		
		return $this->data[$key];
	}

	public function removeData($key = NULL)
	{
		if ($key == NULL) {
			$this->data = [];
		}
		if (array_key_exists($key,$this->data)) {
			unset($this->data[$key]);
		}
		return $this;
	}

	public function __set($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function __get($key)
	{
		if (!array_key_exists($key, $this->data)) {
			return NULL;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		if (array_key_exists($key, $this->data)) {
			unset($this->data[$key]);
		}
		return $this;
	}

	 public function getId()
    {
        $primaryKey = $this->getTable()->getPrimaryKey();
        return (int)$this->$primaryKey;
    }

    public function setId($id)
    {
        $this->data[$this->getTable()->getPrimaryKey()] = (int)$id;

        return $this;
    }

	public function save() 
	{
		if ($this->getId()){
			$id = $this->getId();
			$this->getTable()->update($id,$this->getData());
			return $this;
		}
		else{
			$insertId = $this->getTable()->insert($this->getData());
			// $this->load($insertId);
			return $insertId;
		}
	}

	public function load($id,$column=NULL)
	{
		if ($column == NULL) {
			$column = $this->getPrimaryKey();
		}
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE $column = '{$id}'";
		$table = $this->getTable();
		$row = $table->fetchRow($query);
		if($row) {
			$this->data = $row;
		}
		return $this;
	}

	public function fetchRow($query)
	{
		$table = $this->getTable(); 
		$row = $table->fetchRow($query);
		if ($row) {
			$this->data = $row;
			return $this;
		}
		return false;
	}

	public function fetchAll($query)  
	{
		$table = $this->getTable();
		$result = $table->fetchAll($query);

		if (!$result) {
			return false;
		}

		foreach ($result as &$row) {
			$row = (new $this)->setData($row)->setTable($this->getTable());
		}

		return $result;
	}

	public function delete()
	{
		$id = $this->getData($this->getPrimaryKey());
		if (!$id) {
			return false;
		}
		$table = $this->getTable();
		$table->delete($id);
		return $this->removeData();
	}
}
?>
