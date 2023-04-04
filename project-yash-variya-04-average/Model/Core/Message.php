<?php 

// require_once 'Session.php';

class Model_Core_Message
{
	
	protected $session = NULL ;     
	const SUCCESS = 'success';
	const FAILURE = 'failure';
	const NOTICE = 'notice' ;

	public function __construct()
	{
		$this->getSession();
	}

	public function setSession(Model_Core_Session $session)
	{
		$this->session = $session;
		return $this;
	}

	public function getSession()
	{
		if ($this->session) {
			return $this->session;
		}
		$session = new Model_Core_Session();
		$this->setSession($session);
		return $session;
	}

	public function addMessage($message , $type = Model_Core_Message::SUCCESS)
	{	

		if (!$this->getSession()->has('message')) {
			$this->getSession()->set('message',[]);
		}
		$messages = $this->getMessage();
		$messages[$type] = $message;
		$this->getSession()->set('message',$messages);
		return $this;
	}

	public function getMessage()
	{      
		if (!$this->getSession()->has('message')) {
			return NULL;
		}
		return $this->getSession()->get('message');
	}

	public function removeMessage()
	{
		$sesion = $this->getSession();				
		$sesion->unset('message');
		return $this;
	}


}


?>