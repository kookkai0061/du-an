<?php 
    //Start Session
    session_start();


    //Create Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/food1/'); 
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '00619412');
    define('DB_NAME', 'food-order1'); 


$conn = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());
$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_connect_error());
?>