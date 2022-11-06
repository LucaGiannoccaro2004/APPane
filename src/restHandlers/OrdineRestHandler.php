<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/OrdineDAO.php");
	require_once("database/Database.php");

	class OrdineRestHandler extends SimpleRest{

		function insertMaster($numero, $nota) {	
			$userDAO  = new OrdineDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->insertMaster($numero, $_SESSION['id'], date("y/m/d")." ".date("h:i:sa"), $nota);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function insertDetail($idProdotto, $quantita, $prezzo) {	
				$userDAO  = new OrdineDAO(Database::getInstance()->getConnection());
				$id = $userDAO->getLastId($_SESSION['id']);
			
			$userDAO  = new OrdineDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->insertDetail($idProdotto, $quantita, $id, $prezzo);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>