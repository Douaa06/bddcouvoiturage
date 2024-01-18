<?php

namespace Controllers;

use Utils\Database;

class TrajetController
{
    public static function createTrajet($chauffeur, $commune_depart, $commune_arrive, $date_depart, $heure_depart, $hebdomadaire, $nbr_place)
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO `trajet` (`id`, `Chauffeur`, `Lieu_depart`, `Lieu_arrive`, `Date_depart`, `Heure_depart`, `nbr_place`, `hebdomadaire`) VALUES (NULL, '$chauffeur', '$commune_depart', '$commune_arrive', '$date_depart', '$heure_depart', '$nbr_place', '$hebdomadaire');";
        return $db->query($sql);
    }
}
