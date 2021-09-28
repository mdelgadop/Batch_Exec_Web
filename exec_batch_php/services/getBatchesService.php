<?php

	include("responses/responseBatches.php");

	$myresponse = new responseBatches;
	$myresponse->batches = array();
	$myresponse->numbatches=0;
	
		try {
			$db = new SQLite3('../db/batches.db');
			include("../db/init.php");

			//SELECT BATCHES
			$res = $db->query("SELECT id, name FROM batches");

			$i=0;
			while ($row = $res->fetchArray()) {
				$current_batch = new batch;
				$current_batch->id = "{$row['id']}";
				$current_batch->name = "{$row['name']}";
				$myresponse->batches[$i] = $current_batch;
				$i++;
			}

			$myresponse->code = '200';
			$myresponse->message = '';
			$myresponse->numbatches=$i;
			
		} catch (Exception $e) {
			$myresponse->code = '401';
			$myresponse->message = "Excepción capturada: ".$e->getMessage()."";
		}
	
	echo json_encode($myresponse);
?>