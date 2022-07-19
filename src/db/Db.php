<?php

namespace Kirill\Edu\db;

use PDO;

class Db
{
    private static $instance = null;

    /**
     * PDO object. Represents a connection between PHP and a database server.
     */
    protected static $conn;

    private $host = 'localhost';
    private $dbname = 'dbname';
    private $username = 'username';
    private $password = 'password';
    private $sqlQuery;

    private function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];

        self::$conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->username", "$this->password");
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    /**
     * Method for executing custom sql statements.
     *
     * @param string $sql Custom sql statement.
     * @return mixed Returns single row of the first column.
     */
    public static function sql($sql)
    {
        $obj = self::getInstance();
        $obj->sqlQuery = self::$conn->query($sql);
        return $obj;
    }

    public function one()
    {
        return $this->sqlQuery->fetchObject();
    }


    /**
     * Selects all lines from set table.
     *
     * @param string $table Table name.
     */
    public static function read($table)
    {
        $result = self::$conn->query("SELECT * FROM {$table}");
        return $result;
    }

    /**
     * Updates set data using the where condition.
     *
     * Composes attributes and values together one by one, achieving the final sql-query as a result. Then executes it.
     *
     * @param string $table Table name.
     * @param array $data Associative array with keys pointing to names of the attributes and values to their values.
     * @param string $where Full where condition.
     */
    public static function update($table, $data, $where)
    {
        $sql = "UPDATE $table SET ";

        $moreThanOne = false;
        foreach ($data as $attr => $value) {
            if ($moreThanOne) {
                $sql .= ", $attr = $value";
            } else {
                $sql .= "$attr = $value";
                $moreThanOne = true;
            }
        }

        $sql .= "WHERE $where";

        self::$conn->query($sql);
    }

    /**
     * Inserts set attributes with set values
     *
     * @param string $table Table name.
     * @param string $attrs A string of attributes listed one by one, separated with commas.
     * Example "(first, second, third)".
     * @param string $values A string of values.
     * Example "('first', 'second', 'third')".
     */
    public static function insert($table, $attrs, $values)
    {
        self::$conn->query("INSERT INTO $table ($attrs) values ($values)");
    }

    /**
     * Complete deletion of a line based on the where condition.
     *
     * @param string $table Table name.
     * @param string $where Full where condition.
     */
    public static function delete($table, $where)
    {
        self::$conn->query("DELETE FROM $table WHERE $where");
    }

}
