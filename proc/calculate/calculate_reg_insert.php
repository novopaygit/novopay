<?php
	//proc 폴더의 init include
	require '../init.php';


	// --------------------------------------------- request values
	$mallid = addslashes(ajax('mallid'));
	$fromdt = addslashes(ajax('fromdt'));
	$todt = addslashes(ajax('todt'));
	$calamtnum = addslashes(ajax('calamtnum'));
	
	
	// 세션정보와 mall id 같은지 확인 
	if ($_SESSION['isadmin'] != 'Y') {

		$objRes->fail('관리자 계정만 정산등록처리가 가능합니다. ');
		return;

	}
	

	if (empty($mallid) or empty($fromdt) or empty($todt)){
		$objRes->fail('정산등록처리에 실패했습니다.(파라메터오류) ');
		return;
	}
	
$sql = " call proc_mallCalculateProc('".$mallid."','".$fromdt."','".$todt."',".$calamtnum.",'".$_SESSION['mall_id']."'); ";		
//$objRes->fail($sql);
$list = $dbp->get_all($sql);

if (!$list){
	$objRes->fail('정산등록처리에 실패했습니다.(저장오류) ');
		return;
}


$objRes->addResponse('result_cd', $list[0]['result_cd']);
$objRes->addResponse('calculate_amount', $list[0]['calculate_amount']);
$objRes->success();


?>