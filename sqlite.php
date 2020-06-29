<?php
	$db	= 	new SQLite3('Day21.db');
	if($db->lastErrorCode() == 0 ) {
		echo "Database connection succeed!\n";
	}
	else {
		echo "Database connection failed!\n";
	}

	$db->exec("CREATE TABLE IF NOT EXISTS Day21 (
		name	text, 
		day	integer,
		status	text,
		created	datetime,
		cr_date	text,
		cr_time text)");

	echo "TABLE Day21 created!\n";
	
/*
	$stmt = $db->prepare("INSERT INTO Day21 (name, day, status, created) VALUES (:name, :day, :status, current_timestamp)");
	$stmt->bindValue(':name', 'Jason');
	$stmt->bindValue(':day', 15);
	$stmt->bindValue(':status', 'OK');
	$stmt->execute(); 
	echo "1 record created!\n";
*/

	$res = $db->query('SELECT * FROM Day21');
	while ($row = $res->fetchArray()) {
    		echo "{$row['name']} {$row['day']} {$row['status']} {$row['cr_date']} {$row['cr_time']} {$row['created']}  \n";
	}

	$db->close();
?>
