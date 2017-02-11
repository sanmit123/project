<html>
<head>
<title>OFFLINE DEMO</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
 <style>
     body {
        padding-top: 80px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>  
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<form method="post">
	<div class="row">							
		<div class="col-md-3">
			<label for="nId" class="control-label">Student_Id:</label>
		</div>
		<div class="col-md-3">
			<input type="text"  class="form-control" name="nId" id="nId" placeholder="Student_id" required="required"/>
		<div class="col-md-3"><br>
			<button type="Submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
		<font color="red" size="2">
			<?php
			session_start();
			if(isset($_SESSION['admin_id']))
			{
			if ($_POST)
			{
				define('DB_HOST','localhost');
				define('DB_NAME','userdata');
				define('DB_USER','root');
				define('DB_PASSWORD','');
					  
					  
				$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to mysql:".mysql_error());
				$db=mysql_select_db(DB_NAME,$con) or die("Failed to cconnect to mysql:".mysql_error());

					$Id_no=$_POST['nId'];
					$query3=mysql_query("SELECT * FROM userinfo WHERE Id_no='$Id_no'");
					$row=mysql_fetch_array($query3);
						if($row)
						{	
							echo "*Note: This Id is already used.";	
							
						}
						else
						{
							$query="INSERT INTO userinfo (Id_no) VALUES ('$Id_no')";
							$data=mysql_query($query) or die(mysql_error());
							if($data)
							{
								header("Location:right.php");
							}
							else
							{
								echo"*Note: Failed.";					
							}
						}
						
				}
			}				
				?>	
		</font>
	</div><br><br>
	</form>
</body>
</html>