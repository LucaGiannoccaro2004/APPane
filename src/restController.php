<?php

	require_once("restHandlers/LoginRestHandler.php");
	require_once("restHandlers/SigninRestHandler.php");

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


?>
