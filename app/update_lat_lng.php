<?php

require_once "includes.php";

$pdo = PDOHelper::fromConfig();
$nieruchomosciRepository = new NieruchomosciRepository( $pdo );

$id = $_REQUEST['id'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];

$nieruchomosc = $nieruchomosciRepository->get( $id );
$nieruchomosc->setLat( $lat );
$nieruchomosc->setLng( $lng );
$nieruchomosciRepository->update( $nieruchomosc );
