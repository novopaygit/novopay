		<?php		
			include_once('../inc/head.php');
		?>

		    <div class="sub-contaniner">
			 <section class="sub-cont">
			     <article class="navi-cont">
				     <ul>
					     <li><a href="#none">HOME</a></li>
					     <li><a href="#none">거래내역</a></li>
					     <li><a href="#none">거래내역조회</a></li>
					 </ul>
				 </article>
				 <div class="cont-box sub-title-wrap">
				     <h3>거래내역조회<span>기간별, 통화별 각 거래내역을 상세하게 조회하실 수 있습니다.</span></h3>
				 </div>

				 <article class="search-all-wrap cont-box">
				     <form>
					     <div class="search-cont search-option01">
						     <label for="기간별조회" class="option-title">기간별조회</label>
							 <div class="calendar-date">
								 <div class="icon"></div>
								 <input class="date-picker input-text" id="datepicker" type="text" value="" placeholder="날짜를 선택해주세요.">
							 </div>
							 <span class="ico-wave">~</span>
							 <div class="calendar-date">
								 <div class="icon"></div>
								 <input class="date-picker input-text" id="datepicker" type="text" value="" placeholder="날짜를 선택해주세요.">
							 </div>
							 <div class="search-btn-wrap">
								 <ul>
									 <li><button type="button" class="search-btn" onclick="" id="">당일</button></li>
									 <li><button type="button" class="search-btn" onclick="" id="">1주일</button></li>
									 <li><button type="button" class="search-btn" onclick="" id="">1개월</button></li>
									 <li><button type="button" class="search-btn" onclick="" id="">2개월</button></li>
									 <li><button type="button" class="search-btn" onclick="" id="">3개월</button></li>
								 </ul>
							 </div>
						 </div><!-- /search-option01 -->
					     <div class="search-cont search-option02">
						     <ul class="fl-left wid33">
							     <li class="">
									 <label for="통화별조회" class="option-title">통화별 조회</label>
									 <select class="search-select">
										 <option value="모두">모두</option>
										 <option value="통화1">통화1</option>
										 <option value="통화2">통화2</option>
										 <option value="통화3">통화3</option>
										 <option value="통화4">통화4</option>
									 </select>
								 </li>
								 <li>
									 <label for="주문번호조회" class="option-title">주문번호 조회</label>
									 <select class="search-select">
										 <option value="모두">모두</option>
										 <option value="주문번호1">주문번호1</option>
										 <option value="주문번호2">주문번호2</option>
										 <option value="주문번호3">주문번호3</option>
										 <option value="주문번호4">주문번호4</option>
									 </select>
								 </li>
								 <li>
									 <label for="구매자명조회" class="option-title">구매자명 조회</label>
									 <select class="search-select">
										 <option value="구매자명">구매자명</option>
										 <option value="구매자명">구매자명</option>
										 <option value="구매자명">구매자명</option>
									 </select>
								 </li>
							 </ul>
						 </div><!-- /search-option02 -->
					     <div class="search-cont search-option03">
						     <ul class="fl-left wid33">
								 <li>
									 <label for="거래번호 조회" class="option-title">거래번호 조회</label>
									 <select class="search-select">
										 <option value="거래번호">거래번호</option>
										 <option value="거래번호">거래번호</option>
										 <option value="거래번호">거래번호</option>
									 </select>
								 </li>
								 <li>
									 <label for="계좌별 조회" class="option-title">계좌별 조회</label>
									 <select class="search-select">
										 <option value="계좌">계좌</option>
										 <option value="계좌">계좌</option>
										 <option value="계좌">계좌</option>
									 </select>
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
						     <li><a href="#none" class="button bg-orange">통합검색</a></li>
						 </ul>
					 </div>
				 </article><!-- /search-all-wrap -->

				 <article class="paytable-wrap cont-box">
				     <div class="table-download"><a href="#none" alt="엑셀다운로드" title="엑셀다운로드">엑셀다운로드</a></div>
				     <div class="paytable-cont">
					     <table summary="" class="paytable">
						     <caption>거래내역조회</caption>
							 <colgroup>
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							     <col width="10%">
							 </colgroup>
							 <thead>
							     <tr>
									 <th>결제일</th>
									 <th>결제시간</th>
									 <th>취소일</th>
									 <th>취소시간</th>
									 <th>결제금액</th>
									 <th>결제화폐</th>
									 <th>화폐금액</th>
									 <th>거래상태</th>
									 <th>구매자명</th>
									 <th>상품명</th>
									 <th>주문번호</th>
									 <th>TXID</th>
									 <th>거래번호</th>
									 <th>송금주소</th>
									 <th>송금주소 태그</th>
								 </tr>
							 </thead>
							 <tbody>
							     <tr class="td-center">
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								     <td>내용</td>
								 </tr>
							 </tbody>
						 </table>
					 </div>
				 </article><!-- /paytable-wrap -->

			 </section><!-- //sub-cont -->
			</div><!-- //sub-contaniner -->


		<?php include_once('../inc/left.php');?>
		<?php include_once('../inc/right.php');?>
		<?php include_once('../inc/footer.php');?>