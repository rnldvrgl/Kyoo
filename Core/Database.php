<?php
// For MySQL queries

namespace Core;

// require '../config/connection.php';

use PDO;

class Database
{
    public $connection;

    public $statement;

    // Default value for $username = 'root' and $password = ''
    public function __construct($config, $username = 'root', $password = '')
    {
        // Longer version
        // $dsn = "mysql:host=$hostname;port=3306;dbname=$dbname;user=$user;password=$password;charset=utf8mb4";

        // Refactored version
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        // This statement basically sets a value for the $connection variable for other methods within the same class can use
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]); // $dsn = Data Source Name
    }

    public function query($query, $params = [])
    {
        // Prepared Statement
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        // Stacking objects (Episode 24)
        return $this;
    }

    // Fetch all data from database
    public function get()
    {
        return $this->statement->fetchAll();
    }

    // Find and Fetch single data from database
    public function find()
    {
        return $this->statement->fetch();
    }

    // Find single data from database, return abort message if not found
    // public function findOrFail()
    // {
    //     $result = $this->find();

    //     // If there is no matching result with the given id, abort the request
    //     if (!$result) {
    //         // Leave empty parameter since the default is 404
    //         abort();
    //     }

    //     return $result;
    // }
}
