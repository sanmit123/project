<html>
<head>
<title>OFFLINE DEMO</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="main/scripts/js/jquery.min.js"></script>
<script type="text/javascript" src="main/scripts/js/search.js"></script>
</head>
<style>			
#myInput
{
    background-image: url('img/search.png');
    background-size: 30px 30px;
    background-position: 10px 8px; 
    background-repeat: no-repeat; 
    width:250px; 
    font-size: 16px; 
    padding: 12px 20px 12px 40px; 
    border: 1px solid #ddd;
    margin-bottom: 12px; 
	border-radius: 30px;
}
.chat_bg
{
	background-image:url('img/msg_bg1.jpg');
}
.user
{
	background-color:#e7e7e7; 
	width:200px;
	padding-left:10px; 
	border-radius:1px 20px;
}
a:link, a:visited 
{
	transition:1s; 
	width:200px;
	background-color:white; 
	color: black; 
	padding: 14px 2px; 
	text-align:left;
	text-decoration: none; 
	display: inline-block;
	border-radius:10px; 
	border-top-style: solid;
	border-width:1px;
}
 a:hover, a:active
{
	width:250;
	background-color:white; 
}
</style>
<body class="chat_bg">
<div class="container">
<?php

	session_start();
	if(isset($_GET['user']) && isset($_SESSION['username']))
	{
	$_SESSION['user']=$_GET['user'];
	echo "<br><div class='user'><style></style><font size='7'>" .$_SESSION['user'].'</font></div>';
	}
	else
	{
		header('Location:sign.php');
	}

	
		function get_recievers()
		{
			$conn=mysql_connect("localhost","root") or die("cannot connect");
			$rs=mysql_select_db("userdata",$conn) or die("DB ERROR");
			$sql="SELECT UserName FROM userinfo";
			$data = mysql_query($sql,$conn);
			$recievers=array();
			while($row = mysql_fetch_assoc($data)) 
			{
				if($row["UserName"] !=$_SESSION['user'] && !empty($row["UserName"]))
				{
					$recievers[]=$row;
					$_SESSION['sender']=$_SESSION['user'];		
				}
			}
			mysql_close($conn);
			return $recievers;
		}			
		function get_table()
		{
			
			echo'';
			$table_str='<table id="myTable">';
			$recievers=get_recievers();
			$i=1;
			
			foreach($recievers as $reciever)
			{
				$_SESSION['UserName']=$reciever['UserName'];
				$table_str.='<tr>';
				$i++;
				$table_str.='<td><a href="main/index.php?receiver='.$reciever['UserName'].'&sender='.$_SESSION['user'].'" target="iframe1">'.$reciever['UserName'].'</a></td>';	
				$table_str.='</tr>';
				
			}
			$table_str.='</table>';
			return $table_str;
			
		}	
?>
		<div class="row">
			<div class="col-md-3">
			<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search username...">
				
				<div id="friends">
					<?php echo get_table();?>
				</div>
			</div>
			<div class="col-md-6">
				<iframe  name="iframe1" height="500" width="100%" frameborder="0" scrolling="yes"></iframe>
			</div>
		</div>
<input type="button" class="btn btn-danger" onclick="window.location.href='logout.php'" value="Logout">
</div>
</body>
</html>
