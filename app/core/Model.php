<?php

trait Model {

    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];

    //SQL getting all records and sort its desc
    public function all()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }
    //SQL query to find specific rows from table model->where(['where row' => value,'where row' => value], [where not => value,'where row' => value])
    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :". $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :". $key . " && ";
        }

        $query = trim($query," && ");

        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }
    //SQL query to get first row from table model->first(['where row' => value,'where row' => value], [where not => value,'where row' => value])
    public function first($data, $data_not = []) {
        $result = $this->where($data, $data_not);

        if (isset($result)) {
            return $result[0];
        }
        return false;
    }
    //SQL query to create object model->insert(['row' => value])
    public function insert ($data) {
        //Checks for allowed data, and removes unwanted data
        if(!empty($this->allowedColums))
        {
            foreach ($data as $key) {
                if (!in_array($key, $this->allowedColums())){
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(",",$keys).") VALUES (:".implode(",:",$keys).")";
        $result = $this->query($query, $data);

        if (isset($result)) {
            return $result;
        }
        return false;
    }
    //SQL query to update object
    public function update ($id, $id_column = 'id', $data) {
        //Checks for allowed data, and removes unwanted data
        if(!empty($this->allowedColums))
        {
            foreach ($data as $key) {
                if (!in_array($key, $this->allowedColums())){
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $data[$id_column] = $id;
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= $key . " = :". $key .",";
        }

        $query = trim($query, ", ");
        $query .= " WHERE $id_column = :$id_column";

        $this->query($query, $data);

        return false;
    }
    //SQL query to delete object delete(id,'id_column')
    public function delete ($id, $id_column = 'id') {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column ";
        $this->query($query, $data);

        return false;
    }
}
