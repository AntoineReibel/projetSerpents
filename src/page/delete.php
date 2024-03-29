<?php

use class\Serpents;

$serpent = new Serpents($_GET['id']);

$serpent->kill();
if ($serpent->get('isDead') == 1){
    $_SESSION['tooOld'] = true;
    header('Location: index.php?page=vivarium');
    exit();
}

if (!isset($_SESSION['kill'])) {
    $_SESSION['kill'] = ['bool'=>false,'id'=>0 ];
}

if (isset($_POST['kill'])) {
    $serpent->set('isDead', '1');
    if (isset($_SESSION['kill'])) {

        $_SESSION['kill']['bool'] = true;
        $_SESSION['kill']['nom'] = $serpent->get('nomSerpent');
    }
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
