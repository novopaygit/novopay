<?php
require '../init.php';
/**
 * 2018/3/30 최인석 
 * 엑셀다운로드기능으로 쿼리 where 조건을 받아서 엑셀로전환한다.
 * inc/Excel 폴더의 클래스 참조하며 novobiz.co.kr 사이트의 다운기능을 참조했다
 * 루트의 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	이부분을 없에야 제대로 나온다. 실운영서버에는 뺄껏

 */

// --------------------------------------------- request values

$fromDate  = addslashes($_POST['fromDate']);
$toDate    = addslashes($_POST['toDate']);
$currencySel    = addslashes($_POST['currencySel']);
$orderNo    = addslashes($_POST['orderNo']);
$buyerName    = addslashes($_POST['buyerName']);
$txId    = addslashes($_POST['txId']);


//$toDate    = addslashes($_POST['toDate']);
/*$currencySel    = addslashes(ajax('currencySel'));
$orderNo    = addslashes(ajax('orderNo'));
$buyerName    = addslashes(ajax('buyerName'));
$txId    = addslashes(ajax('txId'));
*/
//-------------------where 조건 
$wheresql ="";
if(!empty($fromDate)) $wheresql .= " and  DATE_FORMAT(a.cancel_dt, '%Y-%m-%d') >='".$fromDate."'"; 
if(!empty($toDate)) $wheresql .= " and  DATE_FORMAT(a.cancel_dt, '%Y-%m-%d') <='".$toDate."'";
if(!empty($currencySel)) $wheresql .= " and a.currency ='".$currencySel."'";
if(!empty($orderNo)) $wheresql .= " and a.order_id like '%".$orderNo."%'";
if(!empty($buyerName)) $wheresql .= " and a.buyer_name like '%".$buyerName."%'";
if(!empty($txId)) $wheresql .= " and a.tid like '%".$txId."%'";
if ($_SESSION['isadmin'] != 'Y') $wheresql .= " and a.mall_id = '".$_SESSION['mall_id']."'";


require '../init.php';



$sql = " select b.mall_nm, DATE_FORMAT(a.cancel_dt, '%Y-%m-%d') canceldate,DATE_FORMAT(a.cancel_dt, '%H:%i:%s') canceltime
		, DATE_FORMAT(a.pay_dt, '%Y-%m-%d') paydate,DATE_FORMAT(a.pay_dt, '%H:%i:%s') paytime
		,a.price krw_amt,a.currency,a.amount currency_amt,a.status,a.buyer_name,a.item_name,a.order_id,a.tid,a.coin_addr ";		
$sql .=" from tbl_payment a ";
$sql .=" inner join tbl_mall b on a.mall_id = b.mall_id ";
$sql .=" where a.cancel_status in('1','2')";
$sql .= $wheresql;
$sql .=" order by a.pay_no desc"; 

$result = $dbp->get_all($sql);

$cnt = count($result);
if(!$cnt){
	$dbp->disconnect();//db close 
	alertphp("출력할 내역이 없습니다.");

}


/*================================================================================
php_writeexcel http://www.bettina-attack.de/jonny/view.php/projects/php_writeexcel/
=================================================================================*/

include_once(INC_ROOT.DS.'Excel/php_writeexcel/class.writeexcel_workbook.inc.php');
include_once(INC_ROOT.DS.'Excel/php_writeexcel/class.writeexcel_worksheet.inc.php');

$fname = tempnam(XLS_ROOT.DS.'xlsdown', "tmp-transactionlist.xls");
$workbook = new writeexcel_workbook($fname);
$worksheet = $workbook->addworksheet();

// Put Excel data
$data = array('쇼핑몰','취소일','취소시간','결제일','결제시간','결제금액','결제화폐','화폐금액','구매자명','상품명','쇼핑몰주문번호','노보페이결제번호','송금주소');
$data = array_map('iconv_euckr', $data);




$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

$i = 1;

foreach ($result as $row) {	
	$row = array_map('iconv_euckr', $row);	
	$j = 0;
	$worksheet->write($i, $j++, $row['mall_nm']);
	$worksheet->write($i, $j++, $row['canceldate']);
	$worksheet->write($i, $j++, $row['canceltime']);
	$worksheet->write($i, $j++, $row['paydate']);
	$worksheet->write($i, $j++, $row['paytime']);
	$worksheet->write($i, $j++, $row['krw_amt']);
	$worksheet->write($i, $j++, $row['currency']);
	$worksheet->write($i, $j++, $row['currency_amt']);	
	$worksheet->write($i, $j++, $row['buyer_name']);
	$worksheet->write($i, $j++, $row['item_name']);
	$worksheet->write($i, $j++, $row['order_id']);
	$worksheet->write($i, $j++, $row['tid']);
	$worksheet->write($i, $j++, $row['coin_addr']);
	
	$i++;
}


$workbook->close();
$dbp->disconnect();//db close 

//$title = iconv_euckr("거래리스트");
$title = 'translistcancel';
header("Content-Type: application/x-msexcel; name=\"{$title}-".date("ymd", time()).".xls\"");
header("Content-Disposition: inline; filename=\"{$title}-".date("ymd", time()).".xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);

?>	