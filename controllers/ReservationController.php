<?php

namespace Controllers;

use Utils\Database;

class ReservationController
{
    public static function createReservation($trajet_id,$passagere): bool
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO `reservation` ( `Passagere`,`Trajet`, `Approuver`) VALUES ('$passagere', $trajet_id, 0);";
        return $db->query($sql);
    }

    public static function getReservationsByUser($passagere): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Passagere = $passagere";
        return $db->query($sql)->fetch_all();
    }

    public static function ReservationExist(mixed $trajet_id,$passagere): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Trajet = $trajet_id AND Passagere = $passagere";
        $trajet = $db->query($sql);
        return $trajet->num_rows > 0;
    }
    public static function ApprouverReservation($trajet_id,$passagere): bool
    {
        $db = Database::getInstance();
        $sql = "UPDATE reservation SET Approuver=1 WHERE Trajet =$trajet_id and Passagere=$passagere ";
        return $db->query($sql);
    }

    public static function deleteReservation(mixed $trajet_id, $passagere ): bool
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM reservation WHERE Trajet = $trajet_id AND Passagere = $passagere ";
        return $db->query($sql);
    }
    
}