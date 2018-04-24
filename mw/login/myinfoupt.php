<?php 	
	require '../init.php'; // 로그인 세션체크로 ini.php 대신 init_login.php 를 사용
	$mallUserInfo = getMallUserInfo($_SESSION['mall_id']);
	renderPage();

 ?>