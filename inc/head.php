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

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/css/common.css" />
		<link rel="stylesheet" href="/css/main.css" />
		<link rel="stylesheet" href="/css/sub.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/css/ie9.css" />
			<link rel="stylesheet" href="/css/ie8.css" />
		<![endif]-->

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

				if(dtOpt == 'tm'){
					//당월
					fD.val(year+'-'+month+'-01');
					tD.val(date);
				}
				else if(dtOpt == 'td'){
					//당일					
					fD.val(date);
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

		</script>

	</head>
	<body>
	    <div id="wrapper">
		    <div class="header">
			    <h3><a href="/index.php"><img src="/images/top-logo.png" alt="novopay" title="NOVOPAY"></a></h3>
				<div class="gnb-wrap">
					<ul id="top-gnb">
						<li><a href="/mw/transaction/transactionlist.php">거래내역</a>
							<ul class="sub-first">
								<li><a href="/mw/transaction/transactionlist.php">거래내역조회</a></li>
								<li><a href="#none">실패거래조회</a></li>
								<li><a href="#none">취소거래조회</a></li>
							</ul>
						</li>
						<li><a href="#none">정산내역</a>
							<ul class="sub-second">
								<li><a href="#none">submenu2</a></li>
								<li><a href="#none">submenu2</a></li>
								<li><a href="#none">submenu2</a></li>
								<li><a href="#none">submenu2</a></li>
								<li><a href="#none">submenu2</a></li>
								<li><a href="#none">submenu2</a></li>
							</ul>
						</li>
						<li><a href="#">고객정보</a>
							<ul class="sub-third">
								<li><a href="#none">submenu3</a></li>
								<li><a href="#none">submenu3</a></li>
								<li><a href="#none">submenu3</a></li>
								<li><a href="#none">submenu3</a></li>
								<li><a href="#none">submenu3</a></li>
							</ul>			
						</li>
						<li><a href="#">oneDepth04</a>
							<ul class="sub-fourth">
								<li><a href="#none">submenu4</a></li>
								<li><a href="#none">submenu4</a></li>
								<li><a href="#none">submenu4</a></li>
								<li><a href="#none">submenu4</a></li>
								<li><a href="#none">submenu4</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- //header -->