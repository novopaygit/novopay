<!DOCTYPE HTML>
<html>
	<head>
	<?php includePageHeader();	?>
	<script type="text/javascript">
		    $(function(){
				$("#fromDate").datepicker({
					dateFormat: "yy-mm-dd"
				});
				$("#toDate").datepicker({
					dateFormat: "yy-mm-dd"
				});
			});

			//당월, 전월, 당해년, 전체 선택
			//dtOpt : 당월(tm), 전월(pm), 당해년(ty), 전체선택 날짜input초기화
			//schObj : 검색버튼 id값
			function changeDate(fromDateObj, toDateObj, dtOpt, schObj){
				var fD = $("#"+fromDateObj);
				var tD = $("#"+toDateObj);
				var date = '<?=date('Y-m-d');?>';
				var year = '<?=date('Y');?>'; //당해
				var month = '<?=date('m');?>'; //당월
				var today ='<?=date('d');?>'; //당일

				var pFirstDt =  '<?=date("Y-m-d", mktime(0, 0, 0, intval(date('m'))-1, 1, intval(date('Y'))))?>'; //지난달 월
				var pLastDt = '<?=date("Y-m-d", mktime(0, 0, 0, intval(date('m')), 0, intval(date('Y'))));?>'; //지난달 말일
				var pWeekDt = '<?=date("Y-m-d", strtotime("-1 week")); ?>'; //일주일전 
				var p1MonthDt = '<?=date("Y-m-d", strtotime("-1 month")); ?>'; //한달전 
				var p2MonthDt = '<?=date("Y-m-d", strtotime("-2 month")); ?>'; //2개월전  
				var p3MonthDt = '<?=date("Y-m-d", strtotime("-3 month")); ?>'; //3개월전  
				if(dtOpt == 'tm'){
					//당월
					fD.val(year+'-'+month+'-01');
					tD.val(date);
				}
				else if(dtOpt == 'td'){
					//당일					
					fD.val(date);
					tD.val(date);
				}else if(dtOpt == 'tw'){
					//일주일전 
					fD.val(pWeekDt);
					tD.val(date);
				}else if(dtOpt == 'pm1'){
					//한달전 
					fD.val(p1MonthDt);
					tD.val(date);
				}else if(dtOpt == 'pm2'){
					//한달전 
					fD.val(p2MonthDt);
					tD.val(date);
				}else if(dtOpt == 'pm3'){
					//한달전 
					fD.val(p3MonthDt);
					tD.val(date);
				}else if(dtOpt == 'pm'){
					//전월
					fD.val(pFirstDt);
					tD.val(pLastDt);
				}else if(dtOpt == 'ty'){
					//당해년
					fD.val(year+'-01-01');
					tD.val(date);
				}else if(dtOpt == 'all'){
					//전체
					fD.val('');
					tD.val('');
				}

				if(schObj != undefined && schObj != null){
					$("#"+schObj).trigger('click');
				}
			}

			// 윗부분은 공통으로 빼야될것같은 js 
			// 여기부터 조회관련 -----------------------------------------------------

			$(document).ready(function(){
				
				$("#searchClick").click(function(){
					callList(1);
				});

				$("#excel_down").click(function(){					
					callExcel();
				});


				$("#searchClick").trigger('click');
			});
			function callExcel() {
				var f = document.frmSearch;
		 
				f.action = "<?=$PROC_BASE?>/transaction/transactionlist_xls.php";
				f.method = "post";
				f.target = "_self";
				f.submit();
				
			}

			function callList(page){
				var perPage = $("#selPer").val();
				var perArea = 5;
				var totCnt = 0;

				var $schList = $('#schList');
				var $totalCnt = $('#totalCnt');

				var params = {page:page, perPage:perPage, fromDate:$("#fromDate").val(), toDate:$("#toDate").val(), currencySel:$("#currencySel").val(), orderNo:$("#orderNo").val(), buyerName:$("#buyerName").val(), txId:$("#txId").val() };
				//, searchId:$("#searchId").val(), fromDate:$("#fromDate").val(), toDate:$("#toDate").val(), schUndSel:$("#schUndSel").val(), rankCdSel:$("#rankCdSel").val()};

				$schList.empty().append('<tr ><td colspan="11" align = "center">조회 중</td></tr>');
				$totalCnt.text('0');

				Ajax.request('<?=$PROC_BASE?>/transaction/transactionlistSearch.php', params, function(res) {
					if (!Ajax.checkResult(res)) {
						$schList.empty().append('<tr class="t-c"><td colspan="11" align="center">'+ res.err_msg +'</td></tr>');
						return;
					}
					totCnt = res.total_rows;
					$(".paging").jqueryPager({pageSize: perPage,
							   pageBlock: perArea,
							   currentPage: page,
							   pageTotal: totCnt,
							   clickEvent: 'callList'});
					
					if (totCnt == 0) {
						$schList.empty().append('<tr class="t-c"><td colspan="11" align="center">조회된 데이터가 없습니다.</td></tr>');
						return;
					}

					$totalCnt.text(totCnt);

					//직급승급일자
					var html = '';
					$.each(res.datalist, function(key, value){
						html += '<tr>';
						
						
						
						
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.mall_nm) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.paydate) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.paytime) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.krw_amt), +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.currency) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.currency_amt) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.status) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.buyer_name) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.item_name) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.order_id) +'</span></td>';						
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.cancel_nm) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.cancel_dt) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.tid) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.coin_addr) +'</span></td>';
						
						
						html += '</tr>';
					});
					$schList.html(html);

					
				});


			}


		</script>

	</head>
	<body>
	<?php includePageTop(); ?>

		    <div class="sub-contaniner">
			 <section class="sub-cont">
			     <article class="navi-cont">
				     <ul>
					     <li><a href="/mw/">HOME</a></li>
					     <li><a href="/mw/transaction/transactionlist.php">거래내역</a></li>
					     <li><a href="/mw/transaction/transactionlist.php">거래내역조회</a></li>
					 </ul>
				 </article>
				 <div class="cont-box sub-title-wrap">
				     <h3>거래내역조회<span>기간별, 통화별 각 거래내역을 상세하게 조회하실 수 있습니다.</span></h3>
				 </div>

				 <article class="search-all-wrap cont-box">
				     <form name="frmSearch">
					     <div class="search-cont search-option01">
						     <label for="기간별조회" class="option-title">기간별조회</label>
							 <div class="calendar-date">
								 <div class="icon"></div>
								 <input class="date-picker input-text" id="fromDate" name="fromDate" type="text" value="" placeholder="시작일자" readonly="readonly">
							 </div>
							 <span class="ico-wave">~</span>
							 <div class="calendar-date">
								 <div class="icon"></div>
								 <input class="date-picker input-text" id="toDate" name="toDate" type="text" value="" placeholder="종료일자" readonly="readonly">
							 </div>
							 <div class="search-btn-wrap">
								 <ul>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'td', 'searchClick');" id="">당일</button></li> 
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'tw', 'searchClick');" id="">1주일</button></li>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'pm1', 'searchClick');" id="">1개월</button></li>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'pm2', 'searchClick');" id="">2개월</button></li>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'pm3', 'searchClick');" id="">3개월</button></li>									 
								 </ul>
							 </div>
						 </div><!-- /search-option01 -->
					     <div class="search-cont search-option02">
						     <ul class="fl-left wid33">
							     <li class="">
									 <label for="통화별조회" class="option-title">통화별 조회</label>
									 <select class="search-select"  id="currencySel" name="currencySel" >
										 <option value="">전체</option>										 
										 <?php
											foreach ($mapCurrency as $k => $v) {
												echo '<option value="'. $k .'">'. $v .'</option>';
											}
										?>										
									 </select>
								 </li>
								 <li>
									 <label for="주문번호조회" class="option-title">주문번호 조회</label>
									 <input type="text" name="orderNo" id="orderNo"  value="" size="10" maxlength="" placeholder="" class="form-input">
								 </li>
								 <li>
									 <label for="구매자명조회" class="option-title">구매자명 조회</label>
									 <input type="text" name="buyerName" id="buyerName" value="" size="2" maxlength="" placeholder="" class="form-input">
								 </li>
							 </ul>
						 </div><!-- /search-option02 -->
					     <div class="search-cont search-option03">
						     <ul class="fl-left wid33">
								 <li>
									 <label for="결제번호 조회" class="option-title">결제번호 조회</label>
									 <input type="text" name="txId" id="txId"  value="" size="10" maxlength="" placeholder="" class="form-input">										 
									 
								 </li>
								 <li>
								
								 </li>
								 <li></li>
							 </ul>
						 </div><!-- /search-option03 -->
					 </form>
					 <!-- <div class="search-bottom-btn">
					     <ul>
						     <li><a href="#none" class="button bg-green">통합검색</a></li>
							 <li><a href="#none" class="button bg-sky">통합검색</a></li>
						 </ul>
					 </div> -->					 
					 <div class="search-bottom-btn">
					     <ul>
						    <!--  <li><a href="#" class="button bg-orange" id="searchClick" >통합검색</a></li>			 -->

						    <li><button type="button" class="search-btn bg-orange" id="searchClick">통합검색</button></li>			


						 </ul>
					 </div>
				 </article><!-- /search-all-wrap -->

				 <article class="paytable-wrap cont-box">
				     <div class="table-download"><a href="#" id="excel_down" name ="excel_down" alt="엑셀다운로드" title="엑셀다운로드" >엑셀다운로드</a></div>
				     <div class="paytable-cont">
					     <table summary="" class="paytable" style="width:1900px;">
						     <caption>거래내역조회</caption>
							 <colgroup>
							     <col width="4%">							     
							     <col width="5%">
							     <col width="5%">
							     <col width="5%">
							     <col width="3%">
							     <col width="3%">
							     <col width="3%">
							     <col width="3%">
							     <col width="14%">
							     <col width="7%">
							     <col width="3%">
							     <col width="7%">
							     <col width="7%">
							     <col width="15%">							     
							 </colgroup>
							 <thead>
							     <tr>
							     	 <th>쇼핑몰</th>									 
									 <th>결제일</th>
									 <th>결제시간</th>									 
									 <th>결제금액</th>
									 <th>결제화폐</th>
									 <th>화폐금액</th>
									 <th>거래상태</th>
									 <th>구매자명</th>
									 <th>상품명</th>
									 <th>쇼핑몰주문번호</th>
									 <th>취소여부</th>
									 <th>취소일시</th>
									 <th>노보페이결제번호</th>									 
									 <th>송금주소</th>
									 
								 </tr>
							 </thead>
							 <tbody id ="schList"></tbody>
						 </table>
					 </div>
					 <div class="paging-wrap">
						<ul>
							<li class="page-select">
								<dl>
									<dt>페이지표시</dt>
									<dd>
										<select id="selPer" name="selPer" class="form-selct">
											<option value="5">5</option>
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
										</select>
									</dd>
								</dl>
							</li>
							<li class="paging-area">
								<div class="paging"></div>
							</li>
							<li class="total">
								<p class="table-total">total : <span id="totalCnt">0</span>건</p>
							</li>
						</ul>
					</div>
				 </article><!-- /paytable-wrap -->

			 </section><!-- //sub-cont -->
			</div><!-- //sub-contaniner -->

			
		<?php includePageLeft() ?>
		<?php includePageRight() ?>
		<?php includePageBottom() ?>
</body>
</html>		
		