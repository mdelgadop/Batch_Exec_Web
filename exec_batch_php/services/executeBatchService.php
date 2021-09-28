<?php

	include("responses/responseExecution.php");

	$myresponse = new responseExecution;
	
	if($_POST['bi']=='')
	{
		$myresponse->code = '501';
		$myresponse->message = 'El id del batch no puede estar vacío';
	}
	else if($_POST['li']=='')
	{
		$myresponse->code = '502';
		$myresponse->message = 'El id e la línea no puede estar vacío';
	}
	else
	{
		try {
			$db = new SQLite3('../db/batches.db');
			include("../db/init.php");

			$myQuery = "SELECT id, line FROM batch_lines WHERE batch_id = ".$_POST['bi']." and id = ".$_POST['li']."";
			$res = $db->query($myQuery);

			$lineToExecute='';
			while ($row = $res->fetchArray()) {
				$lineToExecute = "{$row['line']}";
			}

			$myresponse->code = '200';
			$myresponse->message = '';
			$myresponse->line = $lineToExecute;
			$myresponse->result = exec($lineToExecute);
			if($myresponse->result == '')
			{
				$myresponse->result = 'No output for this line';
			}
		} catch (Exception $e) {
			$myresponse->code = '401';
			$myresponse->message = "Excepción capturada: ".$e->getMessage()."";
		}
	}
	
	echo json_encode($myresponse);
?>