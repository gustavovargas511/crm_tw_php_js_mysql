<?php

/**
 * Database
 * 
 * A Connection to the database
 */
class Database
{

    /**
     * Get the database conection
     * 
     * @return PDO Object Connection to the database server
     */
    public function getConnection()
    {

        $db_host = "your_server_host";
        $db_name = "your_database_name";
        $db_user = "your_database_user";
        $db_pass = 'Your_database_pass';

        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name;

        try {
            
            $db = new PDO($dsn, $db_user, $db_pass);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;

        } catch (PDOException $e) {
            if ($e->getCode() == 1045) {
                echo 'Cant connect...';
                exit;
            }
        }
    }
}
