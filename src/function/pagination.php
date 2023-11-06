<?php

function nombreSerpentsFiltre ($serpentsFiltres) : int
{
    $compteur = 0;
    foreach ($serpentsFiltres as $serpent) {
        if (in_array($serpent['nomRace'], $_SESSION['filtres']['races']) && in_array($serpent['isMale'], $_SESSION['filtres']['isMale'])) {
            $compteur++;
        }
    }
    return $compteur;
}
