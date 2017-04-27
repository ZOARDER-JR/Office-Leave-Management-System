
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

            $query="select * from request_table where Username = '$username'";

            $result=mysqli_query($conn,$query);

            $chk=mysqli_fetch_assoc($result);

            if($chk['Status'] == 0)
            {
                $query="update request_table set Status = 1 where Username = '$username'";

                $result=mysqli_query($conn,$query);

                if($result)
                {
                    $query="select * from request_table where Username = '$username'";

                    $result=mysqli_query($conn,$query);

                    $day=mysqli_fetch_assoc($result);

                    $query="select * from leave_status where Username = '$username'";

                    $result=mysqli_query($conn,$query);

                    $reduce=mysqli_fetch_assoc($result);

                    $query1="update leave_status set Enjoyed = $reduce[Enjoyed]+ $day[Days] where Username = '$username'";
                    $query2="update leave_status set Remains = $reduce[Remains]- $day[Days] where Username = '$username'";

                    $result=mysqli_query($conn,$query1);
                    $result=mysqli_query($conn,$query2);

                }
                else
                {
                    echo "<script> alert('Something went wrong. Please Try Again'); </script>";
                }
            }
     		
     	}

       header('Location: pending_request.php');
     ?>
  </div>


</body>
</html>