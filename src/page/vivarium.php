<?php

use class\Races;
use class\Serpents;

$bdd = new Races();
$races = $bdd->selectAll();
$bdd = new Serpents();
$dead = $bdd->kill();
$loveRoomFull = false;
$vivariumEmpty = false;
$tooMuchFilter = false;
$deadLover = false;

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
    $_SESSION['paginate'] = intval($_POST['itemByPageSelect']);
}

if (isset($_POST['loveRoom'])) {
    $serpentsInLoveRoom = $bdd->count('inLoveRoom', 1);
    if ($bdd->get('isDead', $_POST['loveRoom']) == 1) {
        $deadLover = true;
    } else if ($serpentsInLoveRoom[0]['totalSerpents'] < 2) {
        $bdd->set('inLoveRoom', 1, $_POST['loveRoom']);
    } else {
        $loveRoomFull = true;
    }
}

if (!isset($_SESSION['filtres'])) {
    foreach ($races as $race) {
        $_SESSION['filtres']['races'][] = $race['nomRace'];
    }
    $_SESSION['filtres']['isMale'][] = '0';
    $_SESSION['filtres']['isMale'][] = '1';
}

if (isset($_POST['filtrer'])) {
    if (isset($_POST['races'])) {
        $_SESSION['filtres']['races'] = $_POST['races'];
    } else {
        $tooMuchFilter = true;
    }
    if (isset($_POST['isMale'])) {
        $_SESSION['filtres']['isMale'] = $_POST['isMale'];
    } else {
        $tooMuchFilter = true;
    }
}

$countMale = $bdd->count('isMale', 1);
$countFemale = $bdd->count('isMale', 0);

$serpents = $bdd->paginate($_SESSION['currentOrder'], $_SESSION['order'][$_SESSION['currentOrder']], (isset($_GET['list']) ? (($_GET['list'] - 1) * $_SESSION['paginate']) : 0), $_SESSION['paginate'], $_SESSION['filtres']['races'], $_SESSION['filtres']['isMale']);

if ($serpents == null && $_GET['list'] == 1) {
    $vivariumEmpty = true;
} else if ($serpents == null && $dead) {
    $_SESSION['tooOld'] = true;
    header('location: index.php?page=vivarium');
    exit();
} else if ($serpents == null) {
    header('location: index.php?page=vivarium');
    exit();
}
?>

