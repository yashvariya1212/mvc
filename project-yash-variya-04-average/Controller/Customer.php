<?php 

class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
        try {
            $row = Index::getModel('Customer_Row');
            $query = "SELECT * FROM `customer`";
            $customers = $row->fetchAll($query);

            $this->getView()->setTemplate('customer/grid.phtml')->setData(['customers'=>$customers])->render();
        } catch (Exception $e) {
            $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);                
        }
    }

    public function addAction()
    {
        try {
            $row = Index::getModel('Customer_Row');
            if (!$row) {
                throw new Exception("invalid ID.", 1);
            }
            $this->getView()->setTemplate('customer/edit.phtml')->setData(['customer'=>$row])->render();

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

            $customer = $request->getPost('customer');
            if (!$customer) {
                throw new Exception("Data Not Found.", 1);
            }

            $row = Index::getModel('Customer_Row');
            if (!$row) {
                throw new Exception("invalid ID.", 1);
            }

            date_default_timezone_set('Asia/Kolkata');

            if (!$id = $request->getParam('id')) {
                     $row->created_at = date('Y-m-d H:i:s');
                     $insert_id = $row->setData($customer)->save();
             }else{
                     $row->updated_at = date('Y-m-d H:i:s'); 
                     $row->load($id)->setData($customer)->save();
            }

            $customeraddress = $request->getPost('customeraddress');

            if (!$customeraddress) {
                throw new Exception("Address Data Not Found", 1);
            }

            $AddressRow = Index::getModel('Customer_Address_Row');
            if (!$AddressRow) {
                throw new Exception("invalid ID.", 1);
            }

            if (!$id = $request->getParam('id')) {
                $customeraddress['costomer_id'] = $insert_id;
                $AddressRow->getTable()->primaryKey = 'address_id';
            }else{
               $AddressRow->updated_at = date('Y-m-d H:i:s');
               $AddressRow->load($id); 
           }

            $AddressRow->setData($customeraddress);
               if (!$AddressRow->save()) {
                throw new Exception("Unble to save customer Address.", 1);
            }

            $this->getMessageObject()->addMessage('Data Saved Succesfully.',Model_Core_Message::SUCCESS);

            $urlObject = Index::getModel('Core_Url');
            $this->redirect($urlObject->getUrl('Customer','grid','',TRUE));

        } catch (Exception $e) {
                $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
                 $urlObject = new Model_Core_Url();
                $this->redirect($urlObject->getUrl("Customer","grid",'',TRUE));
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
            $customerRow = Index::getModel('Customer_Row');
            $query = "SELECT * FROM customer c INNER JOIN costomeraddress d ON c.costomer_id = d.costomer_id WHERE c.costomer_id = '{$id}' ";
            $customer = $customerRow->fetchROW($query);

            if (!$customer) {
                throw new Exception("invalid data", 1);
            }

            $this->getView()->setTemplate('customer/edit.phtml')->setData(['customer'=>$customer])->render();

     } catch (Exception $e) {
             $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
             $urlObject = new Model_Core_Url();
            $this->redirect($urlObject->getUrl("Customer","grid",'',TRUE));
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

        $customerRow = Index::getModel('Customer_Row');
        $customerRow->load($id)->delete();

        $this->getMessageObject()->addMessage("Data Delete Succesfully",Model_Core_Message::SUCCESS);

        $urlObject = new Model_Core_Url();
        $this->redirect($urlObject->getUrl("Customer","grid",'',TRUE));

    } catch (Exception $e) {
        $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);                
        }
    }
}
?>