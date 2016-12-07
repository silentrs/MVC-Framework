<?php
namespace core\classes;

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


    public function select($column, $table = null)
    {
        if (is_null($table)) {
            $table = static::$table;
        }

        if (is_array($column)) {
            $column = implode(', ', $column);
        }

        $sql = sprintf('SELECT %s FROM `%s`', $column, $table);

        $this->selectSql = $sql;

        return $this;
    }

    public function where(array $fields)
    {
        $where = [];

        foreach ($fields as $field => $value) {
            $where[] = "{$field} = :{$field}";
        }

        $this->whereSql = implode(' AND ', $where);
        $this->whereFields = $fields;

        return $this;
    }

    /**
     * @return \PDOStatement
     */
    public function fetch()
    {
        $sql = $this->selectSql;
        $sql .= (isset($this->whereSql)) ? ' WHERE ' . $this->whereSql : '';

        return $this->query((string)$sql, $this->whereFields)->fetch();
    }

}