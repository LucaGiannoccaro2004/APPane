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
				$_SESSION['userId'] = $rawData->id;
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>