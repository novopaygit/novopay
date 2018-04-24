<?php 
	include_once dirname(dirname(__FILE__)) .'/init.php';		
	require_once CLS_ROOT . DS .'class.AjaxAction.php';
	
	
	$objRes = new AjaxAction();
	//db연결-------------- 로그인에서는 필요없어서 뺌
	$dsn_nm = getSystemConfig('default_dsn_name');
	$dbp = instanceDBH($dsn_nm);
	//db연결끝------------
	


 ?>