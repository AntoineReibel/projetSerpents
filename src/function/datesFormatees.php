<?php

function dateActuelle()
{
    $dateActuelleNonFormate = new DateTime('now', new DateTimeZone('Europe/Paris'));
    return $dateActuelleNonFormate->format('Y-m-d H:i:s');
}

function dateMort()
{
    $dateActuelle = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $minutesEnPlus = new DateInterval('PT' . mt_rand(3, 7) . 'M');
    $dateMort = $dateActuelle->add($minutesEnPlus);
    return $dateMort->format('Y-m-d H:i:s');
}
