<?php 
class Controller_Category extends Controller_Core_Action
{

	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `category`";
			$row = Index::getModel('Category_Row'); 
			$categorys = $row->fetchAll($query);

			$this->getView()->setTemplate('category/grid.phtml')->setData(['categorys'=>$categorys]);
			$this->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}


	public function addAction()
	{
		try {
			 $row = Index::getModel('Category_Row');
			 if (!$row) {
			 	throw new Exception("invalid ID.", 1);
			 }

			 $this->getView()->setTemplate('category/edit.phtml')->setData(['category'=>$row])->render();
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function insertAction()
	{
		try {
			$request = $this->getRequest();
			if (!$request->isPost()) {
				throw new Exception("invalid request.", 1);
			}
			$category = $request->getPost('category');

			if (!$category) {
				throw new Exception("No data posted.", 1);
			} 

			$categoryRow = $this->getCategoryRow();
			$categoryRow->setData($category);
			$categoryId = $categoryRow->save()->category_id;

			if (!$categoryId) {
				throw new Exception("Data Not Insert Succesfully", 1);
			}
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$urlObject = new Model_Core_Url();
		$this->redirect( $urlObject->getUrl("category","grid"));

	}


	public function editAction()
	{
		try {

			$request = $this->getRequest();
			$id = (int) $request->getParam('id');

			if (!$id) {
				throw new Exception("invalid ID.", 1);
			}

			$row = Index::getModel('Category_Row');
			$category =	$row->load($id);
			if (!$category) {
				throw new Exception("Data Not Found.", 1);
			}

			$this->getView()->setTemplate('category/edit.phtml')->setData(['category'=>$category])->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

	}

	public function updateAction()
	{
		try {
			$request = $this->getRequest();
			$adapter = $this->getAdapter();
			$category = $request->getPost('category');
			if (!$category) {
				throw new Exception("invalid data.", 1);
			}
			$id = (int) $request->getParam('id');
			if (!$id) {
				throw new Exception("invalid ID.", 1);
			}

			$categoryRow = $this->getCategoryRow();
			$categoryRow->setData($category)->save();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$urlObject = new Model_Core_Url(); 
		$this->redirect( $urlObject->getUrl("category","grid",'',TRUE));
	}	

	public function deleteAction()
	{
		try {
			$request = $this->getRequest();
			$id = (int) $request->getParam('id');
			if (!$id) {
				throw new Exception("invalid ID.", 1);
			}

			$categoryRow = Index::getModel('Category_Row');
			$categoryRow->load($id)->delete();

			$this->getMessageObject()->addMessage('Data Delete Succesfully.',Model_Core_Message::SUCCESS);

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$urlObject = new Model_Core_Url(); 
		$this->redirect( $urlObject->getUrl("category","grid",'',TRUE));

	}
}
?>