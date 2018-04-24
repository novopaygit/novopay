
	<!DOCTYPE HTML>
<html>
	<head>
		<title>[NOVOPAY]</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]>
		    <script src="/js/ie/html5shiv.js"></script>
			<script src="/js/ie/respond.min.js"></script>
		<![endif]-->
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/util.js"></script>
		<script src="/js/main.js"></script>
		<script src="/js/all.js"></script>
		<script src="/js/novowave/novowave.ajax.js"></script>
		<script src="/js/novowave/novowave.common.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<link rel="stylesheet" href="/css/common.css" />
		<link rel="stylesheet" href="/css/main.css" />
 		<link rel="stylesheet" href="/css/sub.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/css/ie9.css" />
			<link rel="stylesheet" href="/css/ie8.css" />
		<![endif]-->

		<script type="text/javascript">
			$(document).ready(function(){

				$("#info_search").click(function(){					
					alert("회원번호와 비밀번호찾기는 관리자에게 문의하세요")
					return false;
				});

				var $form = $('form[name="frmLogin"]');
				var $user_id = $('#user_id', $form);
				var $user_pw = $('#user_pw', $form);
				$form.submit(function() {
					if ($user_id.val().trim() == '') {
						alert("아이디를 입력하세요.");
						$user_id.focus();
						return false;
					} else if ($user_pw.val().trim() == '') {
						alert("비밀번호를 입력하세요.");
						$user_pw.focus();
						return false;
					}
					Ajax.request($form.attr('action'), $form.serialize(), function(res) {
						if (!Ajax.checkResult(res)) return;
						document.location.href = '<?=$LINK_BASE?>/';

					});
					return false;
				});
				$user_id.focus();
			});
		</script>


	</head>	
	<body>		
	    <div id="wrapper">
			<div class="login-wrap">
				

				    <h2><a href="/index.php"><img src="/images/top-logo.png" alt="novopay" title="NOVOPAY"></a></h2>
					 <h3 class="tt-eng">member <strong>login</strong></h3>
					 <p class="login-text">
					     NOVOPAY 관리자 페이지입니다.<br />회원번호와 비밀번호를 입력하신 후 로그인 버튼을 눌러주세요.
					 </p>
					 <div class="dot-line"></div>
					 <form name="frmLogin" id ="frmLogin" method="post" action="/proc/login/login.php">
						 <div class="loginbox-wrap">
							 <div class="loginbox">
								 <ul>
									 <li>
										 <div class="login-icon"><span class="login-icon01"></span></div>
										 <div class="login-input">
											 <input type="text" 
											 placeholder="회원번호를 입력하세요." id="user_id" name="user_id" required maxlength="40">
										 </div>
									 </li>
									 <li>
										 <div class="login-icon"><span class="login-icon02"></span></div>
										 <div class="login-input">
											 <input type="password" 
											 placeholder="비밀번호를 입력하세요." id="user_pw" name="user_pw" required maxlength="30">
										 </div>
									 </li>
								 </ul>
								 
								 <div class="login-btn">
									 
									 <button type="submit" class="bg-red" id="btnLogin"><span>로그인</span></button> 
								 </div>
							 </div>
						 </div><!-- /lgoinbox-wrap -->
					 </form>
					 <div class="dot-line"></div>
					 <div class="align-center mgb50">
						<button type="button" class="btn btn-line" id="info_search"><span>회원번호(비밀번호)찾기</span></button>
						<!-- <button type="button" class="btn btn-line mgl10"><span>비밀번호찾기</span></button> -->
					 </div>
				
			</div><!-- /login-wrap -->
		</div><!-- //wrapper -->
	</body>
	</html>
