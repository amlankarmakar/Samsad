<?php

$mysql_server	= 'localhost';
$mysql_login	= 'sambook_samsad';
$mysql_password = 'w5HoM<4m6D@<Yst';
$mysql_database = 'sambook_samsad';

mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT state_name "
	."FROM list_state "
	."WHERE state_name LIKE '%".$_REQUEST['term']."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['state_name']);
}

echo json_encode($results);

?>