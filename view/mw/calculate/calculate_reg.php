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
				var pDay = '<?=date("Y-m-d", strtotime("-1 day")); ?>'; //전일
				var p3Day = '<?=date("Y-m-d", strtotime("-3 day")); ?>'; //전3일
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
					fD.val(p3Day);
					tD.val(pDay);
				}else if(dtOpt == 'tw'){
					//일주일전 
					fD.val(pWeekDt);
					tD.val(pDay);
				}else if(dtOpt == 'pm1'){
					//한달전 
					fD.val(p1MonthDt);
					tD.val(pDay);
				}else if(dtOpt == 'pm2'){
					//한달전 
					fD.val(p2MonthDt);
					tD.val(pDay);
				}else if(dtOpt == 'pm3'){
					//한달전 
					fD.val(p3MonthDt);
					tD.val(pDay);
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
		 
				f.action = "<?=$PROC_BASE?>/calculate/calculate_reg_xls.php";
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

				var params = {page:page, perPage:perPage, fromDate:$("#fromDate").val(), toDate:$("#toDate").val(), mallnm:$("#mallnm").val() };
				

				$schList.empty().append('<tr ><td colspan="8" align = "center">조회 중</td></tr>');
				$totalCnt.text('0');

				Ajax.request('<?=$PROC_BASE?>/calculate/calculate_reg_search.php', params, function(res) {
					if (!Ajax.checkResult(res)) {
						$schList.empty().append('<tr class="t-c"><td colspan="8" align="center">'+ res.err_msg +'</td></tr>');
						return;
					}
					totCnt = res.total_rows;
					$(".paging").jqueryPager({pageSize: perPage,
							   pageBlock: perArea,
							   currentPage: page,
							   pageTotal: totCnt,
							   clickEvent: 'callList'});

					if (totCnt == 0) {
						$schList.empty().append('<tr class="t-c"><td colspan="8" align="center">조회된 데이터가 없습니다.</td></tr>');
						return;
					}

					$totalCnt.text(totCnt);

					
					var html = '';
					var i = 1;
					$.each(res.datalist, function(key, value){
						html += '<tr>';
						
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.mall_id) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.mall_nm) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.cal_fromdt)+' ~ ' + echoNull2Blank(value.cal_todt)+'</span></td>';

						html += '<td class="t-c"><span>'+ echoNull2Blank(value.commission_rate) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.amount) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.calculate_amount), +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.commission_amount) +'</span></td>';
						html += '<td class="t-c"><button type="button" class="search-btn" id="" onclick ="calculatemall(\''+ echoNull2Blank(value.mall_id) +'\',\''+ echoNull2Blank(value.cal_fromdt) +'\',\''+ echoNull2Blank(value.cal_todt) +'\',\''+ echoNull2Blank(value.calculate_amount) +'\')";>정산등록</button></td>';
						
						
						
						html += '</tr>';
						i = i + 1; 
					});
					$schList.html(html);

					
				});



			}

			function calculatemall(mallid,fromdt,todt,calamt){
				str = mallid + '/' + fromdt + '/' + todt + '/' + calamt;
				calamtnum = uncommaNumber(calamt);
				if (calamtnum == 0){
					alert("정산할 금액이 존재하지않습니다. 기간을 다르게 입력하거나 재조회 후 다시 시도하세요 ");
					return false;
				}

				if(!confirm("정산등록(정산금액 : "+ calamt+"월)을 진행하시겠습니까?")){
					return false;
				}
				//calamtnum = uncommaNumber(calamt);
				

				
				if (mallid == '' || fromdt == '' || todt =='') {
					alert('정산을 위해서는 정산기간을 반드시 선택하시고 정산등록을 하셔야됩니다. ');				
					return false;
				}


				
				var params = {mallid:mallid, fromdt:fromdt,  todt:todt,calamtnum:calamtnum  };



				Ajax.request('<?=$PROC_BASE?>/calculate/calculate_reg_insert.php', params, function(res) {				
					if (!Ajax.checkResult(res)) {
						//alert(res.err_msg);
						return;
					}
					if (echoNull2Blank(res.result_cd) == '9000' ){
						alert('저장에 실패하였습니다.');
						return;
					}
					if (echoNull2Blank(res.result_cd) == '9001' ){
						alert('조회시 계산된 정산 금액과 저장후의 정산금액이 차이가 발생하였습니다. 다시 조회 후 등록해보시기바랍니다.');
						return;
					}

					//res.datalist
					if (echoNull2Blank(res.calculate_amount) == '0' ){
						alert('정산등록할 금액이 존재하지않습니다. 다시조회하여 확인하시기바랍니다. ');
						return;
					}
					alert("testmall 에대한 정산등록(정산금액: " + echoNull2Blank(res.calculate_amount) + ") 이 등록 완료되었습니다. 등록내역은 정산조회및삭제 메뉴에서 확인하세요");
					$("#searchClick").trigger('click');

					
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
					     <li><a href="/mw/calculate/calculate_reg.php">정산관리</a></li>
					     <li><a href="/mw/calculate/calculate_reg.php">정산등록</a></li>
					 </ul>
				 </article>
				 <div class="cont-box sub-title-wrap">
				     <h3>정산등록<span>기간별 미정산내역을 조회하여 정산등록을 할 수 있습니다. </span></h3>
				 </div>

				 <article class="search-all-wrap cont-box">
				     <form name="frmSearch">
					     <div class="search-cont search-option01">
						     <label for="기간별조회" class="option-title">정산기간</label>
							 <div class="calendar-date">
								 <div class="icon"></div>
								 <input class="date-picker input-text" id="fromDate" name="fromDate" type="text" value="<?=date("Y-m-d", strtotime("-3 day")); ?>" placeholder="시작일자" readonly="readonly">
							 </div>
							 <span class="ico-wave">~</span>
							 <div class="calendar-date">
								 <div class="icon"></div>
								 <input class="date-picker input-text" id="toDate" name="toDate" type="text" value="<?=date("Y-m-d", strtotime("-1 day")); ?>" placeholder="종료일자" readonly="readonly">
							 </div>
							 <div class="search-btn-wrap">
								 <ul>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'td', 'searchClick');" id="">전3일</button></li> 
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'tw', 'searchClick');" id="">1주일</button></li>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'pm1', 'searchClick');" id="">1개월</button></li>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'pm2', 'searchClick');" id="">2개월</button></li>
									 <li><button type="button" class="search-btn" onclick="changeDate('fromDate', 'toDate', 'pm3', 'searchClick');" id="">3개월</button></li>									 
								 </ul>
							 </div>
						 </div><!-- /search-option01 -->
					    
					     <div class="search-cont search-option03">
						     <ul class="fl-left wid33">
								 <li>
									 <label for="쇼핑몰명조회" class="option-title">쇼핑몰명조회</label>
									 <input type="text" name="mallnm" id="mallnm"  value="" size="10" maxlength="" placeholder="" class="form-input">										 
									 
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

						    <li><button type="button" class="search-btn bg-orange" id="searchClick">정산대상조회</button></li>			


						 </ul>
					 </div>
				 </article><!-- /search-all-wrap -->

				 <article class="paytable-wrap cont-box">
				     <!-- <div class="table-download"><a href="#" id="excel_down" name ="excel_down" alt="엑셀다운로드" title="엑셀다운로드" >엑셀다운로드</a></div> -->
				     <div class="paytable-cont" style="overflow-x:hidden;">
					     <table class="paytable" style="width:940px;">
						     <caption>거래내역조회</caption>
							 <colgroup>
							 	 <col width="8">
							     <col width="8">
							     <col width="15">
							     <col width="6">
							     <col width="9">
							     <col width="9">
							     <col width="9">
							     <col width="9">
							     
							 </colgroup>
							 <thead>
							     <tr>
							     	 <th>쇼핑몰아이디</th>									 
							     	 <th>쇼핑몰</th>
							     	 <th>정산기간</th>							     	 
									 <th>수수료율</th>
									 <th>결제금액</th>									 
									 <th>정산대상금액</th>
									 <th>수수료</th>
									 <th>등록</th>
									 
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
		