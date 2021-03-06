<?php

/**
 * Created by PhpStorm.
 * User: SANSON ROOT
 * Date: 11/12/2015
 * Time: 10:34 PM
 */
class DB
{
    private static $instance = null;
    private $_pdo,
        $_query,
        $_results,
        $_error = false,
        $_count = 0;


    private function __construct()
    {

        try {
            InitDB::testDB();
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') .
                ';dbname=' . Config::get('mysql/db'),
                Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {

        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            if (count($params)) {
                $index = 1;
                foreach ($params as $param) {
                    $this->_query->bindValue($index, $param);
                    $index++;
                }
            }
            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $table, $where = array())
    {
        if (count($where) == 3) {
            $operators = array('=', '>', '<', '>=', '<=', 'like');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];


            if (in_array($operator, $operators)) {
                if($table==='elections'||$table==='results'){
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ORDER BY position";
                }else{
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                }

                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }elseif(count($where)==0){
            $sql = "{$action} FROM {$table} ";
            if (!$this->query($sql, array())->error()) {
                return $this;
            }
        }
        return false;
    }

    public function insert($table, $fields = array())
    {
        if (count($fields)) {
            $keys = array_keys($fields);
            $value = '';
            $counter = 1;
            foreach ($fields as $field) {
                $value .= '?';
                if ($counter < count($fields)) {
                    $value .= ',';
                }
                $counter++;
            }
            $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$value})";

            if (!$this->query($sql, $fields)->error()) {
                return true;
            }

        }
        return false;
    }

    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function update($table,$id='id',$idValue, $fields)
    {

        $set = '';
        $counter = 1;
        foreach ($fields as $name => $value) {
            $set .= "{$name}=?";
            if ($counter < count($fields)) {
                $set .= ', ';
            }
            $counter++;
        }
        $sql = "UPDATE {$table} SET {$set} WHERE {$id} = {$idValue}";
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;

    }

    public function delete($table, $where)
    {
        return $this->action('DELETE', $table, $where);
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        return $this->_results[0];
    }

    public function count()
    {
        return $this->_count;
    }

    public function error()
    {
        return $this->_error;
    }

}