<!DOCTYPE HTML>
<html>
	<head>
	<?php includePageHeader();	?>
	<script type="text/javascript">
		 $(document).ready(function(){
		
		$("#saveOk").click(function(){

			var $form = $('form[name="frmData"]');
			//alert('check');

			//if (!Form.checkFormValid($form)) return false;
			//
			if ($("#old_pwd").val().trim() == "") {
				alert('정보를 수정하시려면 현재비밀번호르 넣어주세요');
				$("#webPwConf").focus();
				return false;
			}

			var params = $form.serialize();			
			Ajax.request('<?=$PROC_BASE?>/login/myinfoupdate.php', params, function(res) {
				
				
				if (!Ajax.checkResult(res)) {
					return;
				}
				
				// 성공 후처리				
				if(res.retCode == '0000'){
					alert('정상적으로 수정되었습니다.');
					
				
				}else{					
					alert('저장에 실패했습니다.');
				}
			});


			/*if ($("#webPw").val().trim() != $("#webPwConf").val().trim()) {
				alert('입력하신 비밀번호가 다릅니다 다시 입력하세요.');
				$("#webPwConf").focus();
				return false;
			}

			if ($('#email1').val().trim() && $('#email2').val().trim()) {
				var email = $('#email1').val().trim() +'@'+ $('#email2').val().trim();
				if (!Valid.checkEmail(email)) {
					alert('이메일 주소가 유효하지 않습니다.');
					$('#email1').focus();
					return false;
				}
			}

			var params = $form.serialize();
			Ajax.request('<?=$PROC_BASE?>/membMng/membUndJoin.php', params, function(res) {
				if (!Ajax.checkResult(res)) return;
				// 성공 후처리
				//alert('keyValue::'+res.keyValue+" retCode::"+res.retCode+" retStr::"+res.retStr);
				if(res.keyValue != null && res.retCode == '0'){
					//회원가입완료 후 회원번호가 리턴되어 왔을 경우 가입완료페이지 이동
					$("#userId").val(res.keyValue);
					$form.submit();
				}else{
					alert(rec.retStr);
				}
			});*/

			//return false;
		});

		
	});


	</script>

	</head>
	<body>
	<?php includePageTop(); ?>

		    <div class="sub-contaniner">
			 <section class="sub-cont"> 
			     <!-- 사용자 정보변경 -->
			     <article class="navi-cont">
				     <ul>
					     <li><a href="/mw">HOME</a></li>
					     <!-- <li><a href="#none">고객정보</a></li> -->
					     <li><a href="/mw/login/myinfoupt.php">사용자 정보변경</a></li>
					 </ul>
				 </article>
				 <div class="cont-box sub-title-wrap">
				     <h3>사용자 정보변경<span>사용자 정보변경에 대한 내용을 넣어주세요.</span></h3>
				 </div>
			     <article class="form-cont-wrap cont-box">
				     <form name="frmData" action="post" method="myinfoupt.php">
						 <fieldset class="">
							 <legend>사용자 정보변경</legend>
							
							 <ul class="fl-left wid50 mgt10">
							     <li>
									 <label class="option-title">쇼핑몰아이디</label>
									 <input type="text" name="mall_idreadonly" id ="mall_idreadonly" value="<?=$_SESSION['mall_id']?>" class="form-input" disabled readonly="true" >
									  <input type="hidden" name="mall_id" id ="mall_id" value="<?=$_SESSION['mall_id']?>" class="form-input">
								 </li>
							     <li class="posR">
									 <label class="option-title">쇼핑몰명칭</label>									 
									 <input type="email" name="" value="<?=$mallUserInfo['mall_nm']?>" size="" maxlength="" class="form-input" disabled readonly="true">
								 </li>
							 </ul>

							 <ul class="fl-left wid50 mgt10">
							     <li>
									 <label class="option-title">관리자명</label>
									 <input type="text" name="user_nm" id ="user_nm" value="<?=$mallUserInfo['user_nm']?>" size="" maxlength="" placeholder="" class="form-input">
								 </li>
							     <li>
									 <label class="option-title">이메일</label>
									 <input type="email" name="user_email" id ="user_email" value="<?=$mallUserInfo['user_email']?>" size="" maxlength="" placeholder="" class="form-input">
								 </li>
							 </ul>

							 <ul class="fl-left wid50 mgt10">

							 	<li>
									 <label class="option-title">현재비밀번호</label>
									 <input type="password" name="old_pwd" id ="old_pwd" value="" size="" maxlength="" placeholder="" class="form-input">
									
								 </li>
							     <li>
									<label class="option-title">신규비밀번호</label>
									 <input type="password" name="new_pwd" id = "new_pwd" value="" size="" maxlength="" placeholder="" class="form-input"> 
									 
								 </li>

							 </ul>


							 <div class="field-btn-wrap">
							     <a href="#" class="btn field-btn bg-orange" id="saveOk" ><span>수정하기</span></a>
							 </div>
						 </fieldset>
					 </form>
				 </article>

				 <div style="height:100px;"></div>

			    

			 </section><!-- //sub-cont -->
			</div><!-- //sub-contaniner -->


		<?php includePageLeft() ?>
		<?php includePageRight() ?>
		<?php includePageBottom() ?>
</body>
</html>		
		