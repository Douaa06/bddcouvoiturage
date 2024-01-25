<?php

namespace Controllers;

use Utils\Database;

class UserController
{
    public static function authenticate($email, $password)
    {
        $db = Database::getInstance();
        $sql = "SELECT password FROM utilisateur WHERE email = '$email'";
        $user = $db->query($sql)->fetch_assoc();
        return password_verify($password, $user['password']);
    }

    public static function createUser($nom, $prenom, $email, $password, $telephone)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
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

    public static function userExist($userID)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE id = $userID";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }
}
