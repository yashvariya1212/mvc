<?php 

require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Model/Core/Url.php';
require_once 'Model/Core/View.php';


class Controller_Core_Action
{

	public $request = NULL ;
	public $adapter = NULL ;
	public $message = NULL ;
	public $view = NULL ;

	protected function setRequest(Model_Core_Request $request)
	{
		$this->request = $request ;
		return $this;
	}

	public function getRequest()
	{
		if ($this->request) {
			return $this->request;
		} 
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}

	protected function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter ;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter) {
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function setMessageObject(Model_Core_Message $message)
	{
		$this->message = $message;
		return $this;
	}

	public function getMessageObject()
	{
		if ($this->message) {
			return $this->message;
		}
		$message = new Model_Core_Message();
		$this->setMessageObject($message);
		return $message;
	}

	public function setView(Model_Core_View $view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if ($this->view) {
			return $this->view;
		}
		$view = new Model_Core_View();
		$this->setView($view);
		return $view;
	}

	public function redirect($url)
	{
		header("location:".$url);
		exit();
	}

	public function errorAction($action)
	{
		throw new Exception("method:{$action} does not exist", 1);
	}

	public function render()
	{
		$this->getView()->render();
	}
}


?>