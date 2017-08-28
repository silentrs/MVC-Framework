<<<<<<< HEAD
<?php

namespace core\classes;

abstract class Model
{
    protected static $table;
    const SQL_AND = ' AND ';

    /** @var \PDO */
    private static $dbInstance = null;

    /**
     * @return \PDO
     */
    protected function getConnection()
    {
        if (is_null(self::$dbInstance)) {
            $setup = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ];

            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', env('db_hostname'), env('db_database'), 'UTF8');
            self::$dbInstance = new \PDO($dsn, env('db_username'), env('db_password'), $setup);
        }

        return self::$dbInstance;
    }

    /**
     * @param $sql
     * @param array $args
     * @return \PDOStatement
     */
    public function query($sql, array $args = [])
    {
        $db = $this->getConnection();

        $stm = $db->prepare($sql);
        $stm->execute($args);

        return $stm;
    }


    /**
     * @param $sql
     * @param array $args
     * @return bool
     */
    public function queryBool($sql, array $args = [])
    {
        $db = $this->getConnection();

        $stm = $db->prepare($sql);
        return $stm->execute($args);
    }

    /**
     * @param array $column
     * @param string $table
     * @return \PDOStatement
     */
    public function select(array $column, $table = null)
    {
        if (is_null($table)) {
            $table = static::$table;
        }

        if (is_array($column)) {
            $column = implode(', ', $column);
        }

        return $this->query(sprintf('SELECT %s FROM `%s`', $column, $table), []);
    }

    /**
     * @param array $column
     * @param array $fields
     * @param string $table
     * @return \PDOStatement
     */
    public function where(array $column, array $fields, $table = null)
    {
        if (is_null($table)) {
            $table = static::$table;
        }

        if (is_array($column)) {
            $column = implode(', ', $column);
        }

        $tempPair = [];
        foreach ($fields as $key => $value) {
            $template = "%s=%s";

            if (!is_numeric($value)) {
                $template = "%s='%s'";
            }

            $tempPair[] = sprintf($template, $key, $value);
        }

        # echo sprintf('SELECT %s FROM %s WHERE %s', $column, $table, implode(self::SQL_AND, $tempPair));
        return $this->query(sprintf('SELECT %s FROM %s WHERE %s', $column, $table, implode(self::SQL_AND, $tempPair)), []);
    }

    public function insert(array $columns, array $fields)
    {
        // todo: добавить возможность использования только одного аргумента ["filedName" => "value"]
        $column = $field = [];
        $n = count($columns);

        // todo: заменить на array_walk
        for ($i = 0; $i < $n; $i++) {
            $column[] = '`' . $columns[$i] . '`';
            // ассоциативный массив для подготовленых запросов
            $field[':' . $columns[$i]] = $fields[$i];
        }

        // имена полей: id, name, age, ...
        $columnStr = implode(', ', $column);

        // имена для подготовленных запросов: :id, :name, :age, :...
        $fieldNameStr = implode(', ', array_keys($field));

        return $this->queryBool(sprintf('INSERT INTO %s (%s) VALUES (%s);', static::$table, $columnStr, $fieldNameStr), $field);
    }


    public function exec($stm)
    {
        return $this->getConnection()->exec($stm);
    }


====== =
<?php
namespace core\classes;

// TODO: переписать с использованием RedBeanPHP
abstract class Model
{
    protected static $table;
    /** @var \PDO */
    private static $dbInstance = null;
    private $selectSql;
    private $whereSql;
    public $whereFields;

    /**
     * @return \PDO
     */
    private function getConnection()
    {
        if (is_null(self::$dbInstance)) {
            $setup = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ];

            self::$dbInstance = new \PDO(sprintf('mysql:host=%s;dbname=%s;charset=%s', env('db_hostname'), env('db_database'), 'UTF8'), env('db_username'), env('db_password'), $setup);
        }

        return self::$dbInstance;
    }

    /**
     * @param $sql
     * @param array $args
     * @return \PDOStatement
     */
    public function query($sql, array $args = [])
    {
        $db = $this->getConnection();

        $stm = $db->prepare($sql);
        $stm->execute($args);

        return $stm;
    }

    /**
     * @param array $column
     * @param string $table
     * @return \PDOStatement
     */
    public function select(array $column, $table = null)
    {
        if (is_null($table)) {
            $table = static::$table;
        }

        if (is_array($column)) {
            $column = implode(', ', $column);
        }

        return $this->query(sprintf('SELECT %s FROM `%s`', $column, $table), []);
    }

    /**
     * @param array $column
     * @param array $fields
     * @param string $table
     * @return \PDOStatement
     */
    public function where(array $column, array $fields, $table = null)
    {
        if (is_null($table)) {
            $table = static::$table;
        }

        if (is_array($column)) {
            $column = implode(', ', $column);
        }

        $tempPair = [];
        foreach ($fields as $key => $value) {
            $template = "%s=%s";

            if (!is_numeric($value)) {
                $template = "%s='%s'";
            }

            $tempPair[] = sprintf($template, $key, $value);
        }

        echo sprintf('SELECT %s FROM %s WHERE %s', $column, $table, implode(' AND ', $tempPair));
        return $this->query(sprintf('SELECT %s FROM %s WHERE %s', $column, $table, implode(' AND ', $tempPair)), []);
    }


    public function exec($stm)
    {
        return $this->getConnection()->exec($stm);
    }


>>>>>>> parent of c0fbb3d... push
}