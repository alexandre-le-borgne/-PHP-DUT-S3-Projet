<?php

/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 04/01/2016
 * Time: 13:58
 */

class UserEntity extends Entity
{
    private $id;
    private $authentification;
    private $username;
    private $email;
    private $birthDate;
    private $userKey;
    private $active;
    private $accountLevel;


    // GETTERS

    public function getPassword()
    {
        if ($this->authentification == UserModel::AUTHENTIFICATION_BY_PASSWORD)
        {
            $password = new PasswordEntity($this->id);
            return $password->getPassword();
        }
        return false;
    }

    public function getAuthentification()
    {
        return $this->authentification;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getUserKey()
    {
        return $this->userKey;
    }
    public function getActive()
    {
        return $this->active;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    public function getAccountLevel()
    {
        return $this->accountLevel;
    }
    public function getEmail()
    {
        return $this->email;
    }

    // SETTERS
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setUserKey($userKey)
    {
        $this->userKey = $userKey;
    }
    public function setActive($active)
    {
        $this->active = $active;
    }
    public function setAccountLevel($accountLevel)
    {
        $this->accountLevel = $accountLevel;
    }


}