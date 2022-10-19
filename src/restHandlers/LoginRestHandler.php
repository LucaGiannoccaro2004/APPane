<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/UserDAO.php");
	require_once("dao/myDao/SessionDAO.php");
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
				$sessionDAO = new SessionDAO(Database::getInstance()->getConnection());
				$sessionDAO->createSession($rawData->id, $token);
				$_SESSION['token'] = $token;
				setcookie("token", $token, time() + (86400 * 30), "/");
				$_SESSION['email'] = $rawData->email;
				$_SESSION['indirizzo'] = $rawData->indirizzo;
				$_SESSION['note'] = $rawData->note;
				$_SESSION['tipo'] = $rawData->tipo;
				$rawData = array(
					'auth' => '1', 
					"token" => $token,
					"email" => $rawData->email,
					"indirizzo" => $rawData->indirizzo,
					"note" => $rawData->note,
					"tipo" => $rawData->tipo);	
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>