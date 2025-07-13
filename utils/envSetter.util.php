<?php
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$dbConfig = [
    'pgHost' => $_ENV['PG_HOST'],
    'pgPort' => $_ENV['PG_PORT'],
    'pgDB' => $_ENV['PG_DB'],
    'pgUser' => $_ENV['PG_USER'],
    'pgPassword' => $_ENV['PG_PASS'],
];

$runningInsideDocker = file_exists('/.dockerenv');

if ($runningInsideDocker) {
    $dbConfig['pgHost'] = $_ENV['PG_HOST'] = 'host.docker.internal'; 
    $dbConfig['pgPort'] = $_ENV['PG_PORT'] = '3333';
} else {
    $dbConfig['pgHost'] = $_ENV['PG_HOST'] = 'localhost';
    $dbConfig['pgPort'] = $_ENV['PG_PORT'] = '3333';
}