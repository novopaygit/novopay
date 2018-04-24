<?php 
	include_once dirname(dirname(__FILE__)) .'/init.php';

	$LINK_BASE = '/mw';
	$PROC_BASE = '/proc';
	$VIEW_BASE = '/view';

	//db연결--------------
	$dsn_nm = getSystemConfig('default_dsn_name');
	$dbp = instanceDBH($dsn_nm);
	//db연결끝------------

	function renderPage($file='') {
		extract($GLOBALS);
		if (!$file) {
			//print_r($_SERVER);
			$script_name_list = explode('/', $_SERVER['SCRIPT_NAME']);
			//$script_name_list[0] = MYOFFICE_FOLDER;
			$script_name_list[1] = 'view/mw';
			$file = DOC_BASE . DS . implode(DS, $script_name_list);
		}
		if (!file_exists($file)) exit('NOT FOUND TEMPLATE FILE : '. $file);
		require $file;
		$dbp->disconnect();
	}

	if (!Auth::checkLogin()) {
		header('Location: '. $LINK_BASE .'/login/login.php');
		exit;
	}

	function includePageHeader() {
		
		$_path = DOC_BASE . DS .'view'. DS . 'mw' . DS . 'layout'. DS .'mw.head.php';
		include $_path;
	}
	function includePageTop() {
		
		$_path = DOC_BASE . DS .'view'. DS . 'mw' . DS . 'layout'. DS .'mw.top.php';
		include $_path;
	}
	function includePageLeft() {
		
		$_path = DOC_BASE . DS .'view'. DS . 'mw' . DS . 'layout'. DS .'mw.left.php';
		include $_path;
	}
	function includePageRight() {
		
		$_path = DOC_BASE . DS .'view'. DS . 'mw' . DS . 'layout'. DS .'mw.right.php';
		include $_path;
	}
	function includePageBottom() {
		
		$_path = DOC_BASE . DS .'view'. DS . 'mw' . DS . 'layout'. DS .'mw.bottom.php';
		include $_path;
	}

 ?>