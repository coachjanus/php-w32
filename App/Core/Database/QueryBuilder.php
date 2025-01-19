<?php

namespace App\Core\Database;

use App\Core\Database\Connection;
use PDO;

class QueryBuilder
{
    protected $pdo;
    protected $tableName;

    public function __construct() {
        $this->pdo = Connection::connect();

        $this->tableName = $this->tableName ?? strtolower((new \ReflectionClass($this))->getShortName()).'s';

    }

    // category => categories

    public function selectAll(){
    
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    private function executeStatement($sql) {
        $statement = $this->pdo->prepare($sql);
        // var_export($statement);
        $statement->execute();
        var_export($statement);
        return $statement;
    }
}