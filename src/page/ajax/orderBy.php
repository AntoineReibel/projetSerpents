<?php
session_start();
require_once('../../class/Bdd.php');
require_once('../../class/Serpents.php');
include_once('../../function/image.php');
include_once('../../function/datesFormatees.php');

use class\Serpents;

$bdd = new Serpents();
$_SESSION['currentOrder'] = $_GET['orderBy'];
if ($_SESSION['order'][$_GET['orderBy']] == 'ASC') {
    $_SESSION['order'][$_GET['orderBy']] = 'DESC';
} else {
    $_SESSION['order'][$_GET['orderBy']] = 'ASC';
}
$serpents = $bdd->orderBy($_GET['orderBy'], $_SESSION['order'][$_GET['orderBy']]);

require_once ('../listSerpents.php');


