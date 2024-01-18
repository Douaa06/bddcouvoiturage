<?php

namespace Controllers;

use Utils\Database;

class CommuneController
{
    public static function communeExist($commune)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM commune WHERE id = $commune";
        $user = $db->query($sql);
        return $user->num_rows > 0;
    }
}
