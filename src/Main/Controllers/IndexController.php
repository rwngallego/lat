<?php

namespace Main\Controllers;

use LAT\Core\Controller;

/**
 * Index controller
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *
 */
class IndexController extends Controller{

	/**
	 * Index action
	 */
	public function indexAction(){
		$this->goHome($_SESSION['role']);
	}
	
	/**
	 * Login the user
	 */
	public function loginAction(){
		$data = array();

		if (isset($_POST['login']) && $_POST['login']){
			$email = @$_POST['email'];
			$password = md5(@$_POST['password']);
			
			$em = $this->getEntityManager();
			$userRepository = $em->getRepository("Main\\Entity\\User");
			$result = $userRepository->checkLogin($email, $password);
			if ($result === true){
				$user = $userRepository->findOneBy(array('email' => $email));
				
				$_SESSION['access'] = true;
				$_SESSION['userId'] = $user->getId();
				$_SESSION['role'] = $user->getRole();
				
				$this->goHome($user->getRole());
			}
			else
				$data['msg'] = "Bad email or password";
		}
		$this->renderView("Main:Index:login.php", $data);
		
	}
	
	/**
	 * Redirects the user to the home page
	 * @param string $role
	 */
	private function goHome($role){
		if ($role == "ADMIN")
			$this->redirect(get_url("users_list"));
		else
			$this->redirect(get_url("employee_home"));
	}
	
	/**
	 * Logout the user
	 */
	public function logoutAction(){
		session_destroy();
		$this->redirect(get_url("welcome"));
	}

}
