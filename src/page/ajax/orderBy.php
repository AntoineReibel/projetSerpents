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
$serpents = $bdd->paginate($_SESSION['currentOrder'], $_SESSION['order'][$_SESSION['currentOrder']], (isset($_GET['list']) ? (($_GET['list'] - 1) * $_SESSION['paginate']) : 0 ), $_SESSION['paginate'],$_SESSION['filtres']['races'], $_SESSION['filtres']['isMale']);

require_once ('../listSerpents.php');


