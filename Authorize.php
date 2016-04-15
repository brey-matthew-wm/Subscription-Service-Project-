<?php
//Set username and password
$username = 'cr';
$password = '250';

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW']) != $password) {
    //If the username/password are incorrect send back authentication errors
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Guitar Wars"');
    exit('<h2>Top Speeds</h2>Sorry, you must enter a valid user name and password to access this page');
}
?>
