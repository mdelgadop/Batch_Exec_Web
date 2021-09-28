<?php

	include("responses/response.php");

	$myresponse = new response;
	 
	if($_POST['i']=='')
	{
		$myresponse->code = '500';
		$myresponse->message = 'El id no puede estar vacío';
	}
	else
	{
		$db = new SQLite3('../db/batches.db');
		include("../db/init.php");

		//DELETE LINES
		$stm = $db->prepare("DELETE FROM batch_lines where id in (?)");
		$stm->bindParam(1, $batchId);
		
		$batchId = $_POST['i'];
		$stm->execute();

		$myresponse->code = '200';
		$myresponse->message = '';
	}
	
	echo json_encode($myresponse);
?>