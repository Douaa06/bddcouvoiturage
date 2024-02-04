<?php

namespace Controllers;

use Utils\Database;

class ReservationController
{
    public static function createReservation($passagere, $trajet): bool
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO reservation VALUES ('$passagere', $trajet, FALSE);";
        return $db->query($sql);
    }

    public static function getPendingReservationsByUser($passagere): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Passagere = $passagere AND Approuver = FALSE";
        return $db->query($sql)->fetch_all();
    }
    public static function getPendingReservationsByChauffeur($chauffeur): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Trajet in (SELECT id FROM trajet WHERE Chauffeur = $chauffeur) AND Approuver = FALSE";
        return $db->query($sql)->fetch_all();
    }

    public static function getReservationsByUser($passagere): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Passagere = $passagere AND Approuver = TRUE";
        return $db->query($sql)->fetch_all();
    }
    public static function getReservationsByChauffeur($chauffeur): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Trajet in (SELECT id FROM trajet WHERE Chauffeur = $chauffeur) AND Approuver = TRUE";
        return $db->query($sql)->fetch_all();
    }

    public static function reservationExist(mixed $trajet_id,$passagere): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Trajet = $trajet_id AND Passagere = $passagere AND Approuver = TRUE";
        $trajet = $db->query($sql);
        return $trajet->num_rows > 0;
    }
    public static function pendingReservationExist(mixed $trajet_id,$passagere): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE Trajet = $trajet_id AND Passagere = $passagere AND Approuver = FALSE";
        $trajet = $db->query($sql);
        return $trajet->num_rows > 0;
    }
    public static function approuveReservation($trajet_id,$passagere): bool
    {
        $db = Database::getInstance();
        $sql = "UPDATE reservation SET Approuver=TRUE WHERE Trajet =$trajet_id and Passagere=$passagere ";
        return $db->query($sql);
    }

    public static function deleteReservation(string $trajet_id, string $passagere ): bool
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM reservation WHERE Trajet = $trajet_id AND Passagere = $passagere ";
        return $db->query($sql);
    }
    
}