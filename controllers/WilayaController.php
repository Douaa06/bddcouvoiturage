<?php

namespace Controllers;

use Utils\Database;

class WilayaController
{
    public static function wilayaExist($wilaya)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM wilaya WHERE id = $wilaya";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }
}
