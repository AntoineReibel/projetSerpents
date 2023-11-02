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

<h1>Le Labo</h1>

<?php if (isset($_POST['create'])) { ?>
    <div class="text-emerald-700"><?= $_POST['nomSerpent'] ?> à bien rejoint le vivarium !</div>
<?php } ?>

<div class="flex flex-col items-center justify-center h-screen dark">
    <div class="w-full max-w-md bg-emerald-500 rounded-lg shadow-md p-6">
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
                    type="submit" name="create">Submit
            </button>
        </form>
    </div>
</div>
