<?php
	include "connect.php";
	
	include "function.inc.php";
	include "config.inc.php";

	echo "你好: ".$_SESSION['username']."<br>";
	echo "性别: ".$_SESSION['sex']."<br>";
                echo "年龄: ".$_SESSION['age']."<br>";


//	echo "<a href='stulogout.php'>退出</a><br>";
	echo '<br>';
	echo '<br>';

	$whr=array();
		$whr[]=(" uid={$_SESSION['uid']}") ;
	/*进行图书搜索*/
	if(isset($_GET['action']) && $_GET['action']=='ser') {
		$tmp = !empty($_POST) ? $_POST : $_GET;
		$args = "";
		//如果sid不为空
		if(!empty($tmp['uid'])) {
			$whr[] = "uid like '%{$tmp['uid']}%'";

			$args .= "&uid={$tmp['uid']}";
		}
		

		//如果math不为空，
		if(!empty($tmp['bigtype'])) {
			$whr[] = "bigtype = '{$tmp['bigtype']}'";
			$args .= "&bigtype={$tmp['bigtype']}";
		}

		//如果english不为空，
		if(!empty($tmp['smalltype'])) {
			$whr[] = "smalltype = '{$tmp['smalltype']}'";
			$args .= "&smalltype={$tmp['smalltype']}";
		}

		//如果pe不为空，
		if(!empty($tmp['watchname'])) {
			$whr[] = "watchname = '{$tmp['watchname']}'";
			$args .= "&watchname={$tmp['watchname']}";
		}
		

		if(!empty($whr)) {
			$where = " where ".implode(" and ", $whr);
		} else {
			
			$where = "";
		}
	}
		if(!empty($whr)) {
			$where = " where ".implode(" and ", $whr);
		} else {
			
			$where = "";
		}
	
	
		



	$sql = "select uid, bigtype, smalltype, watchname from tb_userwatch {$where} ";
	
	$stmt = $db -> prepare($sql);
	$stmt -> execute();

	echo "<h2>权限二：搜索学生信息：</h2>";
	echo '<form action="tealist.php?action=ser" method="post">';
	echo '按uid:<input type="text" name="uid" size=8 value="'.$tmp['uid'].'">&nbsp;&nbsp;';

	echo '按大类:<input type="text" name="bigtype" size=8  value="'.$tmp['bigtype'].'">&nbsp;&nbsp;';
	echo '按小类: <input type="text" size="8" name="smalltype"  value="'.$tmp['smalltype'].'">&nbsp;&nbsp;';
	echo '按名称 <input type="text" size="8" name="watchname"  value="'.$tmp['watchname'].'">&nbsp;&nbsp;';
	echo '<input type="submit" name="sersubmit" value="搜索">';
	echo '</form>';
	echo '<br>';
	echo '<br>';
	echo '<br>';

	echo '<table border="1" width="900">';
	echo '<tr>';
	echo '<th>&nbsp;</th>';
	//echo '<th>编号</th>';
	//echo '<th>学号</th>';
	echo '<th>uid</th>';
	echo '<th>大类</th>';
	echo '<th>小类</th>';
	echo '<th>名称</th>';
//	echo '<th>评分</th>';
	echo '</tr>';

		while(list( $uid, $bigtype,$smalltype, $watchname) = $stmt->fetch(PDO::FETCH_NUM)) {
		echo '<tr>';
		echo '<td><input type="checkbox" name="uid[]" value="'.$uid.'"></td>';
		echo '<td>'.$uid.'</td>';
	//	echo '<td>'.$sid.'</td>';
	//	echo '<td>'.$tid.'</td>';
		echo '<td>'.$bigtype.'</td>';
		echo '<td>'.$smalltype.'</td>';
		echo '<td>'.$watchname.'</td>';
		
	}
	

	echo '</table>';
	echo '</form>';

     echo '<a href="index.php">退出</a><br>';

	include "footer.php";
