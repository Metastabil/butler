<?php
namespace App\Models;

use System\Classes\Database;
use PDO;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class BaseModel {
    /**
     * @var Database
     */
    protected Database $database_instance;

    /**
     * @var PDO
     */
    protected PDO $db;

    /**
     * Constructor
     */
    public function __construct() {
        $this->database_instance = new Database();
        $this->db = $this->database_instance->connect();
    }

    /**
     * @param string $folder
     * @param string $file
     * @return string
     */
    protected function query(string $folder, string $file) :string {
        $path = dirname(__DIR__) . "/sql/$folder/$file.sql";

        return file_get_contents($path);
    }
}