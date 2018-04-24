		<?php
			include_once('../inc/head.php');
		?>

		    <div class="sub-contaniner">
			 <section class="sub-cont"> 
			     <!-- 사용자 정보변경 -->
			     <article class="navi-cont">
				     <ul>
					     <li><a href="#none">HOME</a></li>
					     <li><a href="#none">고객정보</a></li>
					     <li><a href="#none">사용자 정보변경</a></li>
					 </ul>
				 </article>
				 <div class="cont-box sub-title-wrap">
				     <h3>사용자 정보변경<span>사용자 정보변경에 대한 내용을 넣어주세요.</span></h3>
				 </div>
			     <article class="form-cont-wrap cont-box">
				     <form action="" method="">
						 <fieldset class="">
							 <legend>사용자 정보변경</legend>
							 <ul class="fl-left wid50 mgt10">
							     <li>
									 <label class="option-title">아이디</label>
									 <input type="text" name="" value="" size="" maxlength="" placeholder="아이디를 입력하세요." class="form-input" autofocus required>
								 </li>
							     <li>
									 <label class="option-title">비밀번호</label>
									 <input type="password" name="" value="" size="" maxlength="" placeholder="" class="form-input">
								 </li>
							 </ul>

							 <ul class="fl-left wid50 mgt10">
							     <li>
									 <label class="option-title">아이디</label>
									 <input type="text" name="" value="NOVOWAVE" class="form-input" disabled readonly="true">
								 </li>
							     <li class="posR">
									 <label class="option-title">비밀번호</label>
									 <input type="password" name="" value="" size="" maxlength="" placeholder="" class="form-input">
									 <input type="submit" class="btn form-submit bg-blue01" value="비밀번호변경">
								 </li>
							 </ul>

							 <ul class="fl-left wid50 mgt10">
							     <li>
									 <label class="option-title">사용자명</label>
									 <input type="text" name="" value="" size="" maxlength="" placeholder="" class="form-input">
								 </li>
							     <li>
									 <label class="option-title">이메일</label>
									 <input type="email" name="" value="" size="" maxlength="" placeholder="e-mail" class="form-input">
								 </li>
							 </ul>

							 <div class="field-btn-wrap">
							     <a href="#none" class="btn field-btn bg-orange"><span>수정하기</span></a>
							 </div>
						 </fieldset>
					 </form>
				 </article>

				 <div style="height:100px;"></div>

			     <!-- 가맹점 정산내역 -->
			     <article class="navi-cont">
				     <ul>
					     <li><a href="#none">HOME</a></li>
					     <li><a href="#none">정산내역</a></li>
					     <li><a href="#none">가맹점 정산내역</a></li>
					 </ul>
				 </article>
				 <div class="cont-box sub-title-wrap">
				     <h3>가맹점 정산내역<span>가맹점 정산내역에 대한 내용을 넣어주세요.</span></h3>
				 </div>
			     <article class="form-cont-wrap cont-box">
				     <form action="" method="">
						 <fieldset class="">
							 <legend>가맹점 정산내역</legend>
							 <div class="form-cont-01">
							     <label class="option-title">가맹점번호</label>
								 <select class="form-select">
								     <option>옵션을 선택해주세요.</option>
								     <option>옵션을 선택해주세요1.</option>
								     <option>옵션을 선택해주세요2.</option>
								 </select>
							 </div>
							 <div class="search-cont mgt10">
								 <label for="기간별조회" class="option-title">조회기간</label>
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
							 </div><!-- /search-cont -->

							 <ul class="fl-left mgt10">
							     <li><span class="option-title">조회기간</span></li>
							     <li>
								     <div class="form-inner">
										 <input type="radio" name="" value="" size="" id="send-date" maxlength="" placeholder="" class="form-radio" checked>
										 <label class="inner-label" for="send-daate">지급일</label>
									 </div>
								 </li>
							     <li class="mgl20">
								     <div class="form-inner">
										 <input type="radio" name="" value="" id="last-date" size="" maxlength="" placeholder="" class="form-radio">
										 <label class="inner-label" for="last-date">마감일</label>
									 </div>
								 </li>
							 </ul>

							 <ul class="fl-left mgt10">
							     <li><span class="option-title">조회기간</span></li>
							     <li>
								     <div class="form-inner">
										 <input type="checkbox" name="" value="mail01" id="mail01" size="" maxlength="" placeholder="" class="form-check" checked>
										 <label class="inner-label" for="mail01">공지메일1</label>
									 </div>
								 </li>
							     <li class="mgl20">
								     <div class="form-inner">
										 <input type="checkbox" name="" value="mail02" id="mail02" size="" maxlength="" placeholder="" class="form-check" checked>
										 <label class="inner-label" for="mail02">공지메일2</label>
									 </div>
								 </li>
							     <li class="mgl20">
								     <div class="form-inner">
										 <input type="checkbox" name="" value="mail03" id="mail03" size="" maxlength="" placeholder="" class="form-check">
										 <label class="inner-label" for="mail03">공지메일3</label>
									 </div>
								 </li>
							     <li class="mgl20">
								     <div class="form-inner">
										 <input type="checkbox" name="" value="mail04" id="mail04" size="" maxlength="" placeholder="" class="form-check">
										 <label class="inner-label" for="mail04">공지메일4</label>
									 </div>
								 </li>
							 </ul>

							 <div class="field-btn-wrap">
							     <a href="#none" class="btn field-btn bg-orange"><span>조회하기</span></a>
							 </div>
						 </fieldset>
					 </form>
				 </article>

			 </section><!-- //sub-cont -->
			</div><!-- //sub-contaniner -->


		<?php include_once('../inc/left.php');?>
		<?php include_once('../inc/right.php');?>
		<?php include_once('../inc/footer.php');?>