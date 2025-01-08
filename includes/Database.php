<?php
require_once '../config.php';
class Database {
    private static $instance;
    private $connection;

    private function __construct() {
        try {
            $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function execute($query, $params = array()) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchOne($query, $params = array()) {
        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function fetchAll($query, $params = array()) {
        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return array();
    }

    public function insertId() {
        return $this->connection->lastInsertId();
    }
}

?>