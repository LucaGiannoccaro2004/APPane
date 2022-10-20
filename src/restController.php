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
		}
	}

	function handlePut(){
		$_PUT = createGlobArray();
		echo var_dump($_PUT);
		$api = (isset($_PUT["api"]) ? $_PUT["api"] : "");
		switch($api){
			case "categories":
				$view = (isset($_PUT["update"]) ? $_PUT["update"] : "");
				switch($view){
					case "byId":
						$categoria = (isset($_PUT["categoria"]) ? $_PUT["categoria"] : "");
						$id = (isset($_PUT["id"]) ? $_PUT["id"] : "");
						echo $categoria.$id;
						$paintsRestHandler = new CategorieRestHandler();
						$paintsRestHandler->updateById($categoria, $id);
						break;
				}
				break;
		}
	}

	function handleDelete(){
		
	}

	function auth($token, $typeRequired){
		if(isset($_SESSION['token']) && $_SESSION['token'] == $token && $_SESSION['tipo'] == $typeRequired)
			return true;
		else
			return false;
	}

	
	function createGlobArray(){
		$form_data= json_encode(file_get_contents("php://input"));
			echo var_dump($form_data);
			$key_size=52;
			$key=substr($form_data, 1, $key_size);
			echo var_dump($key);
			$acc_params=explode($key,$form_data);
			echo var_dump($acc_params);
			array_shift($acc_params);
			echo var_dump($acc_params);
	
			echo var_dump($acc_params);
			foreach ($acc_params as $item){
				$start_key=' name=\"';
				$end_key='\"\r\n\r\n';
				$start_key_pos=strpos($item,$start_key)+strlen($start_key);
				$end_key_pos=strpos($item,$end_key);
				echo var_dump($item);
				$key=substr($item, $start_key_pos, ($end_key_pos-$start_key_pos));
				
				$end_value='\r\n';
				$value=substr($item, $end_key_pos+strlen($end_key), -strlen($end_value));
				$_ARRAY[$key]=$value;
			}
			return $_ARRAY;
	}


?>
