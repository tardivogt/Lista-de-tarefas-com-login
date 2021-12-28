<?php
session_start();
$base = 'http://localhost';

$serverName = "sherlock.no-ip.org,7556";
$databaseName = "estagio_web";
$uid = "web_estagio";
$pwd = "W3b@Estagio$#";

$pdo = new PDO("sqlsrv:server = $serverName; Database = $databaseName;", $uid, $pwd);
