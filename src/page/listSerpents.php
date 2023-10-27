<?php

/** @var array $serpents */
foreach ($serpents as $serpent) {
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
    <?php
} ?>
