<?php

require "includes.php";

$pdo = PDOHelper::fromConfig();
if( file_exists("./import/working/e.zip") ) {
  rename("./import/working/e.zip", "./import/waiting/e.zip");
}
$importService = new ImportService( $pdo, new ZdjeciaRepository( $pdo ), new  NieruchomosciRepository( $pdo ) );
$importService->import('e.zip');
