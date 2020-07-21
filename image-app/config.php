<?php 
//database info
$host = 'localhost';
$database = 'imageapp_0710';
$db_user = 'imageapp_0710';
$db_password = 'kglqdgVvkl6lfeDN';

//debug mode values:
//true when developing and troubleshooting
//false when the site is live
define( 'DEBUG_MODE', true );

//connect to the database
$db = new mysqli( $host, $db_user, $db_password, $database );

//kill the page if the DB can't connect
if( $db->connect_errno > 0 ){
	die('Could not connect to Database.');
}

//show or hide notices and warnings
if(DEBUG_MODE){
	error_reporting( E_ALL );
}else{
	error_reporting(0);
}
?>