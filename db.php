<?php 
$host="127.0.0.1";
$dbname="makemytrip";
$user="postgres";
$port="5432";

$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if(conn){
	echo "connected";
}
?>
