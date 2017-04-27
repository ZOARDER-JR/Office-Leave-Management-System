<?php
    
    include('connect.php');
    session_start();

    $cu = $_SESSION['puser'];

    if($_POST)                         // if form is submitted
    {
        //not empty
        //atleast 6 characters long

        $errors = array();
        $password=$_POST['password'];
        $num_day=$_POST['days'];

        //start validation

        if(empty($_POST['password']))
        {
            $errors['pass'] = "Insert a password";
        }

        //check errors
        if(count($errors) == 0)
        {
            $query = "select * from employe_table where (Username='$cu' AND Password='$password')";                
            
            $result = mysqli_query($conn,$query);
            
            if(mysqli_num_rows($result) == 0)
            {
                $errors['login'] = "Username and Password doesn't match.";
            }
            else
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    if($row["Username"] === $cu && $row["Password"] === $password)
                    {
                        $query = "select * from leave_status where Username='$cu'";                
            
                        $result = mysqli_query($conn,$query);
                        
                        $rows = mysqli_fetch_assoc($result);
                        break;
                    }
                }

                if(!isset($rows)){$errors['login'] = "Username and Password doesn't match.";}     
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

        <form method="post" target="">

            <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
            </p>

            <p><?php if(isset($errors['pass'])) echo $errors['pass']; ?></p>

            Number of days: 
            <select name="days">
            <option value="20">20</option>
            <option value="19">19</option>
            <option value="18">18</option>
            <option value="17">17</option>
            <option value="16">16</option>
            <option value="15">15</option>
            <option value="14">14</option>
            <option value="13">13</option>
            <option value="12">12</option>
            <option value="11">11</option>
            <option value="10">10</option>
            <option value="9">9</option>
            <option value="8">8</option>
            <option value="7">7</option>
            <option value="6">6</option>
            <option value="5">5</option>
            <option value="4">4</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
            
            </select>
            <p><?php if(isset($errors['login'])) echo $errors['login']; ?></p>
            
            <input type="submit" value="Ok" />
            <center>
                <?php 
                    if(isset($rows))
                    {
                        $query="select * from request_table where Username='$cu' ";
                        $result=mysqli_query($conn,$query);

                        if(mysqli_num_rows($result) > 0)
                        {
                            echo "<script> alert('Sorry. You already have a request pending'); </script>";
                        }
                        else if($rows["Remains"] < $num_day)
                        {
                            echo "Sorry. Your remaining days are " . $rows["Remains"] . ".<br>";    
                        }
                        else
                        {
                            $query = "insert into request_table(Username,Days,Status) values('$cu','$num_day','0')";                
                            $result = mysqli_query($conn,$query);
                            if($result)
                            {
                              //show success message if registration successfully completed
                              echo "<script>alert('Your Request has been sent Successfully.');</script>";
                            } 
                            else 
                            {
                                $msg =mysqli_error($conn);
                                echo '<script>alert("'.$msg.'");</script>';
                            }
                        }
                    }
                 ?>
             </center>
        </form>

        <center> <h4> <a href="employe.php"> Back </h4></center>
    </div>
    </body>
