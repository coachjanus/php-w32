<?php

namespace App\Core\Database;

use App\Core\Database\Connection;
use PDO;

class QueryBuilder
{
    protected $pdo;
    protected $tableName;

    protected $fields = [];
    protected $select;
    protected $where;
    protected $join;
    protected $orderBy;
    protected $limit;

    public function __construct() {
        $this->pdo = Connection::connect();

        $this->tableName = $this->tableName ?? strtolower((new \ReflectionClass($this))->getShortName()).'s';

    }

    public function where($where)
    {
        $this->where = $where;
        return $this;
    }

    public function join($join)
    {
        $this->join = $join;
        return $this;
    }

    public function select($fields = [])
    {
        $this->fields = $fields;
        return $this;
    }

    public function query()
    {
        $query = "SELECT ";
        if(count($this->fields)>0) {
            $query .= implode(", ", $this->fields);
        } else {
            $query .= "*";
        }

        $query .= " FROM ";
        $query .= $this->tableName;

        if (!empty($this->join)) {
            foreach ($this->join as $k => $v) {
                $query .= " INNER JOIN ".$k;
                $query .= " ON ".$k;
                $query .= ".id=".$this->tableName;
                $query .= ".".$v;
            }    
        }

        if (!empty($this->where)) {
            $query .= " WHERE ";
            $query .= $this->where;
        }
        return $query;    
    }

    public function all() 
    {
        $statement = $this->pdo->prepare($this->query());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

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

    public function insert($parameters) {
        
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->tableName,
            implode(', ', array_keys($parameters)),
            ':'.implode(', :', array_keys($parameters))
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($parameters);
        } catch(\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function get($id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE id ={$id}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findBy($condition) {
        $sql = "SELECT * FROM {$this->tableName} WHERE $condition";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update($parameters)   {
        $id = $parameters['id'];
        if (isset($parameters['id'])) unset($parameters['id']);
        $values = array_map(function ($key, $value) {
               return "{$key} = '{$value}'";
        }, array_keys($parameters), $parameters);
        $sql = sprintf("UPDATE %s set %s WHERE id = %s", $this->tableName, implode(', ', $values), $id);
        $statement = $this->pdo->prepare($sql);
        return $statement->execute();
     }


     public function delete($id) {
        
        $sql = sprintf(
            "DELETE FROM %s WHERE id=%s",
            $this->tableName, $id
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute();
        } catch(\Exception $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * Adding order query string.
     *
     * @param string $column
     * @param string $order
     *
     * @return $this
     */
    public function orderBy($column, $order = 'ASC')
    {
        $this->orderBy = " order by $column $order";

        return $this;
    }

    /**
     * Adding the limitation clause.
     *
     * @param int $start
     * @param int $end
     *
     * @return $this
     */
    public function limit($start, $end)
    {
        $this->limit = " limit {$start},{$end}";

        return $this;
    }
    
}