<li class="dropdown dropdown-rwd">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		<div><img class="accImg-small" src=<?php echo "/uploads/".$_SESSION['account'].".JPG";?>>&nbsp;<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></div>
	</a>
	<ul class="dropdown-menu">
		<li><div class="accImg-div" onclick="javascript:location.href='upload-user-img.php'">
				<img class="accImg" src=<?php echo "/uploads/".$_SESSION['account'].".JPG";?>>
				<div class="overlay"><span>更改</span></div>
			</div>
		</li>
		<li class="acc-name"><?php echo $_SESSION['account'];?></li>
		<li><input type="button" class="transparent-btn transparent-menu-input" onclick="javascript:location.href='history.php'" value="歷史紀錄"/></li>
		<li><input type="button" class="transparent-btn transparent-menu-input" onclick="javascript:location.href='exam-selection.php'" value="測驗習題"/></li>
		<li role="separator" class="divider"></li>
		<li><input type="button" class="transparent-btn transparent-menu-input" onclick="javascript:location.href='modify.php'" value="個人資料"/></li>
		<li><input type="button" class="transparent-btn transparent-menu-input" onclick="javascript:location.href='manual.php'" value="操作說明"/></li>
		<li><input type="button" class="transparent-btn transparent-menu-input" onclick="javascript:location.href='php/logout.php'" value="登出"/></li>
	</ul>
</li>