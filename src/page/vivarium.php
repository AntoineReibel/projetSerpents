<?php

use class\Races;
use class\Serpents;

$bdd = new Races();
$races = $bdd->selectAll();
$bdd = new Serpents();
$loveRoomFull = false;

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

if (!isset($_SESSION['paginate'])) {
    $_SESSION['paginate'] = 10;
}

if (!isset($_GET['list'])) {
    $_GET['list'] = 1;
}

if (isset($_POST['create'])) {
    $bdd->create15();
}

if (isset($_POST['itemByPageSelect'])) {
    $_SESSION['paginate'] = $_POST['itemByPageSelect'];
}

if (isset($_POST['loveRoom'])) {
    $serpentsInLoveRoom = $bdd->count('inLoveRoom', 1);
    if ($serpentsInLoveRoom[0]['totalSerpents'] < 2) {
        $bdd->set('inLoveRoom', 1, $_POST['loveRoom']);
    } else {
        $loveRoomFull = true;
    }
}

if (!isset($_SESSION['filtres'])) {
    foreach ($races as $race) {
        $_SESSION['filtres'][] = $race['nomRace'];
    }
    $_SESSION['filtres'][] = '0';
    $_SESSION['filtres'][] = '1';
}

var_dump($_SESSION['filtres']);

if (isset($_POST['filtrer'])){
    $_SESSION['filtres'] = $_POST['filtres'];
}

$serpents = $bdd->paginate($_SESSION['currentOrder'], $_SESSION['order'][$_SESSION['currentOrder']], (isset($_GET['list']) ? (($_GET['list'] - 1) * $_SESSION['paginate']) : 0), $_SESSION['paginate']);

if ($serpents == null) {
    header("location: index.php?page=vivarium");
}

?>

<?php if ($loveRoomFull) { ?>
    <p class="text-red-700">Deux serpents passent déjà du bon temps dans la love room !</p>
<?php } ?>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-start gap-3 py-4 bg-white dark:bg-gray-800">
        <a href="index.php?page=create">
            <button class="relative py-2 px-8 text-black text-base font-bold uppercase rounded-[50px] overflow-hidden bg-white transition-all duration-400 ease-in-out shadow-md hover:scale-105 hover:text-white hover:shadow-lg active:scale-90 before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-gradient-to-r before:from-emerald-600 before:to-emerald-400 before:transition-all before:duration-500 before:ease-in-out before:z-[-1] before:rounded-[50px] hover:before:left-0">
                serpent sur mesure
            </button>

        </a>
        <form method="post" action="">
            <button name="create"
                    class="relative py-2 px-8 text-black text-base font-bold uppercase rounded-[50px] overflow-hidden bg-white transition-all duration-400 ease-in-out shadow-md hover:scale-105 hover:text-white hover:shadow-lg active:scale-90 before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-gradient-to-r before:from-emerald-600 before:to-emerald-400 before:transition-all before:duration-500 before:ease-in-out before:z-[-1] before:rounded-[50px] hover:before:left-0">
                Créer 15 serpents !
            </button>
        </form>
        <form method="post" action="">

            <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300"
                    type="button">Filtres
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownSearchButton">
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-11" type="checkbox" value="Anaconda" name="filtres[]" <?php echo in_array('Anaconda', $_SESSION['filtres']) ? 'checked' : ''  ?>
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-11"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Anaconda</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-12" type="checkbox" value="Boa" name="filtres[]" <?php echo in_array('Boa', $_SESSION['filtres']) ? 'checked' : ''  ?>
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-12"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Boa</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-13" type="checkbox" value="Cobra" name="filtres[]" <?php echo in_array('Cobra', $_SESSION['filtres']) ? 'checked' : ''  ?>
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-13"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Cobra</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-14" type="checkbox" value="Python" name="filtres[]" <?php echo in_array('Python', $_SESSION['filtres']) ? 'checked' : ''  ?>
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-14"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Python</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-15" type="checkbox" value="Vipère" name="filtres[]" <?php echo in_array('Vipère', $_SESSION['filtres']) ? 'checked' : ''  ?>
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-15"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Vipère</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-16" type="checkbox" value="1" name="filtres[]" <?php echo in_array(1, $_SESSION['filtres']) ? 'checked' : ''  ?>
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-16"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Male</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-17" type="checkbox" value="0" name="filtres[]" <?php echo in_array(0, $_SESSION['filtres']) ? 'checked' : ''  ?>
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-17"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Femelle</label>
                        </div>
                    </li>
                </ul>
                <button name="filtrer"
                   class="flex items-center p-3 text-sm font-medium text-emerald-600 border-t border-gray-200 rounded-b-lg dark:border-gray-600 hover:text-emerald-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
                   Appliquer les filtres
                </button>
            </div>

        </form>
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
            <th hx-get="page/ajax/orderBy.php?orderBy=nomSerpent&list=<?= $_GET['list'] ?? 1 ?>" hx-target="#target"
                scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Nom
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=nomRace&list=<?= $_GET['list'] ?? 1 ?>" hx-target="#target"
                scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                race
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=isMale&list=<?= $_GET['list'] ?? 1 ?>" hx-target="#target"
                scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Genre
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=poids&list=<?= $_GET['list'] ?? 1 ?>" hx-target="#target"
                scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                poids
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=dateNaissance&list=<?= $_GET['list'] ?? 1 ?>" hx-target="#target"
                scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Date de naissance
            </th>
            <th hx-get="page/ajax/orderBy.php?orderBy=dureeDeVie&list=<?= $_GET['list'] ?? 1 ?>" hx-target="#target"
                scope="col"
                class="hover:text-blue-600 cursor-pointer px-6 py-3">
                Date de mort
            </th>
            <th scope="col" class="px-6 py-3">
                Détails
            </th>
        </tr>
        </thead>
        <tbody id="target">

        <?php require_once('listSerpents.php') ?>

        </tbody>
    </table>

</div>
<br>

<?php include_once('paginate.php') ?>

<br>
<div class="flex items-center flex-col">
    <form id="itemByPage" action="" method="post">
        <label for="itemByPageSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serpents par
            page</label>
        <select name="itemByPageSelect" id="itemByPageSelect"
                class="block w-20 p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="10" <?php if ($_SESSION['paginate'] == 10) echo "selected" ?>>10</option>
            <option value="20" <?php if ($_SESSION['paginate'] == 20) echo "selected" ?>>20</option>
            <option value="30" <?php if ($_SESSION['paginate'] == 30) echo "selected" ?>>30</option>
            <option value="50" <?php if ($_SESSION['paginate'] == 50) echo "selected" ?>>50</option>
        </select>
    </form>
</div>
<script>
    document.getElementById('itemByPageSelect').addEventListener('change', function () {
        document.getElementById('itemByPage').submit();
    });
</script>
