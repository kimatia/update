
<?php
session_start();
define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "kimatia7950");
define('DB_TABLE', "progressbar");
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_TABLE) or die('Mysql Not connected');
?>