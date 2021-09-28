<?php

	include("responses/response.php");

	$myresponse = new response;
	 
	if($_POST['n']=='')
	{
		$myresponse->code = '500';
		$myresponse->message = 'El nombre no puede estar vacío';
	}
	else
	{
		$db = new SQLite3('../db/batches.db');
		include("../db/init.php");

		$stm = $db->prepare("INSERT INTO batches(name) VALUES (?)");
		$stm->bindParam(1, $batchName);
		
		$batchName = $_POST['n'];
		$stm->execute();

		$myresponse->code = '200';
		$myresponse->message = '';
	}
	
	echo json_encode($myresponse);
?>