<?php

/**
 * Url
 * 
 * Response methods
 * 
 */
class Url
{

    public CONST ROOT_DIR = "/crm_tw_php_js_mysql";
    /**
     * Url::redirect to another URL on the same site
     * 
     * @param string $path Path to Url::redirect to
     * 
     * @return void
     */
    public static function redirect($path)
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }
        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
        exit;
    }
}
