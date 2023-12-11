<?php

use class\Serpents;

$newBornBool = null;

$bdd = new Serpents();
$dead = $bdd->kill();

if (isset($_POST['out'])) {
    $bdd->set('inLoveRoom', 0, $_POST['out']);
}

$serpents = $bdd->loveRoom();

$newBorn = null;
if (isset($_POST['love']) && count($serpents) == 2) {
    if ($serpents[0]['idRace'] == $serpents[1]['idRace'] && $serpents[0]['isMale'] != $serpents[1]['isMale']) {
        $newBorn = $bdd->giveBirth($serpents[0]['idRace']);
        $bdd->set('idPere', $serpents[0]['isMale'] == 1 ? $serpents[0]['id_serpents'] : $serpents[1]['id_serpents'], $newBorn);
        $bdd->set('idMere', $serpents[0]['isMale'] == 0 ? $serpents[0]['id_serpents'] : $serpents[1]['id_serpents'], $newBorn);
        $newBornBool = 'baby';
    } else {
        $newBornBool = 'noBaby';
    }
}
?>
<?php if (count($serpents) != 2 && isset($_POST['love'])) { ?>
    <div id="alert-1"
         class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            La mort a empêcher les serpents de s'amuser :(
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
<?php } ?>
<?php if ($dead && !isset($_POST['love'])) { ?>
    <div id="alert-2"
         class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            Certains serpents sont morts :(
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-2" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
<?php } ?>
<?php if ($newBornBool == 'baby') { ?>
    <div id="alert-3"
         class="flex items-center p-4 my-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
         role="alert">
        <div class="ml-3 text-sm font-medium">
            Les serpents se sont bien amusés et il y a un nouveau venu ! <?= $bdd->get('nomSerpent', $newBorn) ?> à
            rejoins le vivarium !
        </div>
        <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
<?php } else if ($newBornBool == 'noBaby') { ?>
    <div id="alert-4"
         class="flex items-center p-4 my-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
         role="alert">
        <div class="ml-3 text-sm font-medium">
            Les serpents se sont bien amusés, mais pas de bébé en vue !
        </div>
        <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-4" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
<?php } ?>
<?php
if ($serpents == null) {
    echo "<p class='my-4'>Aucun serpent n'est présent dans la love room</p>";
} else if (count($serpents) == 2) {
    ?>
    <div class="flex justify-around items-center py-3">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div>
                <img class="rounded-t-lg" src="<?= getBigImage($serpents[0]['idRace']) ?>" alt="serpent"/>
            </div>
            <div class="flex flex-col items-center p-5 gap-3">
                <div class="font-bold text-2xl"><?= $serpents[0]['nomSerpent'] ?></div>
                <div class="flex gap-2">
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= $serpents[0]['nomRace'] ?>
                    </div>
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?php echo $serpents[0]['isMale'] ? 'Male' : 'Femelle'; ?>
                    </div>
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= $serpents[0]['poids'] ?>Kg
                    </div>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Né(e) le <?= (new DateTime($serpents[0]['dateNaissance']))->format('d/m/y \à H\hi'); ?>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Va mourir le <?= (new DateTime($serpents[0]['dureeDeVie']))->format('d/m/y \à H\hi'); ?>
                </div>
                <form method="post" action="">
                    <button name="out"
                            value="<?= $serpents[0]['id_serpents'] ?>"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Sortir
                    </button>
                </form>

            </div>
        </div>
        <form method="post" action="">
            <button name="love"
                    class="h-10 bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            >
                <i class="fas fa-heart"></i> Accoupler
            </button>
        </form>
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div>
                <img class="rounded-t-lg" src="<?= getBigImage($serpents[1]['idRace']) ?>" alt="serpent"/>
            </div>
            <div class="flex flex-col items-center p-5 gap-3">
                <div class="font-bold text-2xl"><?= $serpents[1]['nomSerpent'] ?></div>
                <div class="flex gap-2">
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= $serpents[1]['nomRace'] ?>
                    </div>
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?php echo $serpents[1]['isMale'] ? 'Male' : 'Femelle'; ?>
                    </div>
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= $serpents[1]['poids'] ?>Kg
                    </div>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Né(e) le <?= (new DateTime($serpents[1]['dateNaissance']))->format('d/m/y \à H\hi'); ?>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Va mourir le <?= (new DateTime($serpents[1]['dureeDeVie']))->format('d/m/y \à H\hi'); ?>
                </div>
                <form method="post" action="">
                    <button name="out"
                            value="<?= $serpents[1]['id_serpents'] ?>"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Sortir
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="flex justify-around items-center py-3">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div>
                <img class="rounded-t-lg" src="<?= getBigImage($serpents[0]['idRace']) ?>" alt="serpent"/>
            </div>
            <div class="flex flex-col items-center p-5 gap-3">
                <div class="font-bold text-2xl"><?= $serpents[0]['nomSerpent'] ?></div>
                <div class="flex gap-2">
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= $serpents[0]['nomRace'] ?>
                    </div>
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?php echo $serpents[0]['isMale'] ? 'Male' : 'Femelle'; ?>
                    </div>
                    <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= $serpents[0]['poids'] ?>Kg
                    </div>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Né(e) le <?= (new DateTime($serpents[0]['dateNaissance']))->format('d/m/y \à H\hi'); ?>
                </div>
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Va mourir le <?= (new DateTime($serpents[0]['dureeDeVie']))->format('d/m/y \à H\hi'); ?>
                </div>
                <form method="post" action="">
                    <button name="out"
                            value="<?= $serpents[0]['id_serpents'] ?>"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Sortir
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php
} ?>

