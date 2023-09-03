<?php

$dbserver = 'localhost';
$dbuser = 'root';
$dbPass = '';
$dbname = 'Classicmodels';

try {
    $conn = new PDO ("mysql:host=$dbserver;dbname=$dbname", $dbuser,$dbPass);
    $conn = setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOexception $err)
{
    echo "failed connect to database server : ".$err->getMessage();
}