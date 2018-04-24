<?php
require '../init.php';

// --------------------------------------------- request values

$page      = intval(addslashes(ajax('page')));
$perPage   = intval(addslashes(ajax('perPage')));
$fromDate  = addslashes(ajax('fromDate'));
$toDate    = addslashes(ajax('toDate'));
$mallnm    = addslashes(ajax('mallnm'));


$pageperline = ($page -1) * $perPage;

$list = array();

//-------------------where 조건 

if(empty($fromDate)) $fromDate ="";
if(empty($toDate)) $toDate ="";
if(empty($mallnm)) $mallnm ="";



$sql = " call proc_mallCalculateSearch('%".$mallnm."%','".$fromDate."','".$toDate."',".$pageperline.",".$perPage."); ";		
$list = $dbp->get_all($sql);

$totCnt =0;
if (count($list) > 0 ){
	$totCnt = $list[0]['tot_cnt'];
}

$objRes->addResponse('datalist', $list);
$objRes->addResponse('total_rows', $totCnt);
$objRes->success();


?>