<?php

namespace Core;

use PDO;
use App\Config;

class Database {

    public $connection;
    public $statement;

    public function __construct() {

        $dsn = "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=utf8";

        $this->connection = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []): static
    {

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function find() {
        return $this->statement->fetch();
    }

    public function findAll() {
        return $this->statement->fetchAll();
    }

    public function findOrFail() {

        $result = $this->find();

        if (!$result) {
            abort();
        }

        return $result;
    }
}