<?php
	include "connect.php";
	

	echo "你好: ".$_SESSION['username']." <a href='stulogout.php'>退出</a><br>";

	$stmt = $db -> prepare("select sid, tid,math,english,pe from score where sid=?");

	$stmt -> execute(array($_SESSION['sid']));

	echo "你的成绩信息如下：<br>";
	echo '<table>';
	echo '<tr><th>学号</th><th> 教师工号</th><th>高等数学</th><th>大学英语</th><th>体  育</th></tr>';
	while(list($sid, $tid, $math,$english,$pe) = $stmt->fetch(PDO::FETCH_NUM) ) {
		echo '<tr>';
		echo '<td>'.$sid.'</td>';
		echo '<td>'.$tid.'</td>';
		echo '<td>'.$math.'</td>';
		echo '<td>'.$english.'</td>';
		echo '<td>'.$pe.'</td>';
		echo '</tr>';
	}

	echo '</table>';
