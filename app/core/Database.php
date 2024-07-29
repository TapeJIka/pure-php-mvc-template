<?php

trait Database {
    //Making db connection
    private function connect() {
        $serverConnection = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
        $connection = new PDO($serverConnection, DBUSER, DBPASS);

        return $connection;
    }
    //SQL query.To prevent sql injection putting the result into array
    public function query($query, $data = []) {
        $connection = $this->connect();
        $stm = $connection->prepare($query);

        $check = $stm->execute($data);
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }

        return false;
    }
}
