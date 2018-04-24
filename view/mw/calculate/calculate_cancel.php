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
		 
				f.action = "<?=$PROC_BASE?>/calculate/calculate_cancel_xls.php";
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

				var params = {page:page, perPage:perPage, fromDate:$("#fromDate").val(), toDate:$("#toDate").val(), mallnm:$("#mallnm").val(), calno:$("#cal_no").val() };
				

				$schList.empty().append('<tr ><td colspan="11" align = "center">조회 중</td></tr>');
				$totalCnt.text('0');

				Ajax.request('<?=$PROC_BASE?>/calculate/calculate_cancel_search.php', params, function(res) {
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

					
					var html = '';
					var i = 1;
					$.each(res.datalist, function(key, value){
						html += '<tr>';
						
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.mall_nm) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.cal_no) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.cal_dt) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.cal_time) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.cal_fromdt)+' ~ ' + echoNull2Blank(value.cal_todt)+'</span></td>';
						
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.amount) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.calculate_amount), +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.commission_amount) +'</span></td>';
						html += '<td class="t-c"><span>'+ echoNull2Blank(value.commission_rate) +'</span></td>';
						html += '<td class="t-c"><button type="button" class="search-btn" id="" onclick ="calcalcelmall(\''+ echoNull2Blank(value.mall_id) +'\',\''+ echoNull2Blank(value.cal_no) +'\')";>정산삭제</button></td>';
						html += '<td class="t-c"><button type="button" class="search-btn" id="" onclick ="caldetail(\''+ echoNull2Blank(value.mall_id) +'\',\''+ echoNull2Blank(value.cal_no) +'\')";>보기</button></td>';
						
						
						
						html += '</tr>';
						i = i + 1; 
					});
					$schList.html(html);

					
				});



			}

			function calcalcelmall(mallid,calno){
				str = mallid + '/' + calno;
				if(!confirm("정산내역(정산번호 : "+ calno+")을 삭제하시겠습니까?")){
					return false;
				}

				

				if (mallid == '' || calno == '' ) {
					alert('삭제할 내역이 정확히 선택되지않았습니다. 다시조회하여 시도해주세요');				
					return false;
				}


				
				var params = {mallid:mallid, calno:calno };



				Ajax.request('<?=$PROC_BASE?>/calculate/calculate_cancel_update.php', params, function(res) {				
					if (!Ajax.checkResult(res)) {
						//alert(res.err_msg);
						return;
					}
					//res.datalist
					if (echoNull2Blank(res.calculate_amount) == '0' ){
						alert('정산등록할 금액이 존재하지않습니다. 다시조회하여 확인하시기바랍니다. ');
						return;
					}
					alert("등록내역 (정산번호 : " + echoNull2Blank(res.cal_no) + ")이 삭제되었습니다. ");
					$("#searchClick").trigger('click');

					
				});



			}

			function caldetail(mallid,calno){


				str = mallid + '/' + calno;
				topvar = 300;//;event.clientY- 220; //100;
				leftvar = 400;//event.clientX - 460;// 300;

				window.open('<?=$LINK_BASE?>/calculate/calculate_detail_popup.php?calno='+calno,'정산내역상세보기','width=940, height=400, scrollbars=yes,top = ' + topvar + ', left = ' +leftvar  );
				



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
					     <li><a href="/mw/calculate/calculate_cancel.php">정산조회및삭제</a></li>
					 </ul>
				 </article>
				 <div class="cont-box sub-title-wrap">
				     <h3>정산조회및삭제<span>기간별 정산등록 내역을 조회 및 삭제 할 수 있습니다. </span></h3>
				 </div>

				 <article class="search-all-wrap cont-box">
				     <form name="frmSearch">
					     <div class="search-cont search-option01">
						     <label for="기간별조회" class="option-title">정산일자</label>
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
					    
					     <div class="search-cont search-option03">
						     <ul class="fl-left wid33">
								 <li>
									 <label for="쇼핑몰명조회" class="option-title">쇼핑몰명조회</label>
									 <input type="text" name="mallnm" id="mallnm"  value="" size="10" maxlength="" placeholder="" class="form-input">										 
									 
								 </li>
								 <li>
									<label for="쇼핑몰명조회" class="option-title">정산번호</label>
									 <input type="text" name="cal_no" id="cal_no"  value="" size="10" maxlength="" placeholder="" class="form-input">										 
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

						    <li><button type="button" class="search-btn bg-orange" id="searchClick">정산내역조회</button></li>			


						 </ul>
					 </div>
				 </article><!-- /search-all-wrap -->

				 <article class="paytable-wrap cont-box">
				     <div class="table-download"><a href="#" id="excel_down" name ="excel_down" alt="엑셀다운로드" title="엑셀다운로드" >엑셀다운로드</a></div>
				     <div class="paytable-cont" style="overflow-x:hidden;">
					     <table class="paytable" style="width:940px;">
						     <caption>거래내역조회</caption>
							 <colgroup>							 	 
							     <col width="5">
							     <col width="10">
							     <col width="7">
							     <col width="5">
							     <col width="14">
							     <col width="9">
							     <col width="8">
							     <col width="8">
							     <col width="5">
							     <col width="6">
							     <col width="6">
							     
							 </colgroup>
							 <thead>
							     <tr>
							     	 <th>쇼핑몰</th>
							     	 <th>정산번호</th>
							     	 <th>정산일자</th>
							     	 <th>등록시간</th>
									 <th>등록시 산정된 정산기간</th>									 
									 <th>결제금액</th>									 
									 <th>정산금액</th>
									 <th>수수료</th>
									 <th>수수료율</th>
									 <th>삭제</th>
									 <th>상세내역</th>
									 
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
		
