<?php 

class Controller_Product extends Controller_Core_Action
{

	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `product`";
			$Row = Index::getModel('Product_Row');
			$products = $Row->fetchAll($query);

			$view = Index::getModel('Core_View');
			$view->setTemplate('product/grid.phtml')->setData(['products'=>$products])->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function addAction()
	{
		try {
			$row = Index::getModel('Product_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}
			$this->getView()->setTemplate('product/edit.phtml')->setData(['product'=>$row])->render();

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

			$products = $request->getPost('product');
			if (!$products) {
				throw new Exception("No Data Posted.", 1);
			} 

			$row = Index::getModel('Product_Row');
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

			$row->setData($products);
			if (!$row->save()) {
				throw new Exception("Unble to save Product.", 1);
			}

			$this->getMessageObject()->addMessage('Data Saved Succesfully.',Model_Core_Message::SUCCESS);

			$urlObject = Index::getSingleton('Core_Url');
			$this->redirect($urlObject->getUrl("Product","grid",'',TRUE));

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

 			$Row = Index::getModel('Product_Row');
			$product = $Row->load($id);
			if (!$product) {
				throw new Exception("invalid data", 1);
			}

			$this->getView()->setTemplate('product/edit.phtml')->setData(['product'=>$product])->render();

		} catch (Exception $e) {
			$message = Index::getModel('Core_Message');
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
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

			$Row = Index::getModel('Product_Row');
			$Row->load($id)->delete();

			$message = Index::getModel('Core_Message');
			$message->addMessage("Data Delete Succesfully","success");
			
			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl("Product","grid",'',TRUE));

		} catch (Exception $e) {
			$message = Index::getModel('Core_Message');
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}
}
?>