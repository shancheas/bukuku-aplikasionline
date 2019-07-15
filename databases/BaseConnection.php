<?php


class BaseConnection
{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $connection;

    protected $table;

    public function __construct() {
        $this->connect();
    }

    private function connect(){
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = 'comnet123!';
        $this->db = 'bukuku';

        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
        return $this->connection;
    }

    public function query($sql){
        $result = $this->connection->query($sql);
        return $result->num_rows;
    }

    public function insert(array $record) {
        $data = $this->arrayToStatement($record);
        $var = $data['var'];
        $values = $data['values'];
        $fields = $this->buildStmtField($data['fields']);
        $query = "INSERT INTO $this->table $fields VALUES $var";

        $stmt = $this->execute($query, $values, $data['types']);
        return $stmt;
    }

    public function whereIn($field, array $record) {
        $data = $this->arrayToStatement($record);
        $var = $data['var'];
        $values = $data['values'];
        $query = "SELECT * FROM $this->table WHERE $field IN $var";

        $stmt = $this->execute($query, $values, $data['types']);
        $results = [];

        if ($stmt->num_rows > 0) {
            while($row = $stmt->fetch_object()) {
                array_push($results, $row);
            }
        }

        return $results;
    }

    public function where(array $params, $glue = 'AND') {
        $data = $this->arrayToStatement($params);
        $values = $data['values'];
        $fields = $data['fields'];
        $query = "SELECT * FROM $this->table WHERE ";
        $fields = array_map(function ($item) {
            return $item . ' = ? ';
        }, $fields);
        $args = implode(" $glue ", $fields);

        $stmt = $this->execute($query . $args, $values, $data['types']);
        return $stmt->fetch_object();
    }

    public function where2(array $params, $glue = 'AND') {
        $data = $this->arrayToStatement($params);
        $values = $data['values'];
        $fields = $data['fields'];
        $query = "SELECT * FROM $this->table WHERE ";
        $fields = array_map(function ($item) {
            return $item . ' = ? ';
        }, $fields);
        $args = implode(" $glue ", $fields);

        $stmt = $this->execute($query . $args, $values, $data['types']);
        $results = [];

        if ($stmt->num_rows > 0) {
            while($row = $stmt->fetch_object()) {
                array_push($results, $row);
            }
        }

        return $results;
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table";
        $result = $this->connection->query($query);
        $results = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_object()) {
                array_push($results, $row);
            }
        }

        return $results;
    }

    public function get($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $result = $this->execute($query, [$id], 's');
        return $result->fetch_object();
    }

    private function execute($query, $params, $types) {
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    private function arrayToStatement(array $array) {
        $fields = [];
        $values = [];
        $var = [];
        $types = '';

        foreach ($array as $key => $value) {
            array_push($fields, $key);
            array_push($values, $value);
            array_push($var, '?');
            $types .= 's';
        }

        return [
            'fields' => $fields,
            'values' => $values,
            'var' => $this->buildStmtField($var),
            'types' => $types
        ];
    }

    private function buildStmtField(array $var) {
        $value = implode(",", $var);
        return '(' . $value . ')';

    }
}