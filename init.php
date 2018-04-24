<?php
if (!defined('_INIT_')) define('_INIT_', true); else return;

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

define('DOC_ROOT' , dirname(__FILE__));

define('DOC_BASE' , DOC_ROOT);
define('INC_ROOT' , DOC_BASE . DS .'inc');
define('LIB_ROOT' , DOC_BASE . DS .'lib');
define('BIZ_ROOT' , LIB_ROOT . '/biz');
define('FUNC_ROOT', LIB_ROOT . DS .'func');
define('CLS_ROOT' , LIB_ROOT . DS .'class');
define('CFG_ROOT' , LIB_ROOT . DS .'config');
define('DAO_ROOT' , BIZ_ROOT . '/dao');
define('SVC_ROOT' , BIZ_ROOT . '/svc');
//define('OKBIT_LIB', DOC_BASE . DS .'ok-bit'. DS .'lib');   //20180403 최인석 이경로는 이제 필요없어서 뺌 
define('TMP_FOLDER', 'tmp');
define('TMP_ROOT', DOC_BASE . DS . TMP_FOLDER);
define('XLS_ROOT' , DOC_BASE . DS .'xlsdown');

@session_start();

include CFG_ROOT . DS . 'cfg.env.php';

	
require FUNC_ROOT .'/func.system.php';
require FUNC_ROOT .'/func.common.php';
require FUNC_ROOT .'/func.cryptocurrency.php';
require FUNC_ROOT .'/func.getsqldata.php';



?>