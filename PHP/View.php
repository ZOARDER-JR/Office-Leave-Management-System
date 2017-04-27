
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
	#body{

		border: 1px black dashed;
		width: 700px;
		margin: 0px auto;
		margin-top: 20px;
		margin-bottom: 20px;
		padding: 10px;
	}

	</style>
</head>
<body>
  <center><h1> Office Leave Management System </h1></center>
  <br><br>

  <div id="body">
     <?php
     	include('connect.php');
     	if(isset($_GET['id']))
     	{
     		$username=$_GET['id'];

     		$query="select e.Name,e.Email,e.Gender,l.Enjoyed,l.Remains from employe_table as e JOIN leave_status as l on e.Username=l.Username where e.Username='$username'";

     		$result=mysqli_query($conn,$query);

     		if(mysqli_num_rows($result) > 0)
     		{
     			$row=mysqli_fetch_assoc($result);

     			echo "<b>Name: </b>" . $row["Name"] . "<br>" . "<b>Email: </b>" . $row["Email"] . "<br>" . "<b>Gender: </b>" . $row["Gender"] . "<br>" . "<b>Leave Enjoyed: </b>" . $row["Enjoyed"] . " Days<br>". "<b>Leave Remains: </b>" . $row["Remains"] . " Days<br>";
     		}
     		else
     		{
     			echo "<script> alert('Record Not Found'); </script>";
     		}
     	}
     ?>

     <center> <h4> <a href="pending_request.php"> Back </h4></center>
  </div>


</body>
</html>