<?php

$server = 'localhost';
$username = 'oyarech_user';
$password = 'xjXpRTP3dNuGpAte';
$connection = mysql_connect($server, $username, $password);
$db = mysql_select_db('oyarech_db', $connection)or die(mysql_error());
?>