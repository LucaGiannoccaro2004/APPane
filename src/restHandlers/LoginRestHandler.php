<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/UserDAO.php");
	require_once("database/Database.php");

	class LoginRestHandler extends SimpleRest{

		function handleLogin($email, $password) {	
			$userDAO  = new UserDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectByEmailAndPassword($email, md5($password));

			if(empty($rawData)) {
				$statusCode = 401;
				$rawData = array('auth' => '0');	
			} else {
				$token = md5(uniqid(rand(), true));
				$_SESSION['id'] = $rawData->id;
				$_SESSION['token'] = $token;
				setcookie("token", $token, time() + (86400 * 30), "/");
				$_SESSION['email'] = $rawData->email;
				$_SESSION['indirizzo'] = $rawData->indirizzo;
				$_SESSION['note'] = $rawData->note;
				$rawData = array(
					'auth' => '1', 
					"token" => $token,
					"email" => $rawData->email,
					"indirizzo" => $rawData->indirizzo,
					"note" => $rawData->note);	
				if(isset($_SESSION['cartToken'])){
					$userDAO  = new CartDAO(Database::getInstance()->getConnection());
					$rawData = $userDAO->udateIdCliente($_SESSION['id'], $_SESSION['cartToken']);
				}
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>