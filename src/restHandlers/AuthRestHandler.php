<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/UserDAO.php");
	require_once("dao/myDao/SessionDAO.php");
	require_once("database/Database.php");

	class AuthRestHandler extends SimpleRest{

		function handleAuth($token, $type) {	
			

			if(!$this->auth($token, $type)) {
				$statusCode = 401;
				$rawData = array('auth' => '0');	
			} else {	
				$statusCode = 200;
				$rawData = array('auth' => '1');
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function auth($token, $typeRequired){
			if(isset($_SESSION['token']) && $_SESSION['token'] == $token){
				if($_SESSION['tipo'] == $typeRequired)
					return true;
				else
					return false;
			}else{
				$userDAO  = new SessionDAO(Database::getInstance()->getConnection());
				$rawData = $userDAO->selectByToken($token);
				if(empty($rawData)) {
					return false;
				} else {
					$user = $rawData->cliente;
					if($user->tipo == $typeRequired){
						$_SESSION['token'] = $token;
						$_SESSION['email'] = $user->email;
						$_SESSION['indirizzo'] = $user->indirizzo;
						$_SESSION['note'] = $user->note;
						$_SESSION['tipo'] = $user->tipo;
						return true;
					}else
						return false;
				}
			}
		}

	}
?>