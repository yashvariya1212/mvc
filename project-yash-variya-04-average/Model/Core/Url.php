<?php 
// require_once 'Model/Core/Request.php';


class Model_Core_Url
{
	
	public function getCurrentUrl()
	{
		$url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		return $url;
		
	}

	public function getUrl($controller = null, $action = null, $params = [], $resetParam = null)
	{

		$request = new Model_Core_Request();
		$final = $request->getParam();


		if ($resetParam) {
			$final = NULL;
		}

		if ($controller) {
			$final['c'] = $controller;
		} 
		else{
			$final['c'] = $request->getControllerName();
		}

		if ($action) {
			$final['a'] = $action;
		} 
		else{
			$final['a'] = $request->getActionName();
		}

		if ($params) {
			$final = array_merge($final,$params);
		}


		$queryString = http_build_query($final);
		$requestUri = trim($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING']);
		return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$requestUri.$queryString;

	}


}




?>