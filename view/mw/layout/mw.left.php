
			<div id="sidebar">
			    <div class="inner" <?php if ($_SESSION['left_menu'] != 'transaction') echo ' style="display: none;";' ?> >
				    <nav id="menu"  >
					    <h2 class="sidebar-title">거래내역</h2>
						<ul>
						    <li><a href="/mw/transaction/transactionlist.php">거래내역조회</a></li>
							<li><a href="/mw/transaction/transactionlist_cancel.php">취소거래조회</a></li>
							<li><a href="/mw/transaction/calculatelist.php">정산내역조회</a></li>
						</ul>
					</nav>

					
					
					
				</div>
				<?php 
				 
				 $leftMenuhtml ='<div class="inner"  >
				    <nav id="menu" >
					    <h2 class="sidebar-title">정산관리</h2>
						<ul>
						    <li><a href="/mw/calculate/calculate_reg.php">정산등록</a></li>						    
						    <li><a href="/mw/calculate/calculate_cancel.php">정산조회및삭제</a></li>
							
						</ul>
					</nav>';

				if ($_SESSION['left_menu'] == 'calculate' and $_SESSION['isadmin'] == 'Y') echo $leftMenuhtml;

				?>	
					
				</div>
			</div><!-- //sidebar -->