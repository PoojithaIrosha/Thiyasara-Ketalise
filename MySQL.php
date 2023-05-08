<?php

class MySQL
{
    public static mysqli $connection;
    private static string $host = "127.0.0.1";
    private static string $username = "root";
    private static string $password = "KMM2002@alwis";
    private static string $database = "thiyasara";
    private static string $port = "3306";

    private static function setUpConnection(): void
    {
        if (!isset(self::$connection)) {
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$database, self::$port);
        }
    }

    public static function iud($query, $params, $types): void
    {
        self::setUpConnection();
        $statement = self::$connection->prepare($query);
        $statement->bind_param($types, ...$params);
        $statement->execute();
    }

    public static function search_prepared($query, $params, $types): mysqli_result
    {
        self::setUpConnection();
        $statement = self::$connection->prepare($query);
        if (isset($params)) {
            $statement->bind_param($types, ...$params);
        }
        $statement->execute();
        return $statement->get_result();
    }

    public static function search($query): mysqli_result
    {
        self::setUpConnection();
        return self::$connection->query($query);
    }


}