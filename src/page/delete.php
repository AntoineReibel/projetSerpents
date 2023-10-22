<?php

use class\Serpents;

$serpent = new Serpents($_GET['id']);
if (isset($_POST['kill'])){
    $serpent->delete();
    header('Location: index.php?page=vivarium');
}


?>

<p>Allez-vous vraiment tuer <?php echo $serpent->get('isMale') ? " le " : " la " ?>
    pauvre <?= $serpent->get('nomSerpent') ?> ?</p>
<div class="flex gap-2 mt-2">
    <form action="" method="post">
        <button name='kill'
                class="cursor-pointer text-white font-bold shadow-md hover:scale-[1.2] shadow-purple-400 rounded-full px-5 py-2 bg-gradient-to-bl from-red-500 to-red-600">
            Oui
        </button>
    </form>

    <a href="index.php?page=vivarium">
        <button class="cursor-pointer text-white font-bold shadow-md hover:scale-[1.2] shadow-purple-400 rounded-full px-5 py-2 bg-gradient-to-bl from-indigo-500 to-blue-500">
            Non
        </button>
    </a>
</div>
