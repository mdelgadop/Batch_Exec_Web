<?php

	include("responses/responseLinesOfBatch.php");

	$myresponse = new responseLinesOfBatch;
	$myresponse->lines = array();
	$myresponse->numlines=0;
	
	if($_POST['i']=='')
	{
		$myresponse->code = '500';
		$myresponse->message = 'El id no puede estar vacío';
	}
	else
	{
		try {
			$db = new SQLite3('../db/batches.db');
			include("../db/init.php");

			//SELECT LINES
			$res = $db->query("SELECT id, line FROM batch_lines WHERE batch_id = ".$_POST['i']."");

			$i=0;
			while ($row = $res->fetchArray()) {
				$current_line = new lineOfBatch;
				$current_line->id = "{$row['id']}";
				$current_line->line = "{$row['line']}";
				$myresponse->lines[$i] = $current_line;
				$i++;
			}

			$myresponse->code = '200';
			$myresponse->message = '';
			$myresponse->numlines=$i;
			
		} catch (Exception $e) {
			$myresponse->code = '401';
			$myresponse->message = "Excepción capturada: ".$e->getMessage()."";
		}
	}
	
	echo json_encode($myresponse);
?>