<?php

 define('DBSERVER', 'localhost'); 
 define('DBUSERNAME', 'root'); // Database username

define('DBPASSWORD', ''); 
define('DBNAME', 'demo'); // Database name



/* connect to MySQL database */

 $db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME); 

// Check db connection



 if($db === false){
    die("Error: connection error." . mysqli_connect_error());


}

?>