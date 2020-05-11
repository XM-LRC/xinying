<?php
	include "connect.php";
	include "config.inc.php";

	echo "你好: ".$_SESSION['username']."<br>";
	echo "性别: ".$_SESSION['sex']."<br>";
    echo "年龄: ".$_SESSION['age']."<br>";


	echo '<br>';
	echo '<br>';
/************************下面这一个块实现搜索：观看记录*******************************/
	$whr=array();
		$whr[]=(" uid={$_SESSION['uid']}") ;
	if(isset($_GET['action']) && $_GET['action']=='ser') {
		$tmp = !empty($_POST) ? $_POST : $_GET;
		$args = "";
		
		if(!empty($tmp['uid'])) {
			$whr[] = "uid like '%{$tmp['uid']}%'";

			$args .= "&uid={$tmp['uid']}";
		}
		

		//按照大类搜索，
		if(!empty($tmp['bigtype'])) {
			$whr[] = "bigtype = '{$tmp['bigtype']}'";
			$args .= "&bigtype={$tmp['bigtype']}";
		}

		//按照小类搜索
		if(!empty($tmp['smalltype'])) {
			$whr[] = "smalltype = '{$tmp['smalltype']}'";
			$args .= "&smalltype={$tmp['smalltype']}";
		}

		//按照影视作品搜索
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
	
/************************数据库查询*******************************/	
		

	$sql = "select uid, bigtype, smalltype, watchname from tb_userwatch {$where} ";
	$stmt = $db -> prepare($sql);
	$stmt -> execute();

	echo "<h2>搜索条件</h2>";
	echo '<form action="userinfor.php?action=ser" method="post">';
	echo '按uid:<input type="text" name="uid" size=8 value="'.$tmp['uid'].'">&nbsp;&nbsp;';

	echo '按大类:<input type="text" name="bigtype" size=8  value="'.$tmp['bigtype'].'">&nbsp;&nbsp;';
	echo '按小类: <input type="text" size="8" name="smalltype"  value="'.$tmp['smalltype'].'">&nbsp;&nbsp;';
	echo '按名称 <input type="text" size="8" name="watchname"  value="'.$tmp['watchname'].'">&nbsp;&nbsp;';
	echo '<input type="submit" name="sersubmit" value="搜索">';
	echo '</form>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
/************************显示观看信息*******************************/
	echo '<table border="1" width="900">';
	echo '<tr>';
	echo '<th>uid</th>';
	echo '<th>大类</th>';
	echo '<th>小类</th>';
	echo '<th>名称</th>';

	echo '</tr>';

		while(list( $uid, $bigtype,$smalltype, $watchname) = $stmt->fetch(PDO::FETCH_NUM)) {
		echo '<tr>';
		echo '<td>'.$uid.'</td>';
		echo '<td>'.$bigtype.'</td>';
		echo '<td>'.$smalltype.'</td>';
		echo '<td>'.$watchname.'</td>';
		
	}

	echo '</table>';
/************************关闭退出*******************************/
    echo '<a href="index.php">退出</a><br>';
	include "footer.php";
