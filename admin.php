<html>
<head>
<title>OFFLINE DEMO</title>
<meta charset="utf-8">
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
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading" align="center"><h4>Login</h4></div>
		<div class="panel-body">	
		<form method="post">
			<div class="form-required">
			<div class="row">
				<div class="col-md-3">
					<label for="admin_id" class="control-label">Admin_id</label>
					<input type="text" id="admin_id" class="form-control" name="admin_id" placeholder="admin_id" required="required"/></p>
				</div>
				<div class="col-md-3">
					<label for="Password" class="control-label">Password</label>
					<input type="password" id="Password" class="form-control" name="password" placeholder="Password" required="required"/>
				</div>
					<div class="col-md-3"><br>
					<button type="Submit" class="btn btn-primary">Login</button>
				</div>
			</div>
			<font size="2" color="red">
			<?php	
			if(isset($_POST['admin_id'],$_POST['password']))
			{
				$UserName=$_POST['admin_id'];
				$Password=$_POST['password'];
				
						
					$sql="SELECT * from admin where Admin_id=\"$UserName\" and Password=\"$Password\"";
					$conn=@mysql_connect("localhost","root") or die("cannot connect");
					$rs=@mysql_select_db("admindata",$conn) or die("DB ERROR");
					$rs=mysql_query($sql,$conn) or die("Could not execute");
					$rows=mysql_numrows($rs);
					if($rows!=0)
					{
						session_start();
						$_SESSION['admin_id']=$UserName;
						$locc4="right.php";
						header("Location:$locc4");
					}
					else
					{
						echo"*Note: Invalid UserName or Password";

					}	
			}
			else
			{
				error_reporting("not accessible");
			}
			?>
			</font>
			</div>
		</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading" align="center"><h4>Sign-Up</h4></div>
					<form method="post">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<label for="Firstname" class="control-label">Name:</label>
								</div>
								<div class="col-md-3">
									<input type="text"  class="form-control" name="Firstname" id="Firstname" placeholder="Firstname" required="required"/>
								</div>
								<div class="col-md-3">
									<input type="text"  class="form-control"  name="Middlename" id="Name" placeholder="Middlename" required="required"/>
								</div>
								<div class="col-md-3">
									<input type="text"  class="form-control" name="Lastname" id="Name" placeholder="Lastname" required="required"/>
								</div>
							</div><br><br>
							<div class="row">							
								<div class="col-md-3">
									<label for="nadmin_id" class="control-label">Admin_Id:</label>
								</div>
								<div class="col-md-3">
									<input type="text"  class="form-control" name="nadmin_id" id="nadmin_id" placeholder="Admin_id" required="required"/>
								</div>
							</div><br><br>
							<div class="row">							
								<div class="col-md-3">
									<label for="newPassword" class="control-label">Password:</label>
								</div>
								<div class="col-md-3">
									<input type="password"  class="form-control" name="newPassword" id="newPassword" placeholder="New Password" required="required"/>
								</div>
							</div><br><br>
							<div class="row">							
								<div class="col-md-3">
									<label for="Post" class="control-label">Post:</label>
								</div>
								<div class="col-md-3">
									<div class="radio">
											<label><input type="radio" name="post" value="HOD"/>HOD</label>
									</div>
								</div>
								<div class="col-md-3">								
									<div class="radio">
											<label><input type="radio" name="post" value="Staff" />Staff</label>
									</div>
								</div>
							</div>
							<div class="row">	
								<div class="col-md-3"><br>
									<button type="Submit" class="btn btn-primary" onclick="checkName()">Submit</button>
								</div>
							</div>
							<font color="red" size="2">
							<?php
							if(isset($_POST['Firstname'],$_POST['Middlename'],$_POST['Lastname'],$_POST['nadmin_id'],$_POST['post'],$_POST['newPassword']))
							{
								define('DB_HOST','localhost');
								define('DB_NAME','admindata');
								define('DB_USER','root');
								define('DB_PASSWORD','');

								$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to mysql:".mysql_error());
								$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to mysql:".mysql_error());

										$a1=$_POST['Firstname'];
										$a2=$_POST['Middlename'];
										$a3=$_POST['Lastname'];
										$Name=$a1." ".$a2." ".$a3;
										$Admin_id=$_POST['nadmin_id'];
										$Post=$_POST['post'];
										$Password=$_POST['newPassword'];
										$query3=mysql_query("SELECT * FROM admin WHERE Admin_id='$Admin_id'");
										$query4=mysql_query("SELECT * FROM admin WHERE Post='$Post'");
										$row=mysql_fetch_array($query3);
										
											$row4=mysql_fetch_array($query4);
												if(!$row4)
												{	
													if($row)
													{
														echo"*Note: This Id is already signed up.";
													}
													else
													{
														$query="INSERT INTO admin (Name,Password,Admin_id,Post) VALUES ('$Name','$Password','$Admin_id','$Post')";
														$data=mysql_query($query) or die(mysql_error());
														if($data)
														{	
															session_start();
															$_SESSION['admin_id']=$Admin_id;
															$locc4="right.php";
															header("Location:$locc4");
														}
														else 
														{
															echo"*Note: Failed";
														}		
													}
												}
												else
												{
													echo"*Note: Already registered with this post.";
												}
											}								
										
										
										?>
						</div>
					</form>
				<div>
			</div>
		</div>
	</div>								
</div>
</body>
</html>