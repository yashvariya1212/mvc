<?php 

class Controller_Product_Media extends Controller_Core_Action
{

	public function gridAction()
	{
		try {

			$request = $this->getRequest();
			$productId = $request->getParam('id');

			$query = "SELECT * FROM `product_media` WHERE `product_id` = '{$productId}'";

			$row = Index::getModel('Product_Media_Row');
			$medias = $row->fetchAll($query);

			$view = Index::getModel('Core_View');
			$view->setTemplate('product_media/grid.phtml')->setData(['medias'=>$medias])->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}
	
	public function addAction()
	{
		try {
			$row = Index::getModel('Product_Media_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}
			$this->getView()->setTemplate('product_media/add.phtml')->setData(['media'=>$row])->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function insertAction()
	{
		try {
			$request = Index::getModel('Core_Request');
			if (!$request->isPost()) {
				throw new Exception("invalid request.", 1);
			}
			$postData = $request->getPost('img');
			if (!$postData) {
				throw new Exception("invalid data.", 1);
			}

			$productId = (int)$request->getParam('id');
			if (!$productId) {
				throw new Exception("invalid data.", 1);
			}
			$postData['product_id'] = $productId;

			date_default_timezone_set('Asia/Kolkata');
			$postData['created_at'] = date('Y-m-d H:i:s');

			$row = Index::getModel('Product_Media_Row');
			$row->setData($postData);
			if (!$insert_id = $row->save()) {
				throw new Exception("Unble to save Product.", 1);
			}

			$filename = $_FILES['uploadfile']['name'];
			$divide = explode(".", $filename);
			$newname = $insert_id. '.' .$divide[1];

			$tempname = $_FILES['uploadfile']['tmp_name'];
			$temp_folder = "view/product_media/temp_folder/".$newname;
			move_uploaded_file($tempname,$temp_folder);

			$image['image'] = $newname;
			$row->load($insert_id)->setData($image)->save();

			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl("product_media","grid"));

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl("product_media","grid"));
		}
	}

	public function updateAction()
	{
		try {

			$request = $this->getRequest();
			if (!$request->isPost()) {
				throw new Exception("Error Processing Request", 1);
			}
			$productId = $request->getParam('id');
			if (!$productId) {
				throw new Exception("invalid ID.", 1);
			}

			$data = ['thumbnail'=> 0,
			'small'=>  0,
			'base'=> 0,
			'gallery'=> 0,
			'product_id'=>$productId]; 

			$row = Index::getModel('Product_Media_Row');
			$row->setData($data);
			$row->getTable()->setprimaryKey('product_id');
			$row->save();


			$thumbnail = $request->getPost('thumbnail'); //id
			$data1 = ['thumbnail'=>1];
			$row->getTable()->setprimaryKey('image_id');
			$row->load($thumbnail)->setData($data1)->save();

			$small = $request->getPost('small'); //id
			$data2 = ['small'=>1];
			$row->getTable()->setprimaryKey('image_id');
			$row->load($small)->setData($data2)->save();

			$base = $request->getPost('base'); //id
			$data3 = ['base'=>1];
			$row->getTable()->setprimaryKey('image_id');
			$row->load($base)->setData($data3)->save();

			if ($gallery = $request->getPost('gallery')) {
				$data4 = ['gallery'=>1];
				$row->getTable()->setprimaryKey('image_id');
				foreach ($gallery as $id) {
					$row->load($id)->setData($data4)->save();
				}
			}

			if ($delete = $request->getPost('delete')) {
				foreach ($delete as $id) {
					$row->load($id)->delete();
				}
			}	

			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl("product_media","grid"));
		} catch (Exception $e) {

			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl("product_media","grid"));
		}

	}
}

?>