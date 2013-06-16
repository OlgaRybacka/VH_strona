<?php

require "includes.php";
global $appDir;

$pdo = PDOHelper::fromConfig();
$importService = new ImportService( $pdo, new ZdjeciaRepository( $pdo ), new  NieruchomosciRepository( $pdo ) );
$logger = Logger::getLogger(__FILE__);

// LOCK
$fp = fopen("{$appDir}/tmp/__LOCK__", "a+");
if (flock($fp, LOCK_EX)) {  // acquire an exclusive lock
	fwrite($fp, date('l jS F Y h:i:s A') ."\n");
	fflush($fp);            // flush output before releasing the lock
} else {
	$logger->info("locking file failed");
	die("cannot acquire lock.");
}
// end LOCK

// fix issue with wrong path !!
$files = scandir("./import/");
foreach( $files as $f ) {
	if ( !is_dir($f) && preg_match( "/waiting.*.zip/i", $f) ) {
		echo "move ./import/$f to ./import/waiting/$f";
		rename("./import/$f", "./import/waiting/$f");
	} else {
	}
}

$files = scandir("./import/waiting/");
foreach( $files as $f ) {
	if ( !is_dir($f) && preg_match( "/.*.zip/i", $f) ) {
		echo "import $f<br/>";
		$importService->import($f);
	} else {
		echo "skip $f<br/>";
	}
}

//////////////// CLEANUP //////////////////

# recursively remove a directory
function rrmdir($dir) {
	foreach(glob($dir . '/*') as $file) {
		if(is_dir($file)) {
			rrmdir($file);
		} else {
			if( $file != "__LOCK__" ) { unlink($file); }
		}
	}
	rmdir($dir);
}
$files = scandir("./tmp/");
foreach( $files as $f ) {
	if ( is_dir("./tmp/$f") && preg_match( "/20[0-9][0-9][0-9\\-_]+/i", $f) ) {
		// remove dirs like 2013-06-15_19_38_16_000000_1307212396
		rrmdir( "./tmp/$f" );
	} else {
		echo "skip deleting $f<br/>";
	}
}
fclose($fp);
