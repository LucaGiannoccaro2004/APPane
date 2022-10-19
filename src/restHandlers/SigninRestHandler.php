<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/UserDAO.php");
	
	class SigninRestHandler extends SimpleRest{

		function handleSignin($email, $password, $indirizzo, $note) {	
			$userDAO  = new UserDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->createUser($email, md5($password), $indirizzo, $note);
			
			if($rawData) {
				$statusCode = 200;	
			} else {
				$statusCode = 404;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>