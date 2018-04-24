			<div class="right-quick">
			    <div class="inner">
				    <div class="right-btn">
				    	<?php if (Auth::isLogin() == true) { ?>
					    <button type="button" class="normal-blue" onclick="location.href='/mw/login/logout.php';"><span>로그아웃</span></button>					    
						<button type="button" class="normal-blue" onclick="location.href='/mw/login/myinfoupt.php';"><span>정보수정</span></button>
						<?php } else { ?>
						<button type="button" class="normal-blue" onclick="location.href='/mw/login/login.php';"><span>로그인</span></button>					    
						<?php }  ?>
					</div>
					<!-- <div class="right-box-btn">
					    <ul>
						    <li><a href="#none" class="bg-orange">부가서비스배너1</a></li>
						    <li><a href="#none" class="bg-green">부가서비스배너2</a></li>
						    <li><a href="#none" class="bg-yellow">부가서비스배너3</a></li>
						</ul>
					</div> -->
				</div>
			</div>
			<!-- //right-quick -->