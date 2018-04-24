<?php
	//proc 폴더의 init include
	require '../init.php';


	// --------------------------------------------- request values
	$mallid = addslashes(ajax('mallid'));
	$calno = addslashes(ajax('calno'));
	
	
	// 세션정보와 mall id 같은지 확인 
	if ($_SESSION['isadmin'] != 'Y') {

		$objRes->fail('관리자 계정만 정산삭제 처리가 가능합니다. ');
		return;

	}
	

	if (empty($mallid) or empty($calno) ){
		$objRes->fail('정산삭제처리에 실패했습니다.(파라메터오류) ');
		return;
	}
	
$sql = " call proc_mallCalculateCancelProc('".$mallid."','".$calno."','".$_SESSION['mall_id']."'); ";		
$list = $dbp->get_all($sql);

if (!$list){
	$objRes->fail('정산등록처리에 실패했습니다.(저장오류) ');
		return;
}


$objRes->addResponse('result_cd', $list[0]['result_cd']);
$objRes->addResponse('cal_no', $list[0]['cal_no']);

$objRes->success();


?>