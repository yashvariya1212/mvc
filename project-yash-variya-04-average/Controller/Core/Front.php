<?php 

require_once 'Model/Core/Request.php';

class Controller_Core_Front
{

	protected $request = null ;
	
	public function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
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


	public function init()
	{

		$request = $this->getRequest();
		$controllerName = $request->getControllerName();   // product_media  
		$actionName = $request->getActionName()."Action";

		$controllerClassName = "Controller_".ucwords($controllerName, "_");  // Controller_Product_Media
		$controllerClassPath = str_replace("_", "/", $controllerClassName);  // Controller/Product/Media

		require_once "{$controllerClassPath}.php";
		$controller = new $controllerClassName() ;

		// $controller and $this(gridaction) both same

		if (method_exists($controller, $actionName) == false) {
			$controller->errorAction($actionName);
		}
		else{
			$controller->$actionName();
		}
	}
}
?>


