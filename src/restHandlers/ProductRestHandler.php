<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/ProductDAO.php");
	require_once("database/Database.php");

	class ProductRestHandler extends SimpleRest{

		function getAll() {	
			$userDAO  = new ProductDAO(Database::getInstance()->getConnection());
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
			$userDAO  = new ProductDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectById($id);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function getPublished() {	
			$userDAO  = new ProductDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectPublished();

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function getPublishedByCat($idCategoria) {	
			$userDAO  = new ProductDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectPublishedByCat($idCategoria);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>