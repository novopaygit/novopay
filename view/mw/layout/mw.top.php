		<div id="wrapper">
		    <div class="header">
			    <h3><a href="/index.php"><img src="/images/top-logo.png" alt="novopay" title="NOVOPAY"></a></h3>
				<div class="gnb-wrap">
					<ul id="top-gnb">
						<li><a href="/mw/transaction/transactionlist.php">거래내역</a>
							<ul class="sub-first">
								<li><a href="/mw/transaction/transactionlist.php">거래내역조회</a></li>
								<li><a href="/mw/transaction/transactionlist_cancel.php">취소거래조회</a></li>
								<li><a href="/mw/transaction/calculatelist.php">정산내역조회</a></li>
							</ul>
						</li>

						<?php 

							if (isset($_SESSION['isadmin'])) {
								$adminyn =$_SESSION['isadmin'];
							}else{
									$adminyn ='N';
							}

							

							$topMenuhtml = '<li><a href="/mw/calculate/calculate_reg.php">정산관리</a>
									<ul class="sub-second">
										<li><a href="/mw/calculate/calculate_reg.php">정산등록</a></li>										
										<li><a href="/mw/calculate/calculate_cancel.php">정산조회및삭제</a></li>
									</ul>
								</li>';


						if ($adminyn == 'Y') echo $topMenuhtml
						?>
					
					</ul>
				</div>
			</div><!-- //header -->