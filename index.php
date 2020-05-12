
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

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller d-flex">
    <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo.svg" alt="logo">
              </div>
              <h4>新影--可视化分析</h4>
              <h6 class="font-weight-light">登录系统</h6>
              <form class="pt-3" action="index.php" method="post">
                <div class="form-group">
                  <input type="type" name="username" value="张三" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
	
	
                </div>
                <div class="form-group">
                  <input type="password" name="password" value="123456"  class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
	<input type="submit" name="dosubmit" value="登录" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"> <br>
                </div>
             
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->

  <!-- endinject -->
</body>

</html>

