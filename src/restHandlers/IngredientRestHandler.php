<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/IngredientDAO.php");
	require_once("database/Database.php");

	class IngredientRestHandler extends SimpleRest{

		function getAll() {	
			$userDAO  = new IngredientDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectAll();

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function insert($nome, $descrizione) {	
			$userDAO  = new IngredientDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->insert($nome, $descrizione);
			
			if($rawData) {
				$statusCode = 200;	
			} else {
				$statusCode = 404;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function updateById($nome, $descrizione, $id) {	
			$userDAO  = new IngredientDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->updateById($nome, $descrizione, $id);
			
			if($rawData) {
				$statusCode = 200;	
			} else {
				$statusCode = 404;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function deleteById($id) {	
			$userDAO  = new IngredientDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->deleteById($id);
			
			if($rawData) {
				$statusCode = 200;	
			} else {
				$statusCode = 404;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>