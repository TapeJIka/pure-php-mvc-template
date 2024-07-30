<?php

trait Database {
    //Making db connection
    private function connect() {
        $serverConnection = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
        $connection = new PDO($serverConnection, DBUSER, DBPASS);

        //sql creating users table if it does not exist
        $result = $connection->prepare("CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )");
        $result->execute();

        //sql creating categories table if it does not exist
        $result = $connection->prepare("CREATE TABLE IF NOT EXISTS categories (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            description VARCHAR(60) NOT NULL,
            parent_id int(6) NOT NULL
        )");
        $result->execute();

        //seeding db with test user
        $result = $connection->prepare("SELECT * FROM users WHERE username='test'");
        $result->execute();
        $rowCount = $result->rowCount();
        //check if database already having test user
        if ($rowCount === 0) {
            $password = password_hash('password', PASSWORD_DEFAULT);
            $username = 'test';
            //creates test user
            $result = $connection->prepare("INSERT INTO users (username, password) VALUES ('$username', '$password')");
            $result->execute();
            if (!$result) {
                return false;
            }
        }

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
