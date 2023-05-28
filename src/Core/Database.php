<?php

namespace News\Core;

require_once '../src/utils/constants.php';
require_once VENDOR . 'vlucas/phpdotenv/src/Dotenv.php';

use \PDO;
use \PDOException;
use Dotenv\Dotenv;

class Database
{
    private static $instance = null;
    private $conn = null;

    private function __construct()
    {
        $dotenv = Dotenv::createImmutable(ROOT);
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConn()
    {
        return $this->conn;
    }

    public static function createInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
