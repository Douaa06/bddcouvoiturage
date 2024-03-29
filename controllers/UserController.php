<?php

namespace Controllers;

use Utils\Database;

class UserController
{
    public static function authenticate($email, $password): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT password FROM utilisateur WHERE email = '$email'";
        $user = $db->query($sql)->fetch_assoc();
        return password_verify($password, $user['password']);
    }

    public static function createUser($nom, $prenom, $email, $password, $telephone): bool
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $db = Database::getInstance();
        $sql = "INSERT INTO utilisateur (nom, prenom, email, password, telephone) VALUES ('$nom', '$prenom', '$email', '$password', $telephone)";
        return $db->query($sql);
    }

    public static function emailExist($email): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }

    public static function phoneExist($phone): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE telephone = $phone";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }

    public static function userExist($userID): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE id = $userID";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }

    public static function getUserByEmail($email): array|bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
        return $db->query($sql)->fetch_assoc();
    }

    public static function updateUser($id, array $data): bool
    {
        $db = Database::getInstance();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE utilisateur SET ";
        foreach ($data as $key => $value) {
            $sql .= "$key = '$value', ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id = $id";
        return $db->query($sql);
    }

    public static function checkEmailForUpdate($email, $user): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE email = '$email' AND id != $user";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }

    public static function checkPhoneForUpdate($phone, $user): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE telephone = $phone AND id != $user";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }


    public static function getUserById($id): array|bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE id = '$id'";
        return $db->query($sql)->fetch_assoc();
    }
}
