<?php 

class Controller_Payment extends Controller_Core_Action
{

       public function gridAction()
       {
              try {
                     $query = 'SELECT * FROM `payment`';
                     $row = Index::getModel('Payment_Row');
                     $payments = $row->fetchAll($query);

                     $this->getView()->setTemplate('payment/grid.phtml')->setData(['payments'=>$payments])->render();
                     
              } catch (Exception $e) {
                     $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
              }
       }

       public function addAction()
       {
              try {
                     $row = Index::getModel('Payment_Row');
                     if (!$row) {
                            throw new Exception("invalid ID.", 1);
                     }

                     $this->getView()->setTemplate('payment/edit.phtml')->setData(['payment'=>$row])->render();
                     
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

                     $payments = $request->getPost('payment');
                     if (!$payments) {
                            throw new Exception("No Data Posted.", 1);
                     } 

                     $row = Index::getModel('Payment_Row');
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

                     $row->setData($payments);
                     if (!$row->save()) {
                            throw new Exception("Unble to save Product.", 1);
                     }

                     $this->getMessageObject()->addMessage('Data Saved Succesfully.',Model_Core_Message::SUCCESS);

                     $urlObject = Index::getSingleton('Core_Url');
                     $this->redirect($urlObject->getUrl("payment","grid",'',TRUE));

              } catch (Exception $e) {
                     $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
              }
       }
       
       public function insertAction()
       {
              $request = $this->getRequest();
              if (!$request->isPost()) {
                     throw new Exception("invalid request.", 1);
              }
              $payment = $request->getPost('payment');

              if (!$payment) {
                     throw new Exception("no data posted.", 1);
              } 

              $paymentMethod = new Model_PaymentMethod();
              $paymentMethod->insert($payment);

              $urlObject = new Model_Core_Url();
              $this->redirect($urlObject->getUrl("PaymentMethod","grid"));
       }
       
       
      
       public function editAction()
       {
              try {
                     $request = $this->getRequest();
                     $id = (int) $request->getParam('id');

                     if (!$id) {
                            throw new Exception("invalid ID.", 1);
                     }

                     $row = Index::getModel('Payment_Row');
                     $payment = $row->load($id);

                     if (!$payment) {
                            throw new Exception("invalid data", 1);
                     }

                     $this->getView()->setTemplate('payment/edit.phtml')->setData(['payment'=>$payment])->render();

              } catch (Exception $e) {

                     $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
              }

       }
       
       public function updateAction()
       {
              $request = $this->getRequest();
              $adapter = $this->getAdapter();
              $payment = $request->getPost('payment');
              if (!$payment) {
                     throw new Exception("invalid data.", 1);
              }
              $id = (int) $request->getParam('id');
              if (!$id) {
                     throw new Exception("invalid ID.", 1);
              }

              $paymentMethod = new Model_PaymentMethod();
              $paymentMethod->update($id,$payment);

              $urlObject = new Model_Core_Url();
              $this->redirect($urlObject->getUrl("PaymentMethod","grid",'',TRUE));
       }
       
       public function deleteAction()
       {
              try {
                     $request = $this->getRequest();
                     $id = (int) $request->getParam('id');

                     if (!$id) {
                            throw new Exception("invalid ID.", 1);
                     }

                     $row = Index::getModel('Payment_Row');
                     $row->load($id)->delete();

                     $message = Index::getModel('Core_Message');
                     $message->addMessage("Data Delete Succesfully","success");

                     $urlObject = new Model_Core_Url();
                     $this->redirect($urlObject->getUrl("payment","grid",'',TRUE));
                     
              } catch (Exception $e) {
                     $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
              }
       }
}
?>