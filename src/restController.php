<?php

	require_once("restHandlers/LoginRestHandler.php");
	require_once("restHandlers/SigninRestHandler.php");
	require_once("restHandlers/AuthRestHandler.php");
	require_once("restHandlers/SessionRestHandler.php");
	require_once("restHandlers/CategorieRestHandler.php");
	require_once("restHandlers/IngredientRestHandler.php");
	require_once("restHandlers/ProductRestHandler.php");

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
			case "ingredients":
				$view = (isset($_GET["view"]) ? $_GET["view"] : "");
				switch($view){
					case "all":
						$loginRestHandler = new IngredientRestHandler();
						$loginRestHandler->getAll();
						break;
				}
				break;
			case "products":
				$view = (isset($_GET["view"]) ? $_GET["view"] : "");
				switch($view){
					case "all":
						$loginRestHandler = new ProductRestHandler();
						$loginRestHandler->getAll();
						break;
					case "byId":
						$loginRestHandler = new ProductRestHandler();
						$loginRestHandler->getById($_GET['id']);
						break;
					case "published":
						$loginRestHandler = new ProductRestHandler();
						$loginRestHandler->getPublished();
						break;
				}
				break;
			// case "adminAuth":
			// 	!auth($_COOKIE["token"], "Admin") ? header("location: http://localhost/APPane/public/") : header("location: http://localhost/APPane/authAdmin/".$_GET["page"]);
				
			// 	break;
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
			case "auth":
				$view = (isset($_POST["auth"]) ? $_POST["auth"] : "");
				$signinRestHandler = new AuthRestHandler();
				$signinRestHandler->handleAuth($_POST['token'], $view);
				break;
			case "categories":
				$paintsRestHandler = new CategorieRestHandler();
				$paintsRestHandler->insert($_POST['categoria']);
				break;
			case "ingredients":
				$paintsRestHandler = new IngredientRestHandler();
				$paintsRestHandler->insert($_POST['nome'], $_POST['descrizione']);
				break;
		}
	}

	function handlePut(){
		$_PUT = createGlobArray();
		$api = (isset($_PUT["api"]) ? $_PUT["api"] : "");
		switch($api){
			case "categories":
				$view = (isset($_PUT["update"]) ? $_PUT["update"] : "");
				switch($view){
					case "byId":
						$categoria = (isset($_PUT["categoria"]) ? $_PUT["categoria"] : "");
						$id = (isset($_PUT["id"]) ? $_PUT["id"] : "");
						$paintsRestHandler = new CategorieRestHandler();
						$paintsRestHandler->updateById($categoria, $id);
						break;
				}
				break;
			case "ingredients":
				$view = (isset($_PUT["update"]) ? $_PUT["update"] : "");
				switch($view){
					case "byId":
						$paintsRestHandler = new IngredientRestHandler();
						$paintsRestHandler->updateById($_PUT["nome"], $_PUT["descrizione"], $_PUT["id"]);
						break;
				}
				break;
		}
	}

	function handleDelete(){
		$_DELETE = createGlobArray();
		$api = (isset($_DELETE["api"]) ? $_DELETE["api"] : "");
		switch($api){
			case "categories":
				$view = (isset($_DELETE["delete"]) ? $_DELETE["delete"] : "");
				switch($view){
					case "byId":
						$paintsRestHandler = new CategorieRestHandler();
						$paintsRestHandler->deleteById($_DELETE['id']);
						break;
				}
				break;
			case "ingredients":
				$view = (isset($_DELETE["delete"]) ? $_DELETE["delete"] : "");
				switch($view){
					case "byId":
						$paintsRestHandler = new IngredientRestHandler();
						$paintsRestHandler->deleteById($_DELETE['id']);
						break;
				}
				break;
		}
	}
	
	function createGlobArray(){
		$form_data= json_encode(file_get_contents("php://input"));
			$key_size=52;
			$key=substr($form_data, 1, $key_size);
			$acc_params=explode($key,$form_data);
			array_shift($acc_params);
			foreach ($acc_params as $item){
				$start_key=' name=\"';
				$end_key='\"\r\n\r\n';
				$start_key_pos=strpos($item,$start_key)+strlen($start_key);
				$end_key_pos=strpos($item,$end_key);
				$key=substr($item, $start_key_pos, ($end_key_pos-$start_key_pos));
				
				$end_value='\r\n';
				$value=substr($item, $end_key_pos+strlen($end_key), -strlen($end_value));
				$_ARRAY[$key]=$value;
			}
			return $_ARRAY;
	}


?>
