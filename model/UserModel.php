<?php

namespace app\model;

use app\core\Application;
use app\core\Database;

class UserModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }


    public function register($data): bool
    {
        //prepare statement
        $this->db->query("INSERT INTO users (`name`,`surname`, `email`,`phoneNumber`,`address,` `password`) VALUES (:name, :surname, :email, :phoneNumber, :address, :password)");

        //add values//priskirti reiksmes
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':address', $data['address']);
        // hashed password
        $this->db->bind(':password', $data['password']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email): bool
    {
        //check if given email is in database
        // prepare statement/ paruosiam statementa
        $this->db->query("SELECT * FROM users WHERE `email` = :email");

        //add values to statement / priskiriam reiksme
        $this->db->bind(':email', $email);

        // save result in row
        $row = $this->db->singleRow();

        //check if we got some results
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }


}