<?php 
//database info
$host = 'localhost';
$database = 'imageapp_0710';
$db_user = 'imageapp_0710';
$db_password = 'kglqdgVvkl6lfeDN';

//connect to the database
$db = new mysqli( $host, $db_user, $db_password, $database );

//kill the page if the DB can't connect
if( $db->connect_errno > 0 ){
	die('Could not connect to Database.');
}
?>