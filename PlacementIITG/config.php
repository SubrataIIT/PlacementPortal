<?php
/*
This file contains database configuration assuming you are running mysql using user "root" and password ""
*/

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'placement_portal');
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "placement_portal";

// Try connecting to the Database
// $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// //Check the connection
// if($conn == false){
//     dir('Error: Cannot connect');
// }
try{
    $conn = new PDO("mysql:host=$servername;dbname=$db_name",$username,$password);
    //set the PDO error mode to ecception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection faild: " .$e->getMessage();

}
?>