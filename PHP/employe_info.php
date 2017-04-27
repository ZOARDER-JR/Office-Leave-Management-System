
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

     td {
    text-align: center;
  }

	</style>
</head>
<body>
  <center><h1> Office Leave Management System (Admin Panel)</h1></center>
  <br><br>

  <div id="body">
     <?php
     	include('connect.php');

 		$query="select e.Name,e.Email,e.Username,e.Gender,l.Enjoyed,l.Remains from employe_table as e JOIN leave_status as l on e.Username=l.Username where e.Usertype='employe'";

 		$result=mysqli_query($conn,$query);

 		if(mysqli_num_rows($result) > 0)
 		{?>
 			 <table style="width: 100%">
          <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Gender</th>
              <th>Leave Enjoyed</th>
              <th>Leave Remains</th>
          </tr>
          <?php while( $row = mysqli_fetch_array($result) ) { ?>
          <tr>
              <td><?php echo $row['Name']; ?></td>
              <td><?php echo $row['Email']; ?></td>
              <td><?php echo $row['Username']; ?></td>
              <td><?php echo $row['Gender']; ?></td>
              <td><?php echo $row['Enjoyed']; ?></td>
              <td><?php echo $row['Remains']; ?></td>
          </tr>
 		<?php } ?>
        </table>
        <?php }  ?>

     <center> <h4> <a href="admin.php"> Back </h4></center>
  </div>
</body>
</html>