<!--Alertes--------------------------------->
<?php if ($dead || isset($_SESSION['tooOld']) && $_SESSION['tooOld']) { ?>
    <div id="alert-1"
         class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            Certains serpents sont mort :(
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
    <?php $_SESSION['tooOld'] = false;
} ?>
<?php if ($loveRoomFull) { ?>
    <div id="alert-2"
         class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            Deux serpents passent déjà du bon temps dans la love room !
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
<?php if (!$loveRoomFull && isset($_POST['loveRoom']) && !$deadLover) { ?>
    <div id="alert-3"
         class="flex items-center p-4 mb-4 text-pink-500 rounded-lg bg-pink-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            <?php $sendSerpent = new Serpents($_POST['loveRoom']);
            echo htmlspecialchars($sendSerpent->get('nomSerpent')); ?> à été envoyé dans la love room !
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-pink-50 text-pink-500 rounded-lg focus:ring-2 focus:ring-pink-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
<?php } ?>
<?php if (isset($_SESSION['kill']) && $_SESSION['kill']['bool']) { ?>
    <div id="alert-4"
         class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            <?= htmlspecialchars($_SESSION['kill']['nom']) ?> n'est plus parmi nous :(
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-4" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    <?php $_SESSION['kill']['bool'] = false;
} ?>
<?php if ($tooMuchFilter) { ?>
    <div id="alert-5"
         class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            Oups ! Vous ne pouvez pas filtrer l'intégralité des serpents !
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-5" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
<?php } ?>
<?php if (isset($_SESSION['modifier']) && $_SESSION['modifier']['bool']) { ?>
    <div id="alert-6"
         class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            <?= htmlspecialchars($_SESSION['modifier']['nom']) ?> à bien été modifié.
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-6" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    <?php $_SESSION['modifier']['bool'] = false;
} ?>
<?php if (isset($_POST['create'])) { ?>
    <div id="alert-7"
         class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
         role="alert">
        <div class="ms-3 text-sm font-medium">
            15 serpents ont été créés !
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-7" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
<?php } ?>

<!--fin alertes----------------------------->

<h1 class="text-center text-emerald-600 font-bold text-xl mb-4">Le vivarium</h1>

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
                        <input id="checkbox-item-11" type="checkbox" value="Anaconda"
                               name="races[]" <?php echo in_array('Anaconda', $_SESSION['filtres']['races']) ? 'checked' : '' ?>
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-11"
                               class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Anaconda</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-12" type="checkbox" value="Boa"
                               name="races[]" <?php echo in_array('Boa', $_SESSION['filtres']['races']) ? 'checked' : '' ?>
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-12"
                               class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Boa</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-13" type="checkbox" value="Cobra"
                               name="races[]" <?php echo in_array('Cobra', $_SESSION['filtres']['races']) ? 'checked' : '' ?>
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-13"
                               class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Cobra</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-14" type="checkbox" value="Python"
                               name="races[]" <?php echo in_array('Python', $_SESSION['filtres']['races']) ? 'checked' : '' ?>
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-14"
                               class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Python</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-15" type="checkbox" value="Vipère"
                               name="races[]" <?php echo in_array('Vipère', $_SESSION['filtres']['races']) ? 'checked' : '' ?>
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-15"
                               class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Vipère</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-16" type="checkbox" value="1"
                               name="isMale[]" <?php echo in_array(1, $_SESSION['filtres']['isMale']) ? 'checked' : '' ?>
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-16"
                               class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Male</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-17" type="checkbox" value="0"
                               name="isMale[]" <?php echo in_array(0, $_SESSION['filtres']['isMale']) ? 'checked' : '' ?>
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
<?php if ($vivariumEmpty) { ?>
    <p class="my-4">Bienvenue dans le vivarium ! Il n'y a pour l'instant aucun serpent. N'hésitez pas à en créer de
        nouveaux !</p>
    <ul class="list-disc">Vous pouvez :
        <li>Créer 15 serpents aléatoirement</li>
        <li>Créer un serpent sur mesure</li>
        <li>Modifier les caractéristiques d'un serpent et rallonger sa durée de vie</li>
        <li>Voir son profil et sa famille</li>
        <li>Tuer un serpent :(</li>
        <li>Envoyer des serpents dans la love room pour qu'ils s'accouplent</li>
    </ul>
    <p class="my-4">Attention ! Les serpents meurent rapidement ! Des alertes en haut de la page sont là pour vous
        aider.</p><br>
    <p>Vous pouvez retrouver les serpents qui s'amusent dans la love room en y accédant par le menu. Ils peuvent même avoir des bébés ! Mais attention au genre et à la race.</p>
<?php } else { ?>
    <div class="flex justify-center gap-14 my-6 items-center">
        <div class="flex text-3xl gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="50" width="40" viewBox="0 0 448 512">
                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                <path d="M289.8 46.8c3.7-9 12.5-14.8 22.2-14.8H424c13.3 0 24 10.7 24 24V168c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L321 204.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176S0 401.2 0 304s78.8-176 176-176c37 0 71.4 11.4 99.8 31l52.6-52.6L295 73c-6.9-6.9-8.9-17.2-5.2-26.2zM400 80l0 0h0v0zM176 416a112 112 0 1 0 0-224 112 112 0 1 0 0 224z"/>
            </svg>
            <div class="text-blue-700"><?= $countMale[0]['totalSerpents'] ?></div>
        </div>
        <div class="flex text-3xl gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="50" width="40" viewBox="0 0 384 512">
                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                <path d="M80 176a112 112 0 1 1 224 0A112 112 0 1 1 80 176zM224 349.1c81.9-15 144-86.8 144-173.1C368 78.8 289.2 0 192 0S16 78.8 16 176c0 86.3 62.1 158.1 144 173.1V384H128c-17.7 0-32 14.3-32 32s14.3 32 32 32h32v32c0 17.7 14.3 32 32 32s32-14.3 32-32V448h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H224V349.1z"/>
            </svg>
            <div class="text-fuchsia-500"><?= $countFemale[0]['totalSerpents'] ?></div>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                <th hx-get="page/ajax/orderBy.php?orderBy=dateNaissance&list=<?= $_GET['list'] ?? 1 ?>"
                    hx-target="#target"
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
            <label for="itemByPageSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serpents
                par
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

<?php } ?>
