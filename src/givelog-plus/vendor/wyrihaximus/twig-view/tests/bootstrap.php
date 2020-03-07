<?php

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/cakephp/cakephp/src/basics.php';

define('APP', sys_get_temp_dir());
define('TMP', sys_get_temp_dir() . '/TwigViewTmp/');
define('CACHE', sys_get_temp_dir() . '/TwigViewTmp/cache/');
define('PLUGIN_REPO_ROOT', dirname(__DIR__) . DS);

$TMP = new \Cake\Filesystem\Folder(TMP);
$TMP->create(TMP . 'cache/models', 0777);
$TMP->create(TMP . 'cache/persistent', 0777);
$TMP->create(TMP . 'cache/views', 0777);

Configure::write('debug', true);
if (!getenv('db_dsn')) {
	putenv('db_dsn=sqlite:///:memory:');
}
ConnectionManager::setConfig('test', ['url' => getenv('db_dsn')]);

Cake\Core\Configure::write(
	'App',
	[
		'namespace' => 'App',
        'encoding' => 'utf-8',
	]
);

$cache = [
	'default' => [
		'engine' => 'File'
	],
	'_cake_core_' => [
		'className' => 'File',
		'prefix' => '_cake_core_',
		'path' => CACHE . 'persistent/',
		'serialize' => true,
		'duration' => '+10 seconds'
	],
];

Cake\Cache\Cache::setConfig($cache);
