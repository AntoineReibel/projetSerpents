<?php

use class\Races;
use class\Serpents;

$serpent = new Serpents($_GET['id']);
$race = new Races($serpent->get('idRace'));

if ($serpent->get('idmere') != null) {
    $elders = $serpent->getElders();
}
?>
<div class="flex justify-around items-start gap-4">
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
    <div>
        <h2 class="text-center text-emerald-600 font-bold text-xl mb-4">Parents</h2>
        <?php if ($serpent->get('idmere') == null) { ?>

            <div><?= $serpent->get('nomSerpent') ?> à été créé en laboratoire</div>
        <?php } else { ?>
            <div>Grand-père paternel:
                <?= $elders['grandPerePaternel']['nom'] !== null
                    ? '<a class="text-emerald-600 underline" href="index.php?page=show&id=' . $elders['grandPerePaternel']['id'] . '">' . $elders['grandPerePaternel']['nom'] . '</a>'
                    : 'Aucun' ?>
            </div>
            <div>Grand-mère paternelle:
                <?= $elders['grandMerePaternelle']['nom'] !== null
                    ? '<a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id=' . $elders['grandMerePaternelle']['id'] . '">' . $elders['grandMerePaternelle']['nom'] . '</a>'
                    : 'Aucune' ?>
            </div>
            <div>Grand-père maternel:
                <?= $elders['grandPereMaternel']['nom'] !== null
                    ? '<a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id=' . $elders['grandPereMaternel']['id'] . '">' . $elders['grandPereMaternel']['nom'] . '</a>'
                    : 'Aucun' ?>
            </div>
            <div>Grand-mère maternelle:
                <?= $elders['grandMereMaternelle']['nom'] !== null
                    ? '<a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id=' . $elders['grandMereMaternelle']['id'] . '">' . $elders['grandMereMaternelle']['nom'] . '</a>'
                    : 'Aucune' ?>
            </div>
            <div>Père: <a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id= <?= $elders['pere']['id'] ?>"><?= $elders['pere']['nom'] ?></a></div>
            <div>Mère: <a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id= <?= $elders['mere']['id'] ?>"><?= $elders['mere']['nom'] ?></a></div>
        <?php } ?>
    </div>
</div>
