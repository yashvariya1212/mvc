<?php 

error_reporting(E_ALL); // report php all errors

session_start();

define("DS", DIRECTORY_SEPARATOR);


spl_autoload_register(function ($className) {   			
			$classPath = str_replace("_", "/", $className);
			require_once "{$classPath}.php";
});





require_once 'Controller/Core/Action.php';
require_once 'Controller/Core/Front.php';

	class Index extends Controller_Core_Action
	{
		
		public static function init()
		{
			$front = new Controller_Core_Front();
			$front->init();
		}

		public static function getModel($className) //Model_Admin_Row //
		{
			$className = "Model_".$className;
			return new $className();			
		}

		public static function getSingleton($className)  //Model_Admin_Row //learn concept
		{
			$className = "Model_".$className;
			if (array_key_exists($className,$GLOBALS)) {
				return $GLOBALS[$className];
			}
			$GLOBALS[$className] = new $className();
			return $GLOBALS[$className];
		}
	}

Index :: init();


?>