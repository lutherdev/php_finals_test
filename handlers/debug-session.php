<?php
require_once '../bootstrap.php';
require_once '../utils/auth.util.php';

Auth::init();
header('Content-Type: application/json');

echo json_encode($_SESSION['user'] ?? "not logged in");
