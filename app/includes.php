<?php

$dir = dirname(__FILE__);
if( !@include_once( "{$dir}/vendor/autoload.php" ) ) {
	include_once("{$dir}/vendor/apache/log4php/src/main/php/Logger.php");
}
require_once "{$dir}/config.php";
require_once "{$dir}/data/PDOHelper.php";
require_once "{$dir}/data/ImportService.php";
require_once "{$dir}/data/ImportException.php";
require_once "{$dir}/data/Zdjecie.php";
require_once "{$dir}/data/ZdjeciaRepository.php";
require_once "{$dir}/data/Nieruchomosc.php";
require_once "{$dir}/data/NieruchomosciRepository.php";
require_once "{$dir}/data/SearchQuery.php";

header('Content-Type: text/html; charset=utf-8');

function getUrl( $path ) {
  global $config;
  return $config['urlRoot'] . $path;
}
