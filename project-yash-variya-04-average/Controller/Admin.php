<?php 

class Controller_Admin extends Controller_Core_Action
{
	public function gridAction()
	{
		try {

			$query = "SELECT * FROM `admin` ORDER BY `admin_id` ASC;";
			$row = Index::getModel('Admin_Row');
			$admins = $row->fetchAll($query);

			$view = $this->getView();
			$view->setTemplate('admin/grid.phtml')
			->setData(['admins'=>$admins]);
			$this->render();
		} catch (Exception $e) {
			$message = Index::getModel('Core_Message');
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function addAction()
	{
		try {
			$row = Index::getModel('Admin_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}
			$this->getView()->setTemplate('admin/edit.phtml')->setData(['admin'=>$row])->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function editAction()
	{
		try {
			$request = Index::getModel('Core_Request');
			$id = (int)$request->getParam('id');
			if (!$id) {
				throw new Exception("invalid ID.", 1);
			}

			$adminRow = Index::getModel('Admin_Row');
			$row = $adminRow->load($id);

			$view = Index::getModel('Core_View');
			$view->setTemplate('admin/edit.phtml')->setData(['admin'=>$row])->render();
			
		} catch (Exception $e) {
			$message = Index::getModel('Core_Message');
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function saveAction()
	{
		try {
			$request = Index::getModel('Core_Request');
			if (!$request->isPost()) {
				throw new Exception("invalid Request.", 1);
			}

			$data = $request->getPost('admin');
			if (!$data) {
				throw new Exception("No data posted.", 1);
			}
			$adminRow = Index::getModel('Admin_Row')->load($id);

			if ($id =(int)$request->getParam('id')) {
				$adminRow->updated_at = date('Y-m-d H:i:s');
				$adminRow->load($id);
			}else{
				$adminRow->created_at =date('Y-m-d H:i:s');
			}

			$adminRow->setData($data);
			if (!$adminRow->save()) {
				throw new Exception("Unble to save Admin.", 1);
			}

			$urlObject = Index::getSingleton('Core_Url');
			$this->redirect($urlObject->getUrl("admin","grid",'',TRUE));			

		} catch (Exception $e) {
			$message = Index::getModel('Core_Message');
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function deleteAction()
	{
		try {
			$request = Index::getModel('Core_Request');
			$id = (int)$request->getParam('id');
			if (!$id) {
				throw new Exception("invalid ID.", 1);
			}

			$row = Index::getModel('Admin_Row');
			$row->load($id)->delete();

			$message = Index::getModel('Core_Message');
			$message->addMessage('Data Delete Succesfully',Model_Core_Message::SUCCESS);

			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl('admin','grid','',TRUE));
		} catch (Exception $e) {
			$message = Index::getModel('Core_Message');
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}
}

?>