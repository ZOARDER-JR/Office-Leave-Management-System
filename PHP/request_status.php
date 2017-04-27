<?php
    
    include('connect.php');

    session_start();

    $cu = $_SESSION['puser'];

    $query = "select * from request_table where Username='$cu'";                
            
    $result = mysqli_query($conn,$query);
    
    if(mysqli_num_rows($result) == 0)
    {
        echo " <script> alert('You have no request Pending'); </script>";
    }
    else
    {
        $row=mysqli_fetch_assoc($result);

        if($row["Status"] == 0)
        {
            echo " <script> alert('Your request is not approved yet'); </script>";       
        }
        else 
        {
            if($row["Status"] == 1)
            {
                echo " <script> alert('Congratulation!!! Your request is accepted'); </script>";       
            }
            else if($row["Status"] == 2)
            {
                echo " <script> alert('Sorry!!! Your request is rejected'); </script>";   
            }

            $query = "delete from request_table where Username='$cu'";                
    
            $result = mysqli_query($conn,$query);

            if(!$result)
            {
                echo "<script> alert('Something Went Wrong'); </script>";
            }
        }  
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

    <div id="body">

        <center> <h4> <a href="employe.php"> Back </h4></center>
    </div>
    </body>
    </html>
