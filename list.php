<?php
	include "connect.php";
	include "page.class.php";
	include "function.inc.php";
	include "config.inc.php";


	
	
	/*进行图书搜索*/
	if(isset($_GET['action']) && $_GET['action']=='ser') {
		$tmp = !empty($_POST) ? $_POST : $_GET;
		
		$whr=array();
		$args = "";
		//如果sid不为空
		if(!empty($tmp['sid'])) {
			$whr[] = "sid like '%{$tmp['sid']}%'";

			$args .= "&sid={$tmp['sid']}";
		}
		if(!empty($tmp['tid'])) {
			$whr[] = "tid like '%{$tmp['tid']}%'";

			$args .= "&tid={$tmp['tid']}";
		}

		//如果math不为空，
		if(!empty($tmp['math'])) {
			$whr[] = "math like '%{$tmp['math']}%'";
			$args .= "&math={$tmp['math']}";
		}

		//如果english不为空，
		if(!empty($tmp['english'])) {
			$whr[] = "english = '{$tmp['english']}'";
			$args .= "&english={$tmp['english']}";
		}

		//如果pe不为空，
		if(!empty($tmp['pe'])) {
			$whr[] = "pe = '{$tmp['pe']}'";
			$args .= "&pe={$tmp['pe']}";
		}
		

		if(!empty($whr)) {
			$where = " where ".implode(" and ", $whr);
		
		} else {
			$where = "";
		}

	}
	
		//用户是否有动作
	if(isset($_GET['action'])) {
		//删除图书的动作
		if($_GET['action'] == "del") {
			//删除多个
			if(!empty($_POST['id'])) {
				$sql = "delete from score where id in(".implode(',', $_POST['id']).")";
			}else {
				//删除单个
				$sql = "delete from score where id='{$_GET['id']}'";
			}

			$stmt=$db->prepare($sql);
			$stmt->execute();
			
		//	$result = mysqli_query($db,$sql);

			if($stmt->rowCount()  > 0) {
				//先从数据库中，通过id将表中的图片名称获取到，
				//
				//再删除
				
				echo "数据删除成功!<br>";

			} else {
				echo "数据删除失败!<br>";
			}	
	
		}
	
	}

	//获取总记录数
	$sql = "select count(*) as total from score {$where}";  //将total获取
	$stmt=$db->prepare($sql);//准备
	$stmt->execute();//执行
	$data=$stmt->fetch(PDO::FETCH_ASSOC);//获得结果集

	//创建分页对象
	$page = new Page($data["total"], $num, $args);

	$sql = "select id,sid,tid, math, english, pe from score {$where} order by id {$page->limit}";
	
//	echo $sql."<br>";
	$stmt = $db -> prepare($sql);
	$stmt -> execute();

	echo "搜索成绩：";
	echo '<form action="list.php?action=ser" method="post">';
	echo '按学号:<input type="text" name="sid" size=8 value="'.$tmp['sid'].'">&nbsp;&nbsp;';
	echo '按工号:<input type="text" name="tid" size=8 value="'.$tmp['tid'].'">&nbsp;&nbsp;';

	echo '按高数:<input type="text" name="math" size=8  value="'.$tmp['math'].'">&nbsp;&nbsp;';
	echo '按英语: <input type="text" size="8" name="english"  value="'.$tmp['english'].'">&nbsp;&nbsp;';
	echo '按体育 <input type="text" size="8" name="pe"  value="'.$tmp['pe'].'">&nbsp;&nbsp;';
	echo '<input type="submit" name="sersubmit" value="搜索">';
	echo '</form>';



	echo '<form action="list.php?action=del&page='.$page->page.'" method="post" onsubmit="return confirm(\'你确定要删除这些图书吗?\')">';
	echo '<table border="1" width="900">';
	echo '<caption><h3>成绩列表</h3></caption>';
	echo '<tr>';
	echo '<th>&nbsp;</th>';
	echo '<th>编号</th>';
	echo '<th>学号</th>';
	echo '<th>工号</th>';
	echo '<th>高数</th>';
	echo '<th>英语</th>';
	echo '<th>体育</th>';
	echo '<th>操作</th>';
	echo '</tr>';

	while(list( $id,$sid, $tid, $math,$english, $pe) = $stmt->fetch(PDO::FETCH_NUM)) {
		echo '<tr>';
		echo '<td><input type="checkbox" name="id[]" value="'.$id.'"></td>';
		echo '<td>'.$id.'</td>';
		echo '<td>'.$sid.'</td>';
		echo '<td>'.$tid.'</td>';
		echo '<td>'.$math.'</td>';
		echo '<td>'.$english.'</td>';
		echo '<td>'.$pe.'</td>';
		echo '<td><a href="mod.php?action=mod&id='.$id.'">修改</a>/<a onclick="return confirm(\'你确定要删除《'.$sid.'》这个图书吗？\')" href="list.php?action=del'.$args.'&page='.$page->page.'&id='.$id.'">删除</a></td>';
		echo '</tr>';
	}


	echo '<tr><td><input type="submit" name="dosubmit" value="删除"/></td><td colspan="7" align="right">'.$page->fpage().'</td></tr>';

	echo '</table>';
	echo '</form>';

     echo '<a href="index.php">退出</a><br>';

	include "footer.php";
