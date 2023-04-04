<?php 

class Controller_Shipping extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = 'SELECT * FROM `shipping_method`';
			$row = Index::getModel('Shipping_Row');
			$shippings = $row->fetchAll($query);

			$this->getView()->setTemplate('shipping/grid.phtml')->setData(['shippings'=>$shippings])->render();
			
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function addAction()
	{
		try {
			$row = Index::getModel('Shipping_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}

			$this->getView()->setTemplate('shipping/edit.phtml')->setData(['shipping'=>$row])->render();
			
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function saveAction()
	{
		try {

			$request = $this->getRequest();
			if (!$request->isPost()) {
				throw new Exception("invalid request.", 1);
			}

			$shippings = $request->getPost('shipping');
			if (!$shippings) {
				throw new Exception("No Data Posted.", 1);
			} 

			$row = Index::getModel('Shipping_Row');
			if (!$row) {
				throw new Exception("Error Processing Request", 1);
			}

			date_default_timezone_set('Asia/Kolkata');
			if ($id = $request->getParam('id')) {
				$row->updated_at = date('Y-m-d H:i:s');
				$row->load($id);
			}else{
				$row->created_at = date('Y-m-d H:i:s');
			}

			$row->setData($shippings);

			if (!$row->save()) {
				throw new Exception("Unble to save Product.", 1);
			}

			$this->getMessageObject()->addMessage('Data Saved Succesfully.',Model_Core_Message::SUCCESS);

			$urlObject = Index::getSingleton('Core_Url');
			$this->redirect($urlObject->getUrl("shipping","grid",'',TRUE));

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

			$row = Index::getModel('Shipping_Row');
			$shipping = $row->load($id);

			if (!$shipping) {
				throw new Exception("invalid data", 1);
			}

			$this->getView()->setTemplate('shipping/edit.phtml')->setData(['shipping'=>$shipping])->render();

		} catch (Exception $e) {

			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
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

			$row = Index::getModel('Shipping_Row');
			$row->load($id)->delete();

			$message = Index::getModel('Core_Message');
			$message->addMessage("Data Delete Succesfully","success");

			$urlObject = new Model_Core_Url();
			$this->redirect($urlObject->getUrl("Shipping","grid",'',TRUE));
			
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}
}
?>