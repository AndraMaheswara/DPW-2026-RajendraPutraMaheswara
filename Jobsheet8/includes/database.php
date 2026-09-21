<?php

$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'postgres';
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

if (!$host || !$user || !$password) {
    throw new RuntimeException('Environment variables database belum lengkap. Periksa DB_HOST, DB_USER, dan DB_PASSWORD di Vercel.');
}

$pdo = new PDO(
    "pgsql:host={$host};port={$port};dbname={$dbname}",
    $user,
    $password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);
