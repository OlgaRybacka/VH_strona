<?php

require_once "includes.php";

$pdo = PDOHelper::fromConfig();
$nieruchomosciRepository = new NieruchomosciRepository( $pdo );

$id = $_REQUEST['id'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
if( !empty( $lat ) && !empty( $lng ) && !empty( $id ) ) {
	$nieruchomosc = $nieruchomosciRepository->get( $id );
	if( $nieruchomosc && ( !$nieruchomosc->getLat() || !$nieruchomosc->getLng() ) ) {
		$nieruchomosc->setLat( $lat );
		$nieruchomosc->setLng( $lng );
		$nieruchomosciRepository->update( $nieruchomosc );
	}
}
