<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>登录信息</title>
        <link rel="stylesheet" href="userinfor.css">
        <script src="echarts.min.js"></script>
        <script src="vintage.js"></script><!-- 复古风格 -->
        <!-- <script src="dark.js"></script> -->
	</head>
	<body>
			<div id='logo'>
               
                    <span id="zi"> 新影--数据可视化</span> 
				
            </div>
		
	<?php
	include "connect.php";
	include "config.inc.php";
	include "function.inc.php";
	
/*	echo '<br>';
	echo '<br>';*/
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
			$whr[] = "bigtype like '%{$tmp['bigtype']}%'";
			$args .= "&bigtype={$tmp['bigtype']}";
		}

		//按照小类搜索
		if(!empty($tmp['smalltype'])) {
			$whr[] = "smalltype like '%{$tmp['smalltype']}%'";
			$args .= "&smalltype={$tmp['smalltype']}";
		}

		//按照影视作品搜索
		if(!empty($tmp['watchname'])) {
			$whr[] = "watchname like '%{$tmp['watchname']}%'";
			$args .= "&watchname={$tmp['watchname']}";
		}
		
		if(!empty($tmp['hot'])) {
			$whr[] = "hot like '%{$tmp['hot']}%'";
			$args .= "&hot={$tmp['hot']}";
		}
		
		if(!empty($tmp['score'])) {
			$whr[] = "score like '%{$tmp['score']}%'";
			$args .= "&score={$tmp['score']}";
		}
		/*if(!empty($tmp['time'])) {
			$whr[] = "time = '{$tmp['time']}'";
			$args .= "&time={$tmp['time']}";
		}*/
		
		/*if(!empty($tmp['time'])) {
			$whr[] = "time = '{$tmp['time']}'";
			$args .= "&time={$tmp['time']}";
		}*/
		

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
		
		if(isset($_GET['action'])) {
		//删除图书的动作
		if($_GET['action'] == "del") {
			//删除多个
			if(!empty($_POST['id'])) {
				$sql = "delete from tb_userwatch where id in(".implode(',', $_POST['id']).")";
			}else {
				//删除单个
				$sql = "delete from tb_userwatch where id='{$_GET['id']}'";
			}

			$stmt=$db->prepare($sql);
			$stmt->execute();
			
		//	$result = mysqli_query($db,$sql);

			if($stmt->rowCount()  > 0) {
				//先从数据库中，通过id将表中的图片名称获取到，
				//
				//再删除
				
			//	echo "数据删除成功!<br>";

			} else {
				echo "数据删除失败!<br>";
			}	
	
		}
	
	}
	
/************************数据库查询*******************************/	
	$sql = "select * from tb_userwatch {$where} ";
	$stmt = $db -> prepare($sql);
	$stmt -> execute();


		
		?>
		
		
            <div id="lcontent">

                <div id='main'>
                    <div id="main1">
						<?php
                      echo' <span id="informain"> '.'姓名:  '. $_SESSION['username']. '&nbsp  &nbsp  &nbsp'.'性别:  '. $_SESSION['sex']. '&nbsp  &nbsp  &nbsp'.'年龄:  '. $_SESSION['age']. '&nbsp  &nbsp  &nbsp'.'职业:  '. $_SESSION['job']. '&nbsp  &nbsp  &nbsp&nbsp'. '是否会员:  '. $_SESSION['vip']. '&nbsp  &nbsp &nbsp  &nbsp'. '观影时长:  '. $_SESSION['time']. '小时'.'&nbsp  &nbsp  &nbsp'.'</span>';
						?>
                    </div>
	<div id="main3">
		<?php
     echo '<form action="userinfor.php?action=ser" method="post">';
	

	echo '影视大类:<input type="text" name="bigtype" size="10"  value="'.$tmp['bigtype'].'">&nbsp;&nbsp;';
	echo '所属小类: <input type="text" size="10" name="smalltype"  value="'.$tmp['smalltype'].'">&nbsp;&nbsp;';
	echo '影视名称 <input type="text" size="10" name="watchname"  value="'.$tmp['watchname'].'">&nbsp;&nbsp;';
		
		echo '评分 <input type="text" size="10" name="score"  value="'.$tmp['score'].'">&nbsp;&nbsp;';
	//	echo '上映时间 <input type="text" size="10" name="time"  value="'.$tmp['time'].'">&nbsp;&nbsp;';
	echo '<input type="submit" name="sersubmit" size="10" value="搜索">';
	echo '</form>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
            ?>            
                    </div>			
					
                    <div id="main2">
                        <table align="center" width="900" height="50" border="3px" cellpadding="1" cellspacing="1"  frame=hsides rules="rows">
                      <?php    echo'<caption><h2 style="color:black">'.$_SESSION['username'].'的观影历史'.'</h2> 
							
							 </caption>'  ;
                       //  echo'   <thead align="center" bgcolor="#FFCCFF" valign="center">';
	echo '<form  align="center" bgcolor="#FFCCFF" valign="center" action="userinfor.php?action=del" method="post" onsubmit="return confirm(\'你确定要删除这些记录吗?\')">';
	echo '<table border="1" width="900">';
    echo '<tr>';
	echo '<th>选择</th>';
	
	echo '<th>影视大类</th>';
	echo '<th>所选小类</th>';
	echo '<th>影视名称</th>';
	echo '<th>热度</th>';
	echo '<th>评分</th>';
	echo '<th>上线时间</th>';			
	echo '<th>操作</th>';
	echo '</tr>';
                          
                            echo '<tbody align="center" bgcolor="#FFCCFF" valign="center">';
                               while(list( $id,$uid, $bigtype,$smalltype, $watchname,$hot,$score,$time) = $stmt->fetch(PDO::FETCH_NUM)) {
                                   
                                    echo '<tr>';
								   echo '<td><input type="checkbox" name="id[]" value="'.$id.'"></td>';
									
									echo '<td width="76">'.$bigtype.'</td>';
									echo '<td width="76">'.$smalltype.'</td>';
									echo '<td width="76">'.$watchname.'</td>';
								   echo '<td width="76">'.$hot.'</td>';
								   echo '<td width="76">'.$score.'</td>';
								   echo '<td width="76">'.$time.'</td>';
							  echo '<td><a onclick="return confirm(\'你确定要删除这个记录吗？\')" href="userinfor.php?action=del'.$args.'&page='.$page->page.'&id='.$id.'">删除</a></td>';
		echo '</tr>';
	}
	                        echo '<tr><td><input type="submit" name="dosubmit" value="删除"/></td><td colspan="7" align="right"></td></tr>';
							echo '</table>';
							echo '</form>';
                           echo' </tbody>';
		
									?>
                            <tfoot align="center" bgcolor="#9999CC" valign="middle">
                               
                      
                          
	<?php
	echo '<a href="index.html">返回 首页</a><br>';

?>
                    </div>
                </div>

            </div>
        
	</body>
</html>

<?php
	
	include "footer.php";
