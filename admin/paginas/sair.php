<?php

	unset($_SESSION['login']);
	session_destroy();
	session_start();
	flashMessage("success","Você esta desconectado");
	header("Location: " . ROOT . "admin/login");