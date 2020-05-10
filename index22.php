<?php
	include "connect.php";
?>
<html>
	<head>
		<title>教务系统</title>
	</head>

	<body>
		<h1>教务系统</h1>
		<a href="stulogin.php">学生登录</a> &nbsp;&nbsp;&nbsp;&nbsp;
		<a href="teachlogin.php">教师登录</a> <br><br><br>
		
<pre>
使用说明：
	
	该教务系统实现的功能是：
		1.学生登陆教务系统进行数据查询。
		2.老师登陆教务系统进行成绩录入，删除，修改，搜索等功能。
			
	注意：
		1.由于该系统将数据传入MySQL数据库，在进行使用时可以使用如下提供的测试账号：
		学生端：用户名      密码
			aaaa        aaaa
			bbbb        bbbb
			cccc        cccc
		教师端：用户名      密码
			tAAAA       tAAAA
			tBBBB       tBBBB
			tCCCC       tCCCC
		2.若要进行操作，你可以使用如下的一些测试数据：
		
		学号：目前数据库中存有1 2 3 4 5 6 这六位学生的信息
		
		教师工号：目前数据库中存有91 92 93 94 95 96 这六位教师的信息
		
		3.该系统还处于改善阶段，将持续更新。。。
		
</pre>
		
