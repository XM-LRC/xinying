
<?php
	
	//处理登录

if(isset($_POST['dosubmit'])) {
	

		include "connect.php";
		//到数据查找用户输入的是否正确
		
		echo "你好: ".$_SESSION['username']." <a href='stulogout.php'><br>退出</a><br>";
		
		$sql = "select * from tb_userinfor where username =? and password = ?";
		$stmt = $db -> prepare($sql);
		$stmt -> execute(array($_POST['username'], $_POST['password']));

		

		if($stmt->rowCount() > 0) {

			//将用户信息一次性放到session中
			$_SESSION=$stmt->fetch(PDO::FETCH_ASSOC);	

			//加登录标记
			$_SESSION['isLogin']=1;
			
			header("Location:userinfor.php");
		}else {
			echo "登录失败!<br>";
		}

	}

?>


<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								
								<p class="lead">登录到您的账号</p>
							</div>
							<form class="form-auth-small" action="login.php" method="post">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">用户名</label>
								<input type="type" name="username" class="form-control" id="signin-email" value="" placeholder="用户名">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">密码</label>
									<input type="password" name="password" value=""  class="form-control" id="signin-password" value="" placeholder="密码">
								</div>
								<div class="form-group clearfix">
									
								</div>
								<button type="submit" name="dosubmit" value="登录" class="btn btn-primary btn-lg btn-block">登录</button>
								
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">欢迎使用以下测试样例</h1>
							<div>用户名：张三      </div><div>   密码：123456</div>
							
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
