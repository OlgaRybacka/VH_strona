<?php


class PDOHelper {
  private static $logger;
  private static $pdo = null;

  private static function init() {
    static $was = false;
    if ( !$was ) {
      $was = true;
      self::$logger = Logger::getLogger("PDOHelper");
    }
  }
  public static function fromConfig() {
    if ( self::$pdo == null ) {
      self::init();
      self::$logger->info('new pdo from config.');
      global $config;
      self::$pdo = self::createPdo($config['dbConnectionString']
        , $config['dbUserName']
        , $config['dbPassword']);
    }
    return self::$pdo;
  }

  protected static function createPdo($dbConnectionString, $dbUserName, $dbPassword) {
    $pdo = new PDO($dbConnectionString, $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

}
