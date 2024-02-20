<?php

/**
 * User model
 *
  A person or entity that can log in to the site
 */
class User
{

    /**
     * Authenticate a user by username and password
     */
    public static function authenticate($username, $password)
    {
        return $username == 'gustavo' && $password == 'secret';
    }
}
