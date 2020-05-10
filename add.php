<?php 
	include "connect.php";

	if(isset($_POST['dosubmit'])) {

	$query="insert into score (sid,tid,math ,english ,pe) values (?,?,?,?,?)";
	$stmt=$db->prepare($query);
	$stmt->execute(array($_POST['sid'], $_POST['tid'],$_POST['math'], $_POST['english'],$_POST['pe']));

		if($stmt->rowCount() > 0) {
				echo "添加数据成功<br>";
		} 
		else {
				echo "添加失败<br>";
			}
	
	}

?>
<h2>权限一：添加成绩</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
学生学号： <input type="text" name="sid" value="" /> <br>
教师工号： <input type="text" name="tid" value="" /> <br>
高等数学： <input type="text" name="math" value="" /> <br>
大学英语:    <input type="text" name="english" value="" /> <br>
体  育:      <input type="text" name="pe" value="" /> <br>
	<input type="submit" name="dosubmit" value="添加"><br>

</form>


