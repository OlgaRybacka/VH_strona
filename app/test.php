<?php

require "includes.php";

$pdo = PDOHelper::fromConfig();
if( file_exists("./import/working/e.zip") ) {
  rename("./import/working/e.zip", "./import/waiting/e.zip");
}
$importService = new ImportService( $pdo, new ZdjeciaRepository( $pdo ), new  NieruchomosciRepository( $pdo ) );
if( file_exists("./import/waiting/e.zip") ) {
  echo "imort e";
  $importService->import('e.zip');
}
if( file_exists("./import/waiting/r.zip") ) {
  echo "imort r";
  $importService->import('r.zip');
}
