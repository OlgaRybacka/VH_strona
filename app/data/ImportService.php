<?php

class ImportService {
  private static $logger;

  public static function static_init() {
    static $was = false;
    if ( !$was ) {
      $was = true;
      self::$logger = Logger::getLogger("ImportService");
    }
  }

  private $pdo;
  /**
   * @var NieruchomosciRepository
   */
  private $nieruchomosciRepository;
  /**
   * @var ZdjeciaRepository
   */
  private $zdjeciaRepository;
  private $waitingDir;
  private $workingDir;
  private $oldDir;
  private $imgDir;
  private $imgUrlRoot;

  public function __construct( $pdo, $zdjeciaRepository, $nieruchomosciRepository ) {
    $this->pdo = $pdo;
    $this->zdjeciaRepository = $zdjeciaRepository;
    $this->nieruchomosciRepository = $nieruchomosciRepository;
    $this->loadDefaults();
  }

  private function loadDefaults() {
    global $appDir;
    $this->waitingDir = "{$appDir}/import/waiting/";
    $this->workingDir = "{$appDir}/import/working/";
    $this->oldDir     = "{$appDir}/import/old/";
    $this->imgDir     = "{$appDir}/public/img/";
    $this->imgUrlRoot = "/public/img/";
    $this->tmpDir     = sys_get_temp_dir();
  }


  public function import( $fileName ) {
    self::$logger->info("Begin import {$fileName}.");
    try {
      $this->pdo->beginTransaction();
      $workPath = $this->moveToWorkDir( $fileName );
      $this->extractAndImport( $workPath );
      $this->pdo->commit();
      $this->moveToOld( $workPath, $fileName );
    } catch ( Exception $e ) {
      self::$logger->error("Rolling back after error.", $e);
      if ( $this->pdo->inTransaction() ) {
        $this->pdo->rollback();
      }
      throw $e;
    }
    self::$logger->info("End import {$fileName}.");
  }

  public function moveToWorkDir( $fileName ) {
    self::$logger->info("Moving {$fileName}.");
    $waitPath = "{$this->waitingDir}{$fileName}";
    $workPath = "{$this->workingDir}{$fileName}";
    $success = rename($waitPath, $workPath);
    if( !$success ) {
      throw new ImportException("Cannot move {$waitPath} to {$workPath}.");
    }
    return $workPath;
  }

  public function extractAndImport( $workPath ) {
    self::$logger->info("Extracting {$workPath}.");
    $archive = new ZipArchive();
    $success = $archive->open( $workPath );
    if ( !$success ) {
      throw new ImportException("Cannot open zip file: $workPath.");
    }
    $tmp = "{$this->tmpDir}/" . date('Y-m-d_H_i_s_u'). '/';
    $success = mkdir($tmp);
    if ( !$success ) {
      throw new ImportException("Cannot create tmp dir $tmp.");
    }
    $success = $archive->extractTo($tmp);
    if( !$success ) {
      throw new ImportException("Cannot extract to $tmp.");
    }
    $files = scandir($tmp);
    $imgMap = array();
    foreach( $files as $file ) {
      if ( preg_match( '/\.(jpg|png|jpeg|bmp)$/', $file ) ) {
        $imgMap[$file] = $this->handleImage( $tmp, $file );
      }
    }
    foreach( $files as $file ) {
      if ( preg_match( '/\.xml$/', $file ) ) {
        $this->handleXml( $tmp, $file, $imgMap );
      }
    }
  }

  public function handleImage( $tmp, $file ) {
    self::$logger->info("Handling {$file} ({$tmp}).");
    $hash = md5_file("{$tmp}{$file}");
    $src  = "{$tmp}{$file}";
    $dest = "{$this->imgDir}{$hash}_{$file}";
    self::$logger->info("copy {$src} -> {$dest}.");
    $success = copy( $src, $dest );
    if( !$success ) {
      throw new ImportException("Cannot copy image.");
    }
    return "{$this->imgUrlRoot}{$hash}_{$file}";
  }

  public function handleXml( $tmp, $file, $imgMap ) {
    $path = "{$tmp}{$file}";
    $doc = new DOMDocument();
    $doc->load($path);
    $xpath = new DOMXPath( $doc );
    $list = $xpath->query('/plik/zdjecia/zdjecie');
    for( $i = 0; $i<$list->length; $i++ ) {
      $zdj = Zdjecie::fromDomElement( $list->item($i) );
      if ( !isset($imgMap[$zdj->getNazwa()]) ) {
        self::$logger->warn("No entry for {$zdj->getNazwa()} in img Map");
      }
      $zdj->setUrl( $imgMap[$zdj->getNazwa()] );
      $this->zdjeciaRepository->insertOrUpdate( $zdj );
    }
    $list = $xpath->query('/plik/lista_ofert/dzial/oferta');
    for( $i = 0; $i<$list->length; $i++ ) {
      $nieruchomosc = Nieruchomosc::fromDomElement( $list->item($i) );
      $this->nieruchomosciRepository->insertOrUpdate($nieruchomosc);
    }
    $list = $xpath->query('/plik/lista_ofert/dzial/oferta_usun/id');
    for( $i = 0; $i<$list->length; $i++ ) {
      $id = intval( $list->item($i)->textContent );
      $this->nieruchomosciRepository->delete( $id );
    }
  }

  public function moveToOld( $workPath, $fileName ) {
    $prefix = date('Y-m-d');
    $oldPath = "{$this->oldDir}{$prefix}_{$fileName}";
    $success = rename( $workPath, $oldPath);
    if( !$success ) {
      throw new ImportException("Cannot move {$workPath} to {$oldPath}.");
    }
  }
}

ImportService::static_init();
