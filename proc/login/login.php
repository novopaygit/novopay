<?php
	//proc 폴더의 init include
	require '../init_login.php';


	// ------- login Log 기록 함수
	function loginlogInsert($user_id,$successyn)
	{

		$LoginlogData = array(
		'loginid'   => $user_id,
		'issuccess'   => $successyn,
		'ip'   => $_SERVER['REMOTE_ADDR'],
		'useragent'      => $_SERVER['HTTP_USER_AGENT'],
		'logintime'     => date('Y-m-d H:i:s')
		);

		$daoLoginlog = instanceDAO('Loginlog');
		$result = @$daoLoginlog->insert($LoginlogData);
		return $result;

	}

	// --------------------------------------------- request values
	$user_id = addslashes(ajax('user_id'));
	$user_pw = addslashes(ajax('user_pw'));

	// --------------------------------------------- check values
	if ($user_id == '') return $objRes->fail('아이디가 필요합니다.');
	if ($user_pw == '') return $objRes->fail('비밀번호가 필요합니다.');

	//--------------------------------------------- db 회원정호 화긴
	$dbaMall = instanceDAO('Mall');

	$userdata= $dbaMall->getMallInfo($user_id);
	$password= $dbaMall->getMySqlPassword($user_pw);






	if ( (!$userdata) or (!$password) or ($userdata['password'] != $password['password']) )
	{
		loginlogInsert($user_id,'N');
		return $objRes->fail('회원정보가 정확하지않습니다.');
	}
	loginlogInsert($user_id,'Y');
	// --------------------------------------------- login process
	$sessionParam = array(
			'mall_id' => $userdata['mall_id'],
			'mall_nm'  => $userdata['mall_nm'],
			'user_nm' => $userdata['user_nm'],
			'isadmin' => $userdata['isadmin']
	);
	Auth::execLogin($sessionParam);

	// --------------------------------------------- response
	$objRes->success();


 ?>