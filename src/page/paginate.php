<?php

use class\Serpents;

require_once('function/pagination.php');

$sql = new Serpents();
$selectSerpents = $sql->selectAll();

$totalSerpents = nombreSerpentsFiltre($selectSerpents);

$nombrePages = (intdiv($totalSerpents, $_SESSION['paginate']) + 1)
?>

<ul class="flex items-center justify-center -space-x-px h-8 text-sm">
    <li>
        <a href="index.php?page=vivarium&list=
<?php if ($_GET['list'] == 1) {
            echo $_GET['list'];
        } else {
            echo $_GET['list'] - 1;
        }
        ?>
"
           class="<?php echo $_GET['list'] == 1 ? 'pointer-events-none' : '' ?> flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <span class="sr-only">Précedent</span>
            <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 1 1 5l4 4"/>
            </svg>
        </a>
    </li>
    <?php for ($i = 1; $i <= $nombrePages; $i++) { ?>

        <li>
            <a
                    href="index.php?page=vivarium&list=<?= $i ?>"
                    class=" <?php if ($_GET['list'] == $i) echo 'font-bold pointer-events-none' ?> flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i ?></a>
        </li>
    <?php } ?>
    <li>
        <a href="index.php?page=vivarium&list=
<?php if ($_GET['list'] < $nombrePages) {
            echo $_GET['list'] + 1;
        } else {
            echo $_GET['list'];
        }
        ?>
"
           class="<?php echo $_GET['list'] == $nombrePages ? 'pointer-events-none' : '' ?> flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <span class="sr-only">Suivant</span>
            <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 9 4-4-4-4"/>
            </svg>
        </a>
    </li>
</ul>