<?php 
define('DB_HOST','localhost');
define('DB_USER','u907926278_rent');
define('DB_PASS','[Qx65Xm88');
define('DB_NAME','u907926278_rent');
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

?>