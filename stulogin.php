<?php
	


	//处理登录

if(isset($_POST['dosubmit'])) {
	

		include "connect.php";
		//到数据查找用户输入的是否正确
		
		$sql = "select sid, username ,password from stuuser where username =? and password = ?";
		$stmt = $db -> prepare($sql);
		$stmt -> execute(array($_POST['username'], $_POST['password']));

		

		if($stmt->rowCount() > 0) {

			//将用户信息一次性放到session中
			$_SESSION=$stmt->fetch(PDO::FETCH_ASSOC);	

			//加登录标记
			$_SESSION['isLogin']=1;
			
			header("Location:stulist.php");
		}else {
			echo "登录失败!<br>";
		}

	}

?>

<form action="stulogin.php" method="post">
	用户名: <input type="text" name="username" value="" /><br>
	密码: <input type="password" name="password" value="" /><br>

	<input type="submit" name="dosubmit" value="提交"> <br>
</form>
<a href="index.php">返回</a><br>