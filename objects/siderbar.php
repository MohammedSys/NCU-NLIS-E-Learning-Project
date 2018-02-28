<div id="side-menu-main">
	<ul class="sidebar-nav">
		<!--<li class="sidebar-brand sidebar-b-home"><a href="main.php">首頁<span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>-->
		<li class="sidebar-brand">系統功能<span class="glyphicon glyphicon-cog" aria-hidden="true"></span></li>
		<li><a href="main.php">首頁</a></li>
		<li><a href="history.php">歷史紀錄</a></li>
		<li><a href="exam-selection.php">測驗習題</a></li>
		<li><a href="manual.php">操作說明</a></li>			
		<li class="sidebar-brand">課程列表<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></li>
		<?php
			//資料庫撈取不重複課程主題
			$msql = "SELECT DISTINCT subject FROM teachingMaterial";
			$mResult = mysql_query($msql);
			while ($mSubject = mysql_fetch_row($mResult)) {
				echo "<li><div class=\"ch-title\">".$mSubject[0]."</div></li>";
				$msql1 = "SELECT chapter, title FROM teachingMaterial WHERE subject = '$mSubject[0]' ORDER BY CAST(chapter AS UNSIGNED)";
				$mchapterResult = mysql_query($msql1);
				while ($mChapter = mysql_fetch_row($mchapterResult)) {
					echo "<li><form class=\"chButton-form\" method=\"post\" action=\"classroom.php\">";
					echo "<div class=\"ch\">Ch. ".$mChapter[0]."</div>";
					echo "<input class=\"chButton\" value=\"".$mChapter[1]."\" type=\"submit\" name=\"submit\"/>";
					echo "<input value=\"".$mSubject[0]."/Chapter-".$mChapter[0]."-slide.pdf\" type=\"hidden\" name=\"chapter\"/>";
					echo "</form></li>";
				}
			}
		?>
	</ul>
</div>