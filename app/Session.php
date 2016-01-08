<?php

/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 17/12/2015
 * Time: 13:13
 */
class Session
{
    private static $instance;

    private function __construct()
    {
        session_start();
    }

    public function get($name)
    {
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];
        return null;
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function clear()
    {
        session_destroy();
        unset($_SESSION);
    }

    public function isConnected()
    {
        $id = $this->get("id");
        $password = $this->get("password");
        if ($id != null && $password != null) {
            $user = new UserEntity($id);
            if ($user->getAuthentification() == 0)
                return $user->getPassword() === $password;
        }
        return false;
    }

    /**
     * @return Session
     */
    public static function getInstance()
    {
        if (!Session::$instance)
            Session::$instance = new Session();
        return Session::$instance;
    }
}