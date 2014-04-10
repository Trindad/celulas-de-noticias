<?php

function flashMessage($tipo, $texto)
{
	$_SESSION['mensagem']['tipo'] = $tipo;
	$_SESSION['mensagem']['texto'] = $texto;
}

function showFlashMessage()
{
	if (!isset($_SESSION['mensagem']))
		return;

	echo <<<EOD
	<div class='alert alert-{$_SESSION['mensagem']['tipo']}'>
		<strong>{$_SESSION['mensagem']['texto']}</strong>
	</div>
EOD;

	unset($_SESSION['mensagem']);
}