<?php 


class Controller_Salesman extends Controller_Core_Action
{

	public function gridAction()
	{
		try {
			$row = Index::getModel('Salesman_Row');
			$query = "SELECT * FROM `salesman`";
			$salesmans = $row->fetchAll($query);

			$this->getView()->setTemplate('salesman/grid.phtml')->setData(['salesmans'=>$salesmans])->render();
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);                
		}
	}

	public function addAction()
	{
		try {
			$row = Index::getModel('Salesman_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}

			$this->getView()->setTemplate('salesman/edit.phtml')->setData(['salesman'=>$row])->render();
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function editAction()
	{
		try {
			$request = $this->getRequest();
			$id = (int) $request->getParam('id');
			if (!$id) {
				throw new Exception("invalid ID.", 1);
			}
			
			$row = Index::getModel('Salesman_Row');
			$query = "SELECT * FROM salesman s INNER JOIN salesmanaddress d ON s.salesman_id = d.salesman_id WHERE s.salesman_id = '{$id}' ";
			$salesman = $row->fetchRow($query);
			if (!$salesman) {
				throw new Exception("invalid data", 1);
			}

			$this->getView()->setTemplate('salesman/edit.phtml')->setData(['salesman'=>$salesman])->render();
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function saveAction()
	{
		try {
			$request = $this->getRequest();
			if (!$request->isPost()) {
				throw new Exception("invalid ID.", 1);
			}

			$salesman = $request->getPost('salesman');
			if (!$salesman) {
				throw new Exception("Data Not Found.", 1);
			}

			$row = Index::getModel('Salesman_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}

			date_default_timezone_set('Asia/Kolkata');
			if (!$id = $request->getParam('id')) {
				$row->created_at = date('Y-m-d H:i:s');
                $insert_id = $row->setData($salesman)->save();
			}else{
				$row->updated_at = date('Y-m-d H:i:s');
				$row->load($id)->setData($salesman)->save(); 
			}

			$salesmanaddress = $request->getPost('salesmanaddress');
			if (!$salesmanaddress) {
				throw new Exception("Address Data Not Found", 1);
			}

			$AddressRow = Index::getModel('Salesman_Address_Row');
			if (!$AddressRow) {
				throw new Exception("invalid ID.", 1);
			}

			if (!$id = $request->getParam('id')) {
				$salesmanaddress['salesman_id'] = $insert_id;
				$AddressRow->getTable()->primaryKey = 'address_id';
			}else{
				$row->updated_at = date('Y-m-d H:i:s'); 
				$AddressRow->load($id);
			}
			
			$AddressRow->setData($salesmanaddress);
			if (!$AddressRow->save()) {
				throw new Exception("Unble to save salesman Address.", 1);
			}

			$this->getMessageObject()->addMessage('Data Saved Succesfully.',Model_Core_Message::SUCCESS);

			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl('Salesman','grid','',TRUE));
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
			$urlObject = new Model_Core_Url();
                $this->redirect($urlObject->getUrl("Salesman","grid",'',TRUE));
		}
	}

	public function deleteAction()
	{
		try {
			$request = $this->getRequest();
			$id = (int) $request->getParam('id');
			if (!$id) {
				throw new Exception("invalid ID.", 1);
			}

			$row = Index::getModel('Salesman_Row');
			$row->load($id)->delete();

			$this->getMessageObject()->addMessage("Data Delete Succesfully",Model_Core_Message::SUCCESS);

			$urlObject = new Model_Core_Url();
			$this->redirect($urlObject->getUrl("Salesman","grid",'',TRUE));
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);                
		}
	}
}

?>