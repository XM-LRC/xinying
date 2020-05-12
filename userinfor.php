<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>登录信息</title>
        <link rel="stylesheet" href="样式.css">
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
							
							 </caption>'  ?>
                            <thead align="center" bgcolor="#FFCCFF" valign="center">
                                <tr>
                                   
                                    <td width="76"> 影视大类</td>
                                    <td width="76"> 所属小类 </td>
                                    <td width="76"> 影视名称 </td>
                                    <td width="76"> 热度 </td>
                                    <td width="82"> 评分 </td>
									<td width="82"> 上映时间 </td>
                                </tr>
                            </thead>
                          <?php  echo '<tbody align="center" bgcolor="#FFCCFF" valign="center">';
                               while(list( $uid, $bigtype,$smalltype, $watchname,$hot,$score,$time) = $stmt->fetch(PDO::FETCH_NUM)) {
                                   
                                    echo '<tr>';
									
									echo '<td width="76">'.$bigtype.'</td>';
									echo '<td width="76">'.$smalltype.'</td>';
									echo '<td width="76">'.$watchname.'</td>';
								   echo '<td width="76">'.$hot.'</td>';
								   echo '<td width="76">'.$score.'</td>';
								   echo '<td width="76">'.$time.'</td>';
							   }
                                
                           echo' </tbody>';
		
									?>
                            <tfoot align="center" bgcolor="#9999CC" valign="middle">
                               
                            </tfoot>
                            </table>
	<?php
	echo '<a href="go/首页.html">去可视化页面</a><br>';
?>
                    </div>
                </div>

            </div>
        
	</body>
</html>

<?php
	
	include "footer.php";
