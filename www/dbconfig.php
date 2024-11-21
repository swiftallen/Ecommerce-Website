<?php

$dbName = 'multishop';

$envFile = __DIR__ . '/.env';
$envData = file_get_contents($envFile);

$lines = explode("\n", $envData);
foreach ($lines as $line) {
    $line = trim($line);
    if ($line && strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        putenv("$key=$value");
    }
}

$dbHost = getenv('dbHost');
$dbUser = getenv('dbUser');
$dbPass = getenv('dbPass');
$dbPort = getenv('dbPort');

$conn = new mysqli($dbHost,$dbUser,"$dbPass",$dbName,$dbPort);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
