<?php

namespace Main\Controllers;

use Main\Entity\User;
use LAT\Core\Controller;

/**
 * User controller
 *
 * @author rowinson
 *        
 */
class UserController extends Controller {
	
	/**
	 * List the users
	 */
	public function indexAction() {
		$em = $this->getEntityManager ();
		$userRepository = $em->getRepository ( "Main\\Entity\\User" );
		$users = $userRepository->findAll ();
		
		$message = "";
		if (isset ( $_SESSION ['flashMessage'] )) {
			$message = $_SESSION ['flashMessage'];
			unset ( $_SESSION ['flashMessage'] );
		}
		
		$this->renderView ( "Main:User:index.php", array (
				'users' => $users,
				'message' => $message 
		) );
	}
	
	/**
	 * Add a user
	 */
	public function addAction() {
		$this->renderView ( "Main:User:add.php", array (
				'type' => 'add' 
		) );
	}
	
	/**
	 * Edit an user
	 */
	public function editAction() {
		if (! isset ( $_GET ["id"] )) {
			$_SESSION ['flashMessage'] = "The id was not defined";
			$this->redirect ( get_url ( "users_list" ) );
		}
		
		$id = $_GET ["id"];
		
		$em = $this->getEntityManager ();
		$user = $em->getRepository ( "Main\\Entity\\User" )->find ( $id );
		if (! $user) {
			$_SESSION ['flashMessage'] = "The user does not exists";
			$this->redirect ( get_url ( "users_list" ) );
		}
		
		$form_data = array (
				'name' => $user->getName (),
				'email' => $user->getEmail (),
				'role' => $user->getRole () 
		);
		$this->renderView ( "Main:User:add.php", array (
				'type' => 'edit',
				'form_data' => $form_data,
				'userId' => $id 
		) );
	}
	
	/**
	 * Performs the update of the editing
	 */
	public function editUpdateAction() {
		if (! isset ( $_GET ["id"] )) {
			$_SESSION ['flashMessage'] = "The id was not defined";
			$this->redirect ( get_url ( "users_list" ) );
		}
		if ($_SERVER ['REQUEST_METHOD'] == "POST") {
			$id = $_GET ['id'];
			
			$name = $_POST ["name"];
			$email = $_POST ["email"];
			$role = $_POST ["role"];
			$password = $_POST ["password"];
			
			$em = $this->getEntityManager ();
			
			$user = $em->getRepository ( "Main\\Entity\\User" )->find ( $id );
			if (! $user) {
				$_SESSION ['flashMessage'] = "The user does not exist";
				$this->redirect ( get_url ( "users_list" ) );
			}
			
			$user->setName ( $name )->setEmail ( $email )->setRole ( $role );
			if ($password != "")
				$user->setPassword ( md5 ( $password ) );
			
			$em->persist ( $user );
			$em->flush ();
			
			$_SESSION ['flashMessage'] = "The user was edited successfully";
		}
		$this->redirect ( get_url ( "users_list" ) );
	}
	
	/**
	 * Delete a user
	 */
	public function deleteAction() {
	}
}

?>