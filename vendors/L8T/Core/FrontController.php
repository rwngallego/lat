<?php

namespace L8T\Core;

use L8T\Core\Router;

class FrontController{
	private $router;

	public function __construct(){
		$this->router = new Router();
	}

	public function start(){
		$this->router->set_routes('app/config/routes.xml');
		$this->router->fetch();
	}
}
