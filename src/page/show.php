<?php

use class\Races;
use class\Serpents;

$serpent = new Serpents($_GET['id']);
$race = new Races($serpent->get('idRace'));

?>

<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div>
        <img class="rounded-t-lg" src="<?= getBigImage($serpent->get('idRace')) ?>" alt="serpent"/>
    </div>
    <div class="flex flex-col items-center p-5 gap-3">
        <div class="font-bold text-2xl"><?= $serpent->get('nomSerpent') ?></div>
        <div class="flex gap-2">
            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <?= $race->get('nomRace') ?>
            </div>
            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <?php echo $serpent->get('isMale') ? 'Male' : 'Femelle'; ?>
            </div>
            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <?= $serpent->get('poids') ?>Kg
            </div>
        </div>
        <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Né(e) le <?= (new DateTime($serpent->get('dateNaissance')))->format('d/m/y \à H\hi'); ?>
        </div>
        <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Va mourir le <?= (new DateTime($serpent->get('dureeDeVie')))->format('d/m/y \à H\hi'); ?>
        </div>
    </div>
</div>
