<?php

namespace Controllers;

use Utils\Database;

class TrajetController
{
    public static function createTrajet($chauffeur, $commune_depart, $commune_arrive, $date_depart, $heure_depart, $hebdomadaire, $nbr_place): bool
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO `trajet` (`id`, `Chauffeur`, `Lieu_depart`, `Lieu_arrive`, `Date_depart`, `Heure_depart`, `nbr_place`, `hebdomadaire`) VALUES (NULL, '$chauffeur', '$commune_depart', '$commune_arrive', '$date_depart', '$heure_depart', '$nbr_place', '$hebdomadaire');";
        return $db->query($sql);
    }

    public static function getTrajetsByUser($user_id): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM trajet WHERE chauffeur = $user_id";
        return $db->query($sql)->fetch_all();
    }

    public static function trajetExist(mixed $trajet_id): bool
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM trajet WHERE id = $trajet_id";
        $trajet = $db->query($sql);
        return $trajet->num_rows > 0;
    }

    public static function deleteTrajet(mixed $trajet_id, $user_id): bool
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM trajet WHERE id = $trajet_id AND chauffeur = $user_id";
        return $db->query($sql);
    }
}
