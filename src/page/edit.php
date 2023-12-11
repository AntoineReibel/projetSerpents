<?php

use class\Races;
use class\Serpents;

$bdd = new Races();
$races = $bdd->selectAll();
$serpent = new Serpents($_GET['id']);
$serpent->kill();
if ($serpent->get('isDead') == 1){
    $_SESSION['tooOld'] = true;
    header('Location: index.php?page=vivarium');
    exit();
}
if (!isset($_SESSION['modifier'])) {
    $_SESSION['modifier'] = ['bool'=>false,'id'=>0 ];
}

if (isset($_POST['edit'])) {
    $serpent->set('nomSerpent', $_POST['nomSerpent']);
    $serpent->set('isMale', $_POST['genre']);
    $serpent->set('poids', $_POST['poids']);
    $serpent->set('idRace', $_POST['race']);
    if (isset($_POST['checkbox']) && $_POST['checkbox']) {
        $serpent->set('dureeDeVie', ajout15Minutes($serpent->get('dureeDeVie')));
    }
    if (isset($_SESSION['modifier'])) {

        $_SESSION['modifier']['bool'] = true;
        $_SESSION['modifier']['nom'] = $serpent->get('nomSerpent');
    }
    header('Location: index.php?page=vivarium');
}

?>
<h1 class="text-center text-emerald-600 font-bold text-xl mb-4">Le labo</h1>


<div class="max-w-md bg-emerald-500 rounded-lg shadow-md p-6 m-auto">
    <h2 class="text-2xl font-bold text-gray-200 mb-4">Modifier votre serpent</h2>

    <form method="post" action="" class="flex flex-col">
        <input required value="<?= $serpent->get('nomSerpent') ?>"
               class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
               type="text" name="nomSerpent">
        <input required value="<?= $serpent->get('poids') ?>"
               class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
               type="number" name="poids">
        <select required
                class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition ease-in-out duration-150"
                name="genre">
            <option value="1" <?php echo $serpent->get('isMale') == 1 ? 'selected' : null ?>>Male</option>
            <option value="0" <?php echo $serpent->get('isMale') == 0 ? 'selected' : null ?>>Femelle</option>
        </select>
        <select required
                class="bg-emerald-200 text-gray-700 border-0 rounded-md p-2 mb-4 focus:bg-emerald-100 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition ease-in-out duration-150"
                name="race">
            <?php foreach ($races as $race) { ?>
                <option value="<?= $race['id_races'] ?>" <?php echo $race['id_races'] == $serpent->get('idRace') ? 'selected' : null ?>><?= $race['nomRace'] ?></option>
            <?php } ?>
        </select>

        <div class="flex items-center mb-4">
            <input id="checkbox" type="checkbox" value="1" name="checkbox"
                   class="w-4 h-4 text-blue-600 bg-emerald-200 border-emerald-300 rounded focus:ring-blue-500  focus:ring-2">
            <label for="checkbox" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Rajouter 15
                minute de vie</label>
        </div>

        <button class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150"
                type="submit" name="edit">Submit
        </button>
    </form>
</div>


