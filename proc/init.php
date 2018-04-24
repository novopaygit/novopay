<?php 
	include_once dirname(dirname(__FILE__)) .'/init.php';		
	require_once  CLS_ROOT . DS .'class.AjaxAction.php';
	
	
	$objRes = new AjaxAction();
	//db연결--------------
	$dsn_nm = getSystemConfig('default_dsn_name');
	$dbp = instanceDBH($dsn_nm);
	//db연결끝------------

	

	if (!$_SESSION['mall_id']) {

		$objRes->fail('로그인 후 재시도하세요. ');
		return;

	}


 ?>