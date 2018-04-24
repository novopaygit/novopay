<?php 
	/*

		같은폴더의 init.php 와 차이는 
		아래 인증여부 체크 여부 이다. 봐서 하나로 빼야될듯 
		init_login.php 를 사용하는 파일은 login.php 와 index.php 이다. 
		if (!Auth::checkLogin()) {
		header('Location: '. $LINK_BASE .'/login/login.php');
		exit;
	}
	*/		

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