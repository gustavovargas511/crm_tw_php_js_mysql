<?php

/**
 * User model
 *
  A person or entity that can log in to the site
 */
class User
{

    /**
     * Property
     * 
     * @var integer ID of the user
     */
    public $id;
    /**
     * Property
     * 
     * @var string USERNAME of the user
     */
    public $username;
    /**
     * Property
     * 
     * @var string PASSWORD of the user
     */
    public $password;


    /**
     * Authenticate a user by username and password
     * 
     * @param object $connection Connection
     * @param string $username Username
     * @param string $password Password
     * 
     * return boolean True if credentials are correct, null otherwise
     * 
     */
    public static function authenticate($connection, $username, $password)
    {
        $sql = 'SELECT * ' .
            'FROM user ' .
            'WHERE username=:username';

        $prepared_sql = $connection->prepare($sql);

        $prepared_sql->bindValue(':username', $username, PDO::PARAM_STR);

        $prepared_sql->setFetchMode(PDO::FETCH_CLASS, 'User');

        $prepared_sql->execute();

        if ($user = $prepared_sql->fetch()) {
            return password_verify($password, $user->password);
        }
    }
}
