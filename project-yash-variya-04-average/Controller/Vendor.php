<?php 


class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$row = Index::getModel('Vendor_Row');
			$query = "SELECT * FROM `vendor`";
			$vendors = $row->fetchAll($query);

			$this->getView()->setTemplate('vendor/grid.phtml')->setData(['vendors'=>$vendors])->render();

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);                
		}
	}
	
	public function addAction()
	{
		try {
			$row = Index::getModel('Vendor_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}

			$this->getView()->setTemplate('vendor/edit.phtml')->setData(['vendor'=>$row])->render();
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

			$vendor = $request->getPost('vendor');
			if (!$vendor) {
				throw new Exception("Data Not Found.", 1);
			}

			$row = Index::getModel('Vendor_Row');
			if (!$row) {
				throw new Exception("invalid ID.", 1);
			}

			date_default_timezone_set('Asia/Kolkata');
			if (!$id = $request->getParam('id')) {
				$row->created_at = date('Y-m-d H:i:s'); 
                $insert_id = $row->setData($vendor)->save();
			}else{
				$row->updated_at = date('Y-m-d H:i:s');
                $row->load($id)->setData($vendor)->save();
			}

			$vendoraddress = $request->getPost('vendoraddress');
			if (!$vendoraddress) {
				throw new Exception("Address Data Not Found", 1);
			}

			$AddressRow = Index::getModel('Vendor_Address_Row');
			if (!$AddressRow) {
				throw new Exception("invalid ID.", 1);
			}

			if (!$id = $request->getParam('id')) {
				$vendoraddress['vendor_id'] = $insert_id;
                $AddressRow->getTable()->primaryKey = 'address_id';
			}else{
				$row->updated_at = date('Y-m-d H:i:s');
                $AddressRow->load($id); 
			}
			
			$AddressRow->setData($vendoraddress);
			if (!$AddressRow->save()) {
				throw new Exception("Unble to save vendor Address.", 1);
			}

			$this->getMessageObject()->addMessage('Data Saved Succesfully.',Model_Core_Message::SUCCESS);

			$urlObject = Index::getModel('Core_Url');
			$this->redirect($urlObject->getUrl('Vendor','grid','',TRUE));


		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
			$urlObject = new Model_Core_Url();
                $this->redirect($urlObject->getUrl("Vendor","grid",'',TRUE));
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
			
			$row = Index::getModel('Vendor_Row');
			$query = "SELECT * FROM vendor v INNER JOIN vendoraddress d ON v.vendor_id = d.vendor_id WHERE v.vendor_id = '{$id}' ";
			$vendor = $row->fetchRow($query);
			if (!$vendor) {
				throw new Exception("invalid data", 1);
			}

			$this->getView()->setTemplate('vendor/edit.phtml')->setData(['vendor'=>$vendor])->render();
		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
			$urlObject = new Model_Core_Url();
                $this->redirect($urlObject->getUrl("Vendor","grid",'',TRUE));
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

			$row = Index::getModel('Vendor_Row');
			$row->load($id)->delete();

			$this->getMessageObject()->addMessage("Data Delete Succesfully",Model_Core_Message::SUCCESS);

			$urlObject = new Model_Core_Url();
			$this->redirect($urlObject->getUrl("Vendor","grid",'',TRUE));

		} catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);                
		}
	}
}

?>