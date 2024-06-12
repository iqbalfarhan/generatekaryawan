<?php

use Symfony\Component\Dotenv\Dotenv;
use Utils\Helper;

require_once __DIR__ . '/../../vendor/autoload.php';

// Inisialisasi Dotenv
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/../../.env');

// Mengambil konfigurasi database dari .env
return [
    'host' => Helper::env('DB_HOST', '127.0.0.1'),
    'port' => Helper::env('DB_PORT', '3306'),
    'database' => Helper::env('DB_DATABASE', 'mydatabase'),
    'username' => Helper::env('DB_USERNAME', 'root'),
    'password' => Helper::env('DB_PASSWORD', ''),
];
