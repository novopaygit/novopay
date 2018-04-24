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

$fromDate  = addslashes(ajax('fromDate'));
$toDate    = addslashes(ajax('toDate'));
$mallnm    = addslashes(ajax('mallnm'));
$calno    = addslashes(ajax('calno'));



//$toDate    = addslashes($_POST['toDate']);
/*$currencySel    = addslashes(ajax('currencySel'));
$orderNo    = addslashes(ajax('orderNo'));
$buyerName    = addslashes(ajax('buyerName'));
$txId    = addslashes(ajax('txId'));
*/
//-------------------where 조건 

if(empty($fromDate)) $fromDate ="";
if(empty($toDate)) $toDate ="";
if(empty($mallnm)) $mallnm ="";
if(empty($calno)) $calno ="";

$wheresql ="";
if(!empty($fromDate)) $wheresql .= " and  DATE_FORMAT(a.cal_datetime, '%Y-%m-%d') >='".$fromDate."'"; 
if(!empty($toDate)) $wheresql .= " and  DATE_FORMAT(a.cal_datetime, '%Y-%m-%d') <='".$toDate."'";
if(!empty($mallnm)) $wheresql .= " and b.mall_nm like '%".$mallnm."%'";
if ($_SESSION['isadmin'] != 'Y') $wheresql .= " and a.mall_id = '".$_SESSION['mall_id']."'";



$sql = " 	select  b.mall_nm,a.cal_no,a.mall_id
	,DATE_FORMAT(a.cal_datetime, '%Y-%m-%d') cal_dt
	,DATE_FORMAT(a.cal_datetime, '%H:%i:%s') cal_time	
	,a.cal_fromdt,a.cal_todt
	,a.amount  ,a.calculate_amount ,a.commission_amount,a.commission_rate
	from tbl_cal_master a
	inner join tbl_mall b on a.mall_id =b.mall_id
	where 1=1 ";
$sql .= $wheresql;	
$sql .= " order by b.mall_nm,a.cal_no ";
	 
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
$data = array('쇼핑몰','정산번호','정산일자','등록시간','등록시산정된정산기간','결제금액','정산금액','수수료','수수료율');
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
	$worksheet->write($i, $j++, $row['cal_no']);
	$worksheet->write($i, $j++, $row['cal_dt']);
	$worksheet->write($i, $j++, $row['cal_time']);
	$worksheet->write($i, $j++, $row['cal_fromdt'].' ~ '.$row['cal_todt']);
	$worksheet->write($i, $j++, $row['amount']);
	$worksheet->write($i, $j++, $row['calculate_amount']);
	$worksheet->write($i, $j++, $row['commission_amount']);
	$worksheet->write($i, $j++, $row['commission_rate']);
	
	$i++;
}


$workbook->close();
$dbp->disconnect();//db close 

//$title = iconv_euckr("거래리스트");
$title = 'calculatelist';
header("Content-Type: application/x-msexcel; name=\"{$title}-".date("ymd", time()).".xls\"");
header("Content-Disposition: inline; filename=\"{$title}-".date("ymd", time()).".xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);

?>	