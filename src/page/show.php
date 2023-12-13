<?php

use class\Races;
use class\Serpents;

$serpent = new Serpents($_GET['id']);
$dead = $serpent->kill();
if ($dead){
    $_SESSION['tooOld'] = true;
}
$race = new Races($serpent->get('idRace'));


$elders = $serpent->getElders();
$descendants = $serpent->getChildrens();
?>
<div class="flex flex-col md:flex-row justify-around items-center gap-4">
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
        <div>
            <img class="rounded-t-lg" src="<?= getBigImage($serpent->get('idRace')) ?>" alt="serpent"/>
        </div>
        <div class="flex flex-col items-center p-5 gap-3">
            <div class="font-bold text-2xl"><?= htmlspecialchars($serpent->get('nomSerpent')) ?></div>
            <div class="flex gap-2">
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <?= $race->get('nomRace') ?>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <?php echo $serpent->get('isMale') ? 'Male' : 'Femelle'; ?>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <?= htmlspecialchars($serpent->get('poids')) ?>Kg
                </div>
            </div>
            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Né(e) le <?= (new DateTime($serpent->get('dateNaissance')))->format('d/m/y \à H\hi'); ?>
            </div>
            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Va mourir le <?= (new DateTime($serpent->get('dureeDeVie')))->format('d/m/y \à H\hi'); ?>
            </div>
        </div>
        <?php if ($serpent->get('isDead') == 1) { ?>
            <div class="flex justify-center items-center absolute h-8 w-44 bg-red-600 text-white font-bold top-14 right-0 rounded-l-lg shadow">
                DÉCÉDÉ
            </div>
        <?php } ?>
    </div>
    <div>
        <h2 class="text-center text-emerald-600 font-bold text-xl mb-4">Parents: </h2>
        <?php if ($elders == null) { ?>

            <div><?= htmlspecialchars($serpent->get('nomSerpent')) ?> à été créé en laboratoire</div>
        <?php } else { ?>
            <div>Grand-père paternel:
                <?= $elders['grandPerePaternel']['nom'] !== null
                    ? '<a class="text-emerald-600 underline" href="index.php?page=show&id=' . $elders['grandPerePaternel']['id'] . '">' . htmlspecialchars($elders['grandPerePaternel']['nom']) . '</a>'
                    : 'Aucun' ?>
            </div>
            <div>Grand-mère paternelle:
                <?= $elders['grandMerePaternelle']['nom'] !== null
                    ? '<a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id=' . $elders['grandMerePaternelle']['id'] . '">' . htmlspecialchars($elders['grandMerePaternelle']['nom']) . '</a>'
                    : 'Aucune' ?>
            </div>
            <div>Grand-père maternel:
                <?= $elders['grandPereMaternel']['nom'] !== null
                    ? '<a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id=' . $elders['grandPereMaternel']['id'] . '">' . htmlspecialchars($elders['grandPereMaternel']['nom']) . '</a>'
                    : 'Aucun' ?>
            </div>
            <div>Grand-mère maternelle:
                <?= $elders['grandMereMaternelle']['nom'] !== null
                    ? '<a class="text-emerald-600 hover:text-emerald-700 underline" href="index.php?page=show&id=' . $elders['grandMereMaternelle']['id'] . '">' . htmlspecialchars($elders['grandMereMaternelle']['nom']) . '</a>'
                    : 'Aucune' ?>
            </div>
            <div>Père: <a class="text-emerald-600 hover:text-emerald-700 underline"
                          href="index.php?page=show&id= <?= $elders['pere']['id'] ?>"><?= htmlspecialchars($elders['pere']['nom']) ?></a>
            </div>
            <div>Mère: <a class="text-emerald-600 hover:text-emerald-700 underline"
                          href="index.php?page=show&id= <?= $elders['mere']['id'] ?>"><?= htmlspecialchars($elders['mere']['nom']) ?></a>
            </div>
        <?php } ?>

        <h2 class="text-center text-emerald-600 font-bold text-xl my-4">Enfants: </h2>
        <?php if ($descendants == null) { ?>
            <div><?= $serpent->get('nomSerpent') ?> n'a pas de descendance</div>
        <?php } else { ?>
            <?php foreach ($descendants['enfants'] as $enfant) { ?>
                <div><a class="text-emerald-600 hover:text-emerald-700 underline"
                        href="index.php?page=show&id= <?= $enfant['id'] ?>"><?= htmlspecialchars($enfant['nom']) ?></a></div>
            <?php } ?>
            <h2 class="text-center text-emerald-600 font-bold text-xl my-4">Petits-enfants: </h2>
            <?php foreach ($descendants['petitEnfants'] as $petitEnfant) { ?>
                <div><a class="text-emerald-600 hover:text-emerald-700 underline"
                        href="index.php?page=show&id= <?= $petitEnfant['id'] ?>"><?= htmlspecialchars($petitEnfant['nom']) ?></a></div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
