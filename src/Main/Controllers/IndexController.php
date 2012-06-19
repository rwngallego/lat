<?php

namespace Main\Controllers;

use L8T\Core\Controller;

class IndexController extends Controller{

	public function indexAction(){
		$this->renderView("Main:Index:index.php");
	}
	
	public function loginAction(){
		$this->renderView("Main:Index:login.php");
	}
	
	public function logoutAction(){
		if ($_POST['login']){
			$em = $this->getEntityManager();
		}
	}

}
