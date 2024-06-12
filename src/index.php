<?php

use Utils\Database;

$dbConfig = require __DIR__ . '/config/database.php';

$database = new Database($dbConfig);
$connection = $database->getConnection();

$database->createTableIfNotExists('karyawan');

for ($i=0; $i < 9; $i++) { 
    $data = $database::generateKaryawan();
    $database->insert('karyawan', $data);
    $dot = 50 - strlen($data['nama']);

    echo implode(" ", [
        $data['nama'],
        str_repeat(".", $dot),
        "created"
    ])."\n";
}
