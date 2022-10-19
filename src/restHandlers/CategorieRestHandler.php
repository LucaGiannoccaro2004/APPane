<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/CategorieDAO.php");
	require_once("database/Database.php");

	class CategorieRestHandler extends SimpleRest{

		function getAll() {	
			$userDAO  = new CategorieDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectAll();

			if(empty($rawData)) {
				$statusCode = 200;
				$rawData = array('auth' => '0');	
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>