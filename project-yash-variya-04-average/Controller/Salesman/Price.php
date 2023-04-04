<?php 


require_once 'Controller/Core/Action.php';
require_once 'Model/Salesman/Price.php';

class Controller_Salesman_Price extends Controller_Core_Action
{
	public $prices = [];
	public $dropdown = [];

	public function setPrices($prices)
	{
		$this->prices = $prices;
		return $this;
	}

	public function getPrices()
	{
		return $this->prices;
	}

	public function setDropdown($product)
	{
		$this->product = $product;
		return $this;
	}

	public function getDropdown()
	{
		return $this->product;
	}

	public function gridAction()
	{
		try {

			$id = (int)$this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("ID Not Found.", 1);
			}

			$row = Index::getModel('Salesman_Price_Row');
			$query = "SELECT * FROM `product` p LEFT JOIN `salesman_price` sp ON p.`product_id` = sp.`product_id` AND sp.`salesman_id`='{$id}' ORDER BY 'product_id' ASC";
			$prices = $row->fetchAll($query);

			$query2 = "SELECT * FROM `salesman`";
			$salesmen = $row->fetchAll($query2);

			$this->getView()->setTemplate('salesman_price/grid.phtml')->setData(['prices'=>$prices,'salesmen'=>$salesmen])->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);                
		}
	}

	public function updateAction()
	{
		try {
			$row = Index::getModel('Salesman_Price_Row');
			
		} catch (Exception $e) {
			
		}
		echo "1111";die();
		$request = $this->getRequest();
		$data = $request->getPost();
		$query = "";
		echo "<pre>";
		print_r($data);
		die();
	}


}



?>