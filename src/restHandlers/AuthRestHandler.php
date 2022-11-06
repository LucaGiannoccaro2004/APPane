<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/UserDAO.php");
	require_once("database/Database.php");

	class AuthRestHandler extends SimpleRest{

		function handleAuth($token) {	
			

			if(!$this->auth($token)) {
				$statusCode = 401;
				$rawData = array('auth' => '0');	
			} else {	
				$statusCode = 200;
				$rawData = array('auth' => '1');
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function auth($token){
			if(isset($_SESSION['token']) && $_SESSION['token'] == $token)
				return true;
			return false;
		}

	}
?>