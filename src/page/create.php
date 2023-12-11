<?php

use class\Races;
use class\Serpents;

$bdd = new Races();
$races = $bdd->selectAll();

$serpentTable = new Serpents();



if (isset($_POST['create'])) {
    $data = [$_POST['nomSerpent'], $_POST['poids'], dateMort(), dateActuelle(), $_POST['genre'],$_POST['race']];
    $serpentTable->insert($data);
}


?>

<?php if (isset($_POST['create'])) { ?>
    <div id="alert-3"
         class="flex items-center p-4 my-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
         role="alert">
        <div class="ml-3 text-sm font-medium">
            <?= htmlspecialchars($_POST['nomSerpent']) ?> à bien rejoint le vivarium !
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
<?php } ?>

<h1 class="text-center text-emerald-600 font-bold text-xl mb-4" >Le labo</h1>

    <div class="max-w-md bg-emerald-500 rounded-lg shadow-md p-6 m-auto">
        <h2 class="text-2xl font-bold text-gray-200 mb-4">Créez votre serpent</h2>

        <form method="post" action="" class="flex flex-col">
            <input required placeholder="Nom"
                   class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                   type="text" name="nomSerpent">
            <input required placeholder="poids (en kg)"
                   class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                   type="number" name="poids">
            <select required class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition ease-in-out duration-150"
                    name="genre">
                <option value="1">Male</option>
                <option value="0">Femelle</option>
            </select>
            <select required class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition ease-in-out duration-150"
                    name="race">
                <?php foreach ($races as $race) { ?>
                    <option value="<?= $race['id_races'] ?>"><?= $race['nomRace'] ?></option>
                <?php } ?>
            </select>
            <button class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150"
                    type="submit" name="create">Créer
            </button>
        </form>
    </div>

