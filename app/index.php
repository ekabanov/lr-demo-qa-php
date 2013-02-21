<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../framework/yii.php';
$base = dirname(__FILE__) . '/protected/config/params.php';
$local = dirname(__FILE__) . '/protected/config/params-local.php';
$prod = dirname(__FILE__) . '/protected/config/params-prod.php';

$config = require($base);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);

if (file_exists($local)) {
  $config = CMap::mergeArray($config, require($local));
}

$config = CMap::mergeArray($config, require($prod));

Yii::createWebApplication($config)->run();
