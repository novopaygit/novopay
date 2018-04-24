<?php
require '../init.php';

// --------------------------------------------- request values

$page      = intval(addslashes(ajax('page')));
$perPage   = intval(addslashes(ajax('perPage')));
$fromDate  = addslashes(ajax('fromDate'));
$toDate    = addslashes(ajax('toDate'));
$currencySel    = addslashes(ajax('currencySel'));
$orderNo    = addslashes(ajax('orderNo'));
$buyerName    = addslashes(ajax('buyerName'));
$txId    = addslashes(ajax('txId'));


$pageperline = ($page -1) * $perPage;

$list = array();

//-------------------where 조건 
$wheresql ="";
if(!empty($fromDate)) $wheresql .= " and  DATE_FORMAT(a.pay_dt, '%Y-%m-%d') >='".$fromDate."'"; 
if(!empty($toDate)) $wheresql .= " and  DATE_FORMAT(a.pay_dt, '%Y-%m-%d') <='".$toDate."'";
if(!empty($currencySel)) $wheresql .= " and a.currency ='".$currencySel."'";
if(!empty($orderNo)) $wheresql .= " and a.order_id like '%".$orderNo."%'";
if(!empty($buyerName)) $wheresql .= " and a.buyer_name like '%".$buyerName."%'";
if(!empty($txId)) $wheresql .= " and a.tid like '%".$txId."%'";
if ($_SESSION['isadmin'] != 'Y') $wheresql .= " and a.mall_id = '".$_SESSION['mall_id']."'";

$sql = " select b.mall_nm, DATE_FORMAT(a.pay_dt, '%Y-%m-%d') paydate,DATE_FORMAT(a.pay_dt, '%H:%i:%s') paytime
		,format(a.price,0) krw_amt,a.currency,format(a.amount,4) currency_amt,a.status,a.buyer_name,a.item_name,a.order_id
		,if(ifnull(a.cancel_status,'')='1','Y','N') cancel_nm,if(ifnull(a.cancel_status,'')='1',a.cancel_dt,'') cancel_dt		
		,a.tid,a.coin_addr ";		
$sql .=" from tbl_payment a ";
$sql .=" inner join tbl_mall b on a.mall_id = b.mall_id ";
$sql .=" where a.status ='paid'";
$sql .= $wheresql;
$sql .=" order by a.pay_no desc" ;
$sql .=" limit ".$pageperline.", ".$perPage."" ;

$list = $dbp->get_all($sql);

$sql = "select count(*) tot_cnt from tbl_payment a ";
$sql .=" where a.status ='paid'";
$sql .= $wheresql;
$totCnt = $dbp->get_row($sql);

//	$objRes->fail($sql);

$objRes->addResponse('datalist', $list);
$objRes->addResponse('total_rows', $totCnt['tot_cnt']);
$objRes->success();


?>