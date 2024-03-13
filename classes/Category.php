<?php

/**
 * Category
 * 
 * Groupings for articles
 * 
 */
class Category {
    
    /**
     * Get all the categories
     * 
     * @param object $connection to the database
     * 
     * @return array An assosiative array of al th records
     */
    public static function getAll($connection)
    {
        $sql = "SELECT id, " .
               "name " .
               "FROM category " .
               "ORDER BY name;";

        $results = $connection->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

}