<?php

namespace Controllers;

use Utils\Database;

class UserController
{
    public static function authenticate($email, $password)
    {
        $db = Database::getInstance();
        $password =  password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM utilisateur WHERE email = '$email' AND password = '$password'";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }

    public static function createUser($nom, $prenom, $email, $password, $telephone)
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO utilisateur (nom, prenom, email, password, telephone) VALUES ('$nom', '$prenom', '$email', '$password', $telephone)";
        return $db->query($sql);
    }

    public static function emailExist($email)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }

    public static function phoneExist($phone)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE telephone = $phone";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }
}
