<?php

$db->exec("CREATE TABLE IF NOT EXISTS batches(id INTEGER PRIMARY KEY, name TEXT)");	
$db->exec("CREATE TABLE IF NOT EXISTS batch_lines(id INTEGER PRIMARY KEY, batch_id INTEGER, line TEXT)");	

?>