<?php

use class\Serpents;

$bdd = new Serpents();

if (isset($_POST['out'])) {
    $bdd->set('inLoveRoom', 0, $_POST['out']);
}

$serpents = $bdd->loveRoom();

?>


<?php
if ($serpents == null) {
    echo "y'a deguin";
} else if (count($serpents) == 2) {
    ?>
    <div class="flex justify-around items-center bg-pink-200 py-3">
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
        <button class="h-10 bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                type="button"
        >
            <i class="fas fa-heart"></i> Accoupler
        </button>
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
    <div class="flex justify-around items-center bg-pink-200 py-3">
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

