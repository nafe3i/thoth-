<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // Charger la configuration
        require_once __DIR__ . '/../../config/database.php';
        
        try {
            $this->pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Singleton pattern
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Obtenir l'objet PDO
    public function getConnection() {
        return $this->pdo;
    }

    // Empêcher le clonage
    // private function __clone() {}

    // // Empêcher la désérialisation
    // public function __wakeup() {}
}
