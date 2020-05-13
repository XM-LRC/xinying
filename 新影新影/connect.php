<?php
	session_start();  
	header('Content-Type:text/html;charset=utf-8');
/********************此处定义连接数据库的信息****************/
	const DSN = "mysql:host=localhost;dbname=db_xinyin";
	const DBUSER = "root";
	const DBPASS = "";
/********************进行连接数据库操作****************/
	try {
		$db = new PDO(DSN, DBUSER, DBPASS);
		//echo "登录成功<br>";
	}catch(PDOException $e) {
		echo "ERROR: ".$e->getMessage();
	}
	
	
