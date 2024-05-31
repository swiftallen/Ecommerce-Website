<?php

$dbName = 'multishop';

// Read .env file
$envFile = __DIR__ . '/../.env';
$envData = file_get_contents($envFile);

// Parse .env data
$lines = explode("\n", $envData);
foreach ($lines as $line) {
    $line = trim($line);
    if ($line && strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        putenv("$key=$value");
    }
}

// Access environment variables
$dbHost = getenv('dbHost');
$dbUser = getenv('dbUser');
$dbPass = getenv('dbPass');
$dbPort = getenv('dbPort');

$conn = new mysqli($dbHost,$dbUser,$dbPass,$dbName,$dbPort);

?>
