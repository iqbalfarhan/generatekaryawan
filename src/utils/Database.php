<?php

namespace Utils;

use Faker\Factory;
use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8";
        $username = $config['username'];
        $password = $config['password'];

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function createTableIfNotExists($tablename)
    {
        $sql = "CREATE TABLE IF NOT EXISTS $tablename (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nama VARCHAR(255) NOT NULL,
            posisi VARCHAR(255) NOT NULL,
            usia INT NOT NULL,
            gaji INT NOT NULL
        )";

        try {
            $this->connection->exec($sql);
            echo "Table 'karyawan' created or already exists.\n";
        } catch (PDOException $e) {
            die("Create table failed: " . $e->getMessage());
        }
    }

    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $values = array_values($data);

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute($values);
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

    public static function generateKaryawan()
    {
        $faker = Factory::create('id_ID');

        return [
            'nama' => $faker->name(),
            'posisi' => $faker->randomElement(['manager', 'developer', 'teknisi']),
            'usia' => $faker->randomNumber(2),
            'gaji' => $faker->randomNumber(2)."000000",
        ];
    }
}
