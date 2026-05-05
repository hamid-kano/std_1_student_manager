<?php
class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            require_once __DIR__ . '/../../config/database.php';

            if (DB_DRIVER === 'sqlite') {
                $dir = dirname(DB_PATH);
                if (!is_dir($dir)) mkdir($dir, 0755, true);
                $pdo = new PDO('sqlite:' . DB_PATH);
                $pdo->exec('PRAGMA foreign_keys = ON;');
            } elseif (DB_DRIVER === 'mysql') {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
                $pdo = new PDO($dsn, DB_USER, DB_PASS);
            } else {
                throw new RuntimeException('DB_DRIVER غير مدعوم');
            }

            $pdo->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            self::$instance = $pdo;
        }
        return self::$instance;
    }

    private function __construct() {}
    private function __clone()    {}
}
