<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/RecipeDAO.php");
	require_once("database/Database.php");

	class RecipeRestHandler extends SimpleRest{

		function getAll() {	
			$userDAO  = new RecipeDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectAll();

			if(empty($rawData)) {
				$statusCode = 200;
				$rawData = array('auth' => '0');	
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function getById($id) {	
			$userDAO  = new RecipeDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectById($id);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function insert($categoria) {	
			$userDAO  = new CategorieDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->insert($categoria);
			
			if($rawData) {
				$statusCode = 200;	
			} else {
				$statusCode = 404;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function updateById($categoria, $id) {	
			$userDAO  = new CategorieDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->updateById($categoria, $id);
			
			if($rawData) {
				$statusCode = 200;	
			} else {
				$statusCode = 404;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function deleteById($id) {	
			$userDAO  = new CategorieDAO(Database::getInstance()->getConnection());
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