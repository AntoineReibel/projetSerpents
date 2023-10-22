<?php

use class\Serpents;

$bdd = new Serpents();
$serpents = $bdd->selectAll();
?>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">
        <div>
            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                <span class="sr-only">Action button</span>
                Action
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownAction"
                 class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                    </li>
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                    </li>
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                            account</a>
                    </li>
                </ul>
                <div class="py-1">
                    <a href="#"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                        User</a>
                </div>
            </div>
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="p-4">

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

        <?php foreach ($serpents as $serpent) { ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg"
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
                    <?= $serpent['poids'] ?>
                </td>
                <td class="px-6 py-4">
                    <?= $serpent['dateNaissance'] ?>
                </td>
                <td class="px-6 py-4">
                    <?= $serpent['dureeDeVie'] ?>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

</div>
