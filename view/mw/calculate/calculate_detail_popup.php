<!DOCTYPE HTML>
<html>
	<head>
	<?php includePageHeader();	?>
	<script type="text/javascript">
		 

		</script>

	</head>
	<body>
	
		 <article class="paytable-wrap cont-box">				     
		     <div class="paytable-cont" style="overflow-x:hidden;">
			     <table class="paytable" style="width:920px;">
				     <caption>거래내역조회</caption>
					 <colgroup>
					 	 <col width="8">
					     <col width="12">
					     <col width="11">
					     <col width="12">
					     <col width="5">
					     <col width="10">
					     <col width="10">
					     <col width="8">
					     
					     
					 </colgroup>
					 <thead>
					     <tr>
					     	<th>쇼핑몰명</th>									 
					     	 <th>결제일시</th>
					     	 <th>주문번호</th>
					     	 <th>상품명</th>
					     	 <th>구매자</th>							     	 							 
							 <th>결제금액</th>									 
							 <th>정산금액</th>
							 <th>수수료</th>							 
							 
						 </tr>
					 </thead>
					 <tbody id ="schList"></tbody>

					 <?php 
					 foreach ($list as $row ) {
					 	echo '<tr>';

					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['mall_nm']).'</span></td>';
					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['pay_dt']).'</span></td>';
					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['order_id']).'</span></td>';
					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['item_name']).'</span></td>';
					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['buyer_name']).'</span></td>';
					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['amount']).'</span></td>';
					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['calculate_amount']).'</span></td>';
					 	echo '<td class="t-c"><span>'.htmlspecialchars($row['commission_amount']).'</span></td>';
					 	echo '</tr>';
					 }	
					 ?>
				 </table>
	
		 </article><!-- /paytable-wrap -->
		</div>

			
		
</body>
</html>		
		