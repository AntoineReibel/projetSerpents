<?php

function dateActuelle() : string
{
    $dateActuelleNonFormate = new DateTime('now', new DateTimeZone('Europe/Paris'));
    return $dateActuelleNonFormate->format('Y-m-d H:i:s');
}

function dateMort() : string
{
    $dateActuelle = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $minutesEnPlus = new DateInterval('PT' . mt_rand(3, 7) . 'M');
    $dateMort = $dateActuelle->add($minutesEnPlus);
    return $dateMort->format('Y-m-d H:i:s');
}

function ajout15Minutes($date) : string
{
    $dateObjet = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    $minutesEnPlus = new DateInterval('PT' . 15 . 'M');
    $dateObjet->add($minutesEnPlus);
    return $dateObjet->format('Y-m-d H:i:s');
}
