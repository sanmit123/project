<html>
<head>
<title>OFFLINE DEMO</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
 <style>
     body {
        padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>  
<script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container padding-top-10">
<form method="post">
	<div class="panel panel-default">
		<div class="panel-heading" align="center"><h4>Login</h4></div>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-3">
					<label for="username" class="control-label">Username</label>
					<input type="text" id="username" class="form-control" name="username" placeholder="UserName" required="required"/></p>
				</div>
				<div class="col-md-3">
					<label for="password" class="control-label">Password</label>
					<input type="password" id="password" class="form-control" name="password" placeholder="Password" required="required"/>
				</div>
					<div class="col-md-3"><br>
					<button type="Submit" class="btn btn-primary">Login</button>
				</div>
			</div>
			<font color="red" size="2">
			<?php	
			if(isset($_POST['username'], $_POST['password']))
			{
				$UserName=$_POST['username'];
				$Password=$_POST['password'];
				$login=$_SERVER['HTTP_REFERER'];
				
				
				$conn=@mysql_connect("localhost","root") or die("cannot connect");
				$rs=@mysql_select_db("userdata",$conn) or die("DB ERROR");
				$sql="select * from userinfo where UserName=\"$UserName\" and Password=\"$Password\"";
				$re=@mysql_query($sql,$conn) or die("Could not execute");
				$rows=mysql_num_rows($re);
				if($rows!=0)
				{	
					session_start();
					$_SESSION['username']=$UserName;
					header("Location:chat.php?user=$UserName");
				}
				else
				{
					echo"*Note: Invalid username or password";
				}
			}
			?>
		</font>	
		</div>
	</div>
	
	</form>
</div>
<div class="container">
	<form method="post">
	<div class="panel panel-default">
		<div class="panel-heading" align="center"><h4>Sign-Up</h4></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<label for="name" class="control-label">Name:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" name="name" id="name" placeholder="Firstname" required="required">
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" name="Middlename" id="Name" placeholder="Middlename" required="required">
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" name="Lastname" id="Name" placeholder="Lastname" required="required">
								</div>
							</div><br><br>
							<div class="row">							
								<div class="col-md-3">
									<label for="newUserName" class="control-label">Username:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" name="user" id="newUserName" placeholder="UserName" required="required">
								</div>
							</div><br><br>
							<div class="row">							
								<div class="col-md-3">
									<label for="newPassword" class="control-label">Password:</label>
								</div>
								<div class="col-md-3">
									<input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password" required="required" >
								</div>
							</div><br><br>
							<div class="row">							
								<div class="col-md-3">
									<label for="Id" class="control-label">Id no.:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" name="Id" id="Id" placeholder=" Type your organization id" required="required">
								</div>
							</div>
								<div class="col-md-3"><br>
									<button type="Submit"  class="btn btn-primary">Submit</button>
								</div>						
							</div>
							<font size="2" color="red" align="center">
							<?php
							if( isset($_POST['name'],$_POST['Middlename'], $_POST['Lastname'],$_POST['user'],$_POST['newPassword']))
								{
								define('DB_HOST','localhost');
								define('DB_NAME','userdata');
								define('DB_USER','root');
								define('DB_PASSWORD','');

								$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to mysql:".mysql_error());
								$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to mysql:".mysql_error());		
								$a1=$_POST['name'];
								$a2=$_POST['Middlename'];
								$a3=$_POST['Lastname'];
								$Name=$a1." ".$a2." ".$a3;
								$UserName=$_POST['user'];
								$Password=$_POST['newPassword'];
								$Id_no=$_POST['Id'];
								$query=mysql_query("SELECT * FROM userinfo WHERE Id_no='$Id_no'");
								$row=mysql_fetch_array($query);
								$query1=@mysql_query("SELECT UserName FROM userdata.userinfo");
								$row1=@mysql_fetch_assoc($query1);
								
									if($row)
								    {
									    if (($row['UserName'])=="")
									    {
											
											if($row1['UserName']!=$UserName)//ny zla
											{
												$query="UPDATE userinfo 
													SET Name='$Name',UserName='$UserName',Password='$Password' 
													WHERE Id_no='$Id_no' ";
												
												$data=mysql_query($query) or die(mysql_error());
												if($data)
												{
													session_start();
													$_SESSION['user']=$UserName;
													header("Location:chat.php?user=$UserName");
												}
												else 
												{
													echo"*Note: failed.";
												}	

											}
											else
											{
												echo"*Note: Already registered with this username.";
											}
								    	}
									    else
									    {
										    echo"*Note: Already registered with this id.";
									    }						
								    }
								    else
								    {
									    echo "*Note: You're not allowed to sign up.";						
								    }					
								}						
							
							
							?>
						</font>
				</div>
			</div>
		</div>
	</div>
	</form>								
</div>
</body>
</html>


