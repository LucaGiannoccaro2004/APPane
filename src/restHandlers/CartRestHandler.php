<?php

	require_once("util/SimpleRest.php");
	require_once("dao/myDao/CartDAO.php");
	require_once("database/Database.php");

	class CartRestHandler extends SimpleRest{

		function selectByToken() {	
			echo $_SESSION['cartToken'];
			$userDAO  = new CartDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectByToken($_SESSION['cartToken']);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function selectByIdCliente() {	
			echo $_SESSION['id'];
			$userDAO  = new CartDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->selectByIdCliente($_SESSION['id']);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function udateIdCliente() {	
			$userDAO  = new CartDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->udateIdCliente($_SESSION['id'], $_SESSION['cartToken']);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

		function insert($idProdotto, $quantita) {	
			if(!isset($_SESSION['cartToken']))
				$_SESSION['cartToken'] = md5(uniqid(rand(), true));
			$userDAO  = new CartDAO(Database::getInstance()->getConnection());
			$rawData = $userDAO->insert(isset($_SESSION['id']) ? $_SESSION['id'] : 0, $idProdotto, $quantita, $_SESSION['cartToken']);

			if(empty($rawData)) {
				$statusCode = 200;
			} else {
				$statusCode = 200;
			}

			echo $this->formatResponse($rawData, $statusCode);
		}

	}
?>