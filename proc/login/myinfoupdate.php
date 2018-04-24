<?php
	//proc 폴더의 init include
	require '../init.php';


	// --------------------------------------------- request values
	$mall_id = addslashes(ajax('mall_id'));
	$user_nm = addslashes(ajax('user_nm'));
	$user_email = addslashes(ajax('user_email'));
	$old_pwd = addslashes(ajax('old_pwd'));
	$new_pwd = addslashes(ajax('new_pwd'));

	// 세션정보와 mall id 같은지 확인 
	if ($mall_id != $_SESSION['mall_id']) {

		$objRes->fail('로그인된정보와 일치하지않습니다.재로그인해주세요 ');

	}
	

	//----------update 쿼리  및 update 쿼리수행 
	$sql = " select ifnull(count(*),0) chkrow from tbl_mall ";	
 	$sql .= " where mall_id ='".$mall_id."'";
 	$sql .= " and password = password('".$old_pwd."')";
 	$chkrow = $dbp->get_row($sql);
		
	

 	if( $chkrow["chkrow"] != 1 ){
 		$objRes->fail('비밀번호가 틀립니다. 현재비밀번호를 정확히 입력해주세요');
 	}

	$setsql ="";
	if(!empty($user_nm)) $setsql .= " ,user_nm='".$user_nm."'"; 
	if(!empty($user_email)) $setsql .= " ,user_email='".$user_email."'"; 
	if(!empty($new_pwd) and trim($new_pwd) != '') $setsql .= " ,password=password('".$new_pwd."')"; 


	$sql = " update tbl_mall 
				set modify_dt =now() ";		
	$sql .= $setsql;
	$sql .= " where mall_id ='".$mall_id."'";

	$result = $dbp->execute($sql);
	
	if (!$result ) {
		$objRes->fail('저장에 실패했습니다. 다시시도해주세요');
	}

	$retCode="0000"; // 성공 코드 
	$objRes->addResponse('retCode', $retCode);
	$objRes->success();


?>