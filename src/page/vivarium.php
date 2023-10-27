<?php

use class\Serpents;

$bdd = new Serpents();

if (!isset($_SESSION['order'])) {
    $_SESSION['order'] =
        [
            "nomSerpent" => "ASC",
            "nomRace" => "ASC",
            "isMale" => "ASC",
            "isDead" => "ASC",
            "dateNaissance" => "ASC",
            "dureeDeVie" => "ASC",
            "poids" => "ASC"
        ];
}
if (!isset($_SESSION['currentOrder'])) {
    $_SESSION['currentOrder'] = "nomSerpent";
}

$serpents = $bdd->orderBy($_SESSION['currentOrder'], $_SESSION['order'][$_SESSION['currentOrder']]);

?>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">
        <a href="index.php?page=create">
            <button class="relative py-2 px-8 text-black text-base font-bold uppercase rounded-[50px] overflow-hidden bg-white transition-all duration-400 ease-in-out shadow-md hover:scale-105 hover:text-white hover:shadow-lg active:scale-90 before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-gradient-to-r before:from-emerald-600 before:to-emerald-400 before:transition-all before:duration-500 before:ease-in-out before:z-[-1] before:rounded-[50px] hover:before:left-0">
                Créer un serpent !
            </button>

        </a>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="p-4">

            </th>
            <th scope="col" class="px-6 py-3">

            </th>
            <th scope="col" class="px-6 py-3">

            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=nomSerpent" hx-target="#target" scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Nom
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=nomRace" hx-target="#target" scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                race
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=isMale" hx-target="#target" scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Genre
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=poids" hx-target="#target" scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                poids
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=dateNaissance" hx-target="#target" scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Date de naissance
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=dureeDeVie" hx-target="#target" scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Date de mort
            </th>
            <th scope="col" class="px-6 py-3">
                Détails
            </th>
        </tr>
        </thead>
        <tbody id="target">

 <?php require_once ('listSerpents.php') ?>

        </tbody>
    </table>

</div>
