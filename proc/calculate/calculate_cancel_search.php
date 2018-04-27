<?php
require '../init.php';

// --------------------------------------------- request values

$page      = intval(addslashes(ajax('page')));
$perPage   = intval(addslashes(ajax('perPage')));
$fromDate  = addslashes(ajax('fromDate'));
$toDate    = addslashes(ajax('toDate'));
$mallnm    = addslashes(ajax('mallnm'));
$calno    = addslashes(ajax('calno'));



$pageperline = ($page -1) * $perPage;

$list = array();

//-------------------where 조건 

if(empty($fromDate)) $fromDate ="";
if(empty($toDate)) $toDate ="";
if(empty($mallnm)) $mallnm ="";
if(empty($calno)) $calno ="";



$sql = " call proc_mallCalculateCancelSearch('%".$mallnm."%','".$fromDate."','".$toDate."','%".$calno."%',".$pageperline.",".$perPage."); ";		
//$objRes->fail($sql);
$list = $dbp->get_all($sql);

$totCnt =0;
if (count($list) > 0 ){
	$totCnt = $list[0]['tot_cnt'];
}

$objRes->addResponse('datalist', $list);
$objRes->addResponse('total_rows', $totCnt);
$objRes->success();


?>