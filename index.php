<?php
//error_reporting(0);
ini_set('memory_limit', '1024M');
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$debug = false;
defined('YII_DEBUG') or define('YII_DEBUG',$debug );
//show profiler
defined('YII_DEBUG_SHOW_PROFILER') or define('YII_DEBUG_SHOW_PROFILER',$debug);
//enable profiling
defined('YII_DEBUG_PROFILING') or define('YII_DEBUG_PROFILING',$debug);
//trace level
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',2);
//execution time
defined('YII_DEBUG_DISPLAY_TIME') or define('YII_DEBUG_DISPLAY_TIME',$debug);

require_once($yii);
Yii::createWebApplication($config)->run();

if(YII_DEBUG_DISPLAY_TIME)
echo Yii::getLogger()->getExecutionTime();