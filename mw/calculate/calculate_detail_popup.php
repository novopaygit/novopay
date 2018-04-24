<?php 	
	require '../init.php';	
	
	$calno = addslashes($_GET['calno']);

	$sql = "select c.mall_nm,'' pay_dt,'' order_id,'<합계>' item_name,'' buyer_name ,format(sum(a.amount),0) amount 
		,format(sum(a.calculate_amount),0) calculate_amount, format(sum(a.commission_amount) ,0) commission_amount 
		from tbl_cal_detail a inner join tbl_payment b on a.pay_no = b.pay_no
		 inner join tbl_mall c on b.mall_id = c.mall_id 
		where a.cal_no ='".$calno." '";
	if ($_SESSION['isadmin'] != 'Y'){
		$sql .= " and a.mall_id='".$_SESSION['mall_id']."'";
	}	
	$sql .=" group by c.mall_nm ";
	$sql .=" union all ";
	$sql .= "select c.mall_nm,b.pay_dt,b.order_id,b.item_name,b.buyer_name
	      ,format(a.amount,0) amount ,format(a.calculate_amount,0) calculate_amount, format(a.commission_amount ,0) commission_amount
			from tbl_cal_detail a
			inner join tbl_payment b on a.pay_no = b.pay_no
			inner join tbl_mall c on b.mall_id = c.mall_id
			where a.cal_no ='".$calno." '";
	if ($_SESSION['isadmin'] != 'Y'){
		$sql .= " and a.mall_id='".$_SESSION['mall_id']."'";
	}	
	
	#echo $sql;
	$list = $dbp->get_all($sql);
	$dbp->disconnect();
	renderPage();

 ?>