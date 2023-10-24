<?php

use class\Serpents;

$bdd = new Serpents();
$serpents = $bdd->selectAll();
?>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">
        <a href="index.php?page=create">
            <button class="relative py-2 px-8 text-black text-base font-bold uppercase rounded-[50px] overflow-hidden bg-white transition-all duration-400 ease-in-out shadow-md hover:scale-105 hover:text-white hover:shadow-lg active:scale-90 before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-gradient-to-r before:from-emerald-600 before:to-emerald-400 before:transition-all before:duration-500 before:ease-in-out before:z-[-1] before:rounded-[50px] hover:before:left-0">
                Créer un serpent !
            </button>

        </a>
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
            <th scope="col" class="px-6 py-3">
                Nom
            </th>
            <th scope="col" class="px-6 py-3">
                race
            </th>
            <th scope="col" class="px-6 py-3">
                Genre
            </th>
            <th scope="col" class="px-6 py-3">
                poids
            </th>
            <th scope="col" class="px-6 py-3">
                Date de naissance
            </th>
            <th scope="col" class="px-6 py-3">
                Date de mort
            </th>
            <th scope="col" class="px-6 py-3">
                Détails
            </th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($serpents as $serpent) {
            if (!$serpent['isDead']) {
                ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 hover:text-emerald-600">
                        <a href="index.php?page=edit&id= <?= $serpent['id_serpents'] ?> ">Modifier</a>
                    </td>
                    <td class="px-6 py-4 hover:text-red-600">
                        <a href="index.php?page=delete&id= <?= $serpent['id_serpents'] ?> ">Tuer</a>
                    </td>
                    <td class="px-6 py-4 hover:text-pink-500">
                        <a href="">Envoyer dans la love room</a>
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="<?= getImage($serpent['idRace']) ?>"
                             alt="Jese image">
                        <div class="pl-3">
                            <div class="text-base font-semibold"><?= $serpent['nomSerpent'] ?></div>
                            <div class="font-normal text-gray-500"></div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        <?= $serpent['nomRace'] ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full <?php echo $serpent['isMale'] ? 'bg-blue-700' : 'bg-fuchsia-500'; ?> mr-2"></div>
                            <?php echo $serpent['isMale'] ? 'Male' : 'Femelle'; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <?= $serpent['poids'] ?>kg
                    </td>
                    <td class="px-6 py-4">
                        <?= (new DateTime($serpent['dateNaissance']))->format('d/m/y \à H\hi'); ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= (new DateTime($serpent['dureeDeVie']))->format('d/m/y \à H\hi'); ?>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </td>
                </tr>
            <?php }
        } ?>

        </tbody>
    </table>

</div>
