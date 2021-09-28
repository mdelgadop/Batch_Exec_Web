<?php

	include("responses/response.php");

	$myresponse = new response;
	 
	if($_POST['i']=='')
	{
		$myresponse->code = '501';
		$myresponse->message = 'La línea debe estar asociada a un batch';
	}
	else if($_POST['l']=='')
	{
		$myresponse->code = '502';
		$myresponse->message = 'La línea debe tener un comando';
	}
	else
	{
		$db = new SQLite3('../db/batches.db');
		include("../db/init.php");

		$stm = $db->prepare("INSERT INTO batch_lines(batch_id, line) VALUES (?, ?)");
		$stm->bindParam(1, $batchId);
		$stm->bindParam(2, $line_of_batch);
		
		$batchId = $_POST['i'];
		$line_of_batch = $_POST['l'];
		$stm->execute();

		$myresponse->code = '200';
		$myresponse->message = '';
	}
	
	echo json_encode($myresponse);
?>