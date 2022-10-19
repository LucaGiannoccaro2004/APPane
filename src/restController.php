<?php

	require_once("restHandlers/LoginRestHandler.php");
	require_once("restHandlers/SigninRestHandler.php");
	require_once("restHandlers/SessionRestHandler.php");
	require_once("restHandlers/CategorieRestHandler.php");

	session_start();

	$method = $_SERVER['REQUEST_METHOD'];

	switch ($method) {
		case 'GET':
			handleGet();
			break;
		case 'POST':
			handlePost();
			break;
		case 'PUT':
			handlePut();
			break;
		case 'DELETE':
			handleDelete();
			break;
	}

	function handleGet(){
		$api = (isset($_GET["api"]) ? $_GET["api"] : "");
		switch($api){
			case "categories":
				$view = (isset($_GET["view"]) ? $_GET["view"] : "");
				switch($view){
					case "all":
						$loginRestHandler = new CategorieRestHandler();
						$loginRestHandler->getAll();
						break;
				}
				break;
			case "adminAuth":
				!auth($_COOKIE["token"], "Admin") ? header("location: http://localhost/APPane/public/") : true;
				break;
		}
	}

	function handlePost(){
		$api = (isset($_POST["api"]) ? $_POST["api"] : "");
		switch($api){
			case "login":
				$loginRestHandler = new LoginRestHandler();
				$loginRestHandler->handleLogin($_POST['email'], $_POST['password']);
				break;
			case "signin":
				$signinRestHandler = new SigninRestHandler();
				$signinRestHandler->handleSignin($_POST['email'], $_POST['password'], $_POST['indirizzo'], $_POST['note']);
				break;
		}
	}

	function handlePut(){

	}

	function handleDelete(){
		
	}

	function auth($token, $typeRequired){
		if(isset($_SESSION['token']) && $_SESSION['token'] == $token && $_SESSION['tipo'] == $typeRequired)
			return true;
		else
			return false;
	}


?>
