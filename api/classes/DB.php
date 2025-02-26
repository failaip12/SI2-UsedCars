<?php
declare(strict_types=1);

class DB
{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = null,
            $_results,
            $_count = 0;

    public function __construct()
    {
        try {
            $this->_pdo = new PDO(
                'pgsql:host=' . Config::get('postgres/host') . 
                ';dbname=' . Config::get('postgres/db') . 
                ';port=' . Config::get('postgres/port'),
                Config::get('postgres/username'), 
                Config::get('postgres/password')
            );
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Set the search path to include our schema
            $this->_pdo->exec('SET search_path TO cars, public');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            if ($this->_query->execute($params)) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = (array)$this->_results ? count((array)$this->_results) : 0;
            } else {
                $this->_error = "Error Code:" . $this->_query->errorInfo()[1] . " Error Message: " . $this->_query->errorInfo()[2];
            }
        }
        return $this;
    }

    public function action($action, $table, $where = array())
    {
        // Remove schema prefix if it exists in the table name
        $table = str_replace('cars.', '', $table);
        
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM \"{$table}\" WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        } else {
            $sql = "{$action} FROM \"{$table}\"";
            if (!$this->query($sql)->error()) {
                return $this;
            }
        }
        return false;
    }

    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array())
    {
        // Remove schema prefix if it exists in the table name
        $table = str_replace('cars.', '', $table);
        
        if (count($fields)) {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field) {
                $values .= '?';
                if ($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO \"{$table}\" (\"" . implode('", "', $keys) . "\") VALUES ({$values})";

            if (!$this->query($sql, array_values($fields))->error()) {
                return true;
            }
        }
        return false;
    }

    public function updateUser($table, $id, $fields)
    {
        $set = '';
        $x = 1;
        $parameters = array_values($fields);

        foreach ($fields as $name => $value) {
            $set .= "\"{$name}\" = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }
        if ($table == 'korisnik') {
            $sql = "UPDATE \"{$table}\" SET {$set} WHERE \"korisnik_id\" = ?";
        }
        elseif ($table == 'admin') {
            $sql = "UPDATE \"{$table}\" SET {$set} WHERE \"admin_id\" = ?";
        }
        else {
            return false;
        }
        $parameters[$x - 1] = $id;

        if (!$this->query($sql, $parameters)->error()) {
            return true;
        }
        return false;
    }

    public function results(): mixed
    {
        return $this->_results;
    }

    public function first()
    {
        $data = $this->results();
        if ($data)
            return $data[0];
        else
            return null;
    }

    public function error()
    {
        if (!is_null($this->_error)) {
            return $this->_error;
        }
        return false;
    }

    public function count()
    {
        return $this->_count;
    }
}
