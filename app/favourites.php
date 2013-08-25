<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 20.07.13
 * Time: 11:47
 * To change this template use File | Settings | File Templates.
 */

session_start();

if(!isset($_SESSION['favourites']))
{
    $_SESSION['favourites'] = array();
}

$id = (isset($_GET['id'])) ? $_GET['id'] : $_POST['id'];
if( isset($id) && !in_array($id, $_SESSION['favourites']) ) {
    $_SESSION['favourites'][] = $id;
}

$removeId = (isset($_GET['remove'])) ? $_GET['remove'] : $_POST['remove'];
if(($key = array_search($removeId, $_SESSION['favourites'])) !== false) {
	unset($_SESSION['favourites'][$key]);
}

echo "[" . implode(',', $_SESSION['favourites']) . "]";
