<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('foowd_api', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=foowd_api',
  'user' => 'foowd',
  'password' => 'mangioBENE',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
  ),
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
      'utf8' => 'SET NAMES utf8 COLLATE utf8_unicode_ci, COLLATION_CONNECTION = utf8_unicode_ci, COLLATION_DATABASE = utf8_unicode_ci, COLLATION_SERVER = utf8_unicode_ci',
    ),
  ),
));
$manager->setName('foowd_api');
$serviceContainer->setConnectionManager('foowd_api', $manager);
$serviceContainer->setDefaultDatasource('foowd_api');