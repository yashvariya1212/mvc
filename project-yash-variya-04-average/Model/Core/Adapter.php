<?php 


class Model_Core_Adapter{

	public	$servername = "localhost";
	public	$username = "root";
	public	$password = "";
	public	$dbname = "project-yash-variya-04-average";



	public function connect(){
		$connect = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
		return $connect;
	}

	public function insert($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return $connect->insert_id;
	}

	public function fetchAll($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		} else {
			return $result->fetch_All(MYSQLI_ASSOC);
		}

	}
	public function fetchRow($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return $result->fetch_assoc();
	}
	public function delete($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return true;
	}

	public function update($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return true;
	}

	public function fetchPairs($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		$data = $result->fetch_all();
		$column1 = array_column($data, '0');
		$column2 = array_column($data, '1');
		if (!$column2) {
			$column2 = array_fill(0, count($column1), null);
		}
		return array_combine($column1, $column2);
	}

	public function fetchOne($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		$row = $result->fetch_array();
		return (array_key_exists(0, $row)) ? $row[0] : null;
	}


}

?>