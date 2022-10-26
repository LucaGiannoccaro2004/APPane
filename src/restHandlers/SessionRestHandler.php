<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/SessionDAO.php");
	require_once("database/Database.php");

	class SessionRestHandler extends SimpleRest{

		function handleGetSession($token) {	
			$sessionDAO  = new SessionDAO(Database::getInstance()->getConnection());
			$rawData = $sessionDAO->selectByToken();

			if(empty($rawData)) {
				$statusCode = 401;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		
		function handleCreateSession($clienteId, $token) {	
			$sessionDAO  = new SessionDAO(Database::getInstance()->getConnection());
			$rawData = $sessionDAO->createSession($clienteId, $token);

			if(empty($rawData)) {
				$statusCode = 401;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>