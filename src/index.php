<?php
spl_autoload_register();
session_start();

include_once ('./function/datesFormatees.php');
include_once ('./function/image.php');
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../dist/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Lato:wght@400;700;900&display=swap"
          rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
include_once("menu.php");
?>

<main>
    <?php

    if (isset($_GET['page'])) {
        $page = "page/" . $_GET['page'] . ".php";
        if (file_exists($page)) {
            include_once($page);
        } else {
            echo "<div>page non trouvé</div>";
        }
    } else {
        include_once("page/accueil.php");
    }


    ?>
</main>

    <?php include_once ("footer.php")?>

<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>