<?php
	session_start();  //开启会话
	header('Content-Type:text/html;charset=utf-8');

	const DSN = "mysql:host=localhost;dbname=db_xinyin";
	const DBUSER = "root";
	const DBPASS = "181491117";
	
	try {
		$db = new PDO(DSN, DBUSER, DBPASS);
		//echo "登录成功<br>";
	}catch(PDOException $e) {
		echo "ERROR: ".$e->getMessage();
	}
	
	
