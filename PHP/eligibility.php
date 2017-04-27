<?php
    
    include('connect.php');

    session_start();

    $cu = $_SESSION['puser'];

    $query = "select * from leave_status where Username='$cu'";                
    
    $result = mysqli_query($conn,$query);
    
    if(mysqli_num_rows($result) == 0)
    {
        echo "Username doesn't exist <br>";
    }
    else
    {
        $row=mysqli_fetch_assoc($result);  
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

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
        <title></title>
    </head>         
    <body>

    <center><h1> Office Leave Management System (Employe Panel) </h1></center>

    <?php 
        if(isset($row))
        {
            if($row["Remains"] > 0)
            {
                echo "<script> alert('You are Eligible to apply for a leave. Your have enjoyed $row[Enjoyed] days of leave. Your remaining days of leave are $row[Remains] days.'); </script>"; 
            }
            else
            {
                echo "<br>You are not eligible to request for a leave <br>";
                echo "Your have enjoyed ". $row["Enjoyed"] . " days of leave already. <br>";
            }
        } 
    ?>

    <div id="body"> <center> <h4> <a href="employe.php"> Back </h4></center> </div>
    </body>
    </html>
