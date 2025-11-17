<?php
namespace Model;

use PDO;
use PDOException;

class Database
{
    private static $pdo = null;
    private static $config = null;

    public static function init(array $cfg)
    {
        self::$config = $cfg;
    }

    public static function getConnection(): PDO
    {
        if (self::$pdo) return self::$pdo;
        $c = self::$config;
        $dsn = "mysql:host={$c['host']};dbname={$c['dbname']};charset={$c['charset']}";
        try {
            self::$pdo = new PDO($dsn, $c['user'], $c['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return self::$pdo;
        } catch (PDOException $e) {
            exit('Database connection failed.');
        }
    }
}