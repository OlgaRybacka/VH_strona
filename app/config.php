<?php
$appDir = __dir__;
error_reporting(E_ALL);
ini_set('display_errors', '1');

Logger::configure(array(
    'rootLogger' => array(
        'appenders' => array('default'),
    ),
    'appenders' => array(
        'default' => array(
            'class' => 'LoggerAppenderDailyFile',
            'layout' => array(
              'class' => 'LoggerLayoutPattern',
              'conversionPattern' => '%d{ISO8601} [%p] %c: %m (at %F line %L)%n%exception'
            ),
            'params' => array(
                'file' => "{$appDir}/logs/log-%s.txt",
                'append' => true
            )
        )
    )
  ));

$config = array();
$config['dbConnectionString']
  = 'mysql:host=localhost;dbname=vanhausen_0001';
$config['dbUserName'] = 'vanhausen_0001';
$config['dbPassword'] = 'q5IP2dyaX9Nt';

