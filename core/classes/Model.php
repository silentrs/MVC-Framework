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

            if(!is_numeric($value)) {
                $template = "%s='%s'";
            }

            $tempPair[] = sprintf($template, $key, $value);
        }

        echo sprintf('SELECT %s FROM %s WHERE %s', $column, $table, implode(' AND ', $tempPair));
        return $this->query(sprintf('SELECT %s FROM %s WHERE %s', $column, $table, implode(' AND ', $tempPair)), []);
    }


    public function exec ($stm) {
        return $this->getConnection()->exec($stm);
    }


}