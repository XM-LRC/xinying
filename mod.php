<?php 
	include "connect.php";
	include "function.inc.php";
	include "config.inc.php";

	if(isset($_GET['action']) && $_GET['action']=="mod") {
		//判断是否有修改的动作


		//获取要修改的哪一条数据
		$sql = "select id, sid, tid, math, english, pe from score where id='{$_GET['id']}'";
		$stmt=$db->prepare($sql);
		$stmt->execute();
	
	//	$result = mysqli_query($db,$sql);
	
		if($stmt->rowCount()  > 0 ) {
			//将需要修改的数据进行赋值
			list($id, $sid, $tid, $math, $english, $pe) = $stmt->fetch(PDO::FETCH_NUM);
		}else{
			echo "没有对应的数据!<br>";
		}
	}

	//修改数据库中的数据
	if(isset($_POST['dosubmit'])) {

			//全部字段都要修改
			$sql = "update score set sid='{$_POST['sid']}', tid='{$_POST['tid']}', math='{$_POST['math']}', english='{$_POST['english']}', pe='{$_POST['pe']}' where id='{$_POST['id']}'";

		} 

		//判断是否修改成功
		$stmt=$db->prepare($sql);
		$stmt->execute();
		if($stmt->rowCount()  > 0) {
			echo "修改成功!<br>";
			
		}else{
			echo "修改失败!<br>";
		}
	
	

?>
<h3>修改成绩</h3>

<form action="mod.php?action=mod&id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
	   <input type="hidden" name="id" value="<?php echo $id ?>" />	
学号： <input type="text" name="sid" value="<?php echo $sid ?>" /> <br>
工号:    <input type="text" name="tid" value="<?php echo $tid ?>" /> <br>
高数:      <input type="text" name="math" value="<?php echo $math  ?>" /> <br>
英语：     <input type="text" name="english" value="<?php echo $english ?>" /><br>		
体育：     <input type="text" name="pe" value="<?php echo $pe  ?>" /><br> 

	<input type="submit" name="dosubmit" value="修改"><br>

</form>
<a href="tealist.php">返回教师权限界面</a><br>

<?php include "footer.php"; ?>

