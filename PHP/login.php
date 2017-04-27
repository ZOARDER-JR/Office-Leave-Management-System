<?php
    
    include('connect.php');

    if($_POST)                         // if form is submitted
    {
        //not empty
        //atleast 6 characters long

        $errors = array();
        $password=$_POST['password'];
        $username=$_POST['uName'];

        //start validation
        
        if(empty($username))
        {
            $errors['username'] = "Insert a username";   
        }
        
        if(empty($_POST['password']))
        {
            $errors['pass'] = "Insert a password";
        }

        //check errors
        if(count($errors) == 0)
        {
            $query = "select * from employe_table where (Username='$username' AND Password='$password')";                
            
            $result = mysqli_query($conn,$query);
            
            if(mysqli_num_rows($result) == 0)
            {
                $errors['login'] = "Username and Password doesn't match.";
            }
            else
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    if($row["Username"] === $username && $row["Password"] === $password)
                    {
                        session_start();
                        
                        $_SESSION['puser'] = $username;

                        if($row["Usertype"] == "admin")
                        {
                            header("Location: admin.php");         
                        }
                        else if($row["Usertype"] == "employe")
                        {
                            header("Location: employe.php");
                        }
                    }
                }

                $errors['login'] = "Username and Password doesn't match.";     
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

    <center><h1> Office Leave Management System (Login Panel) </h1></center>

    <div id="body">

        <form method="post" target="">

            <p>
            <label for="uName">Username</label>
            <input type="text" name="uName" id="uName" value="<?php if(isset($_POST['uName'])) echo $_POST['uName'];?>" /> <!-- output the field value -->
            </p>

            <p><?php if(isset($errors['username'])) echo $errors['username']; ?></p>

            <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
            </p>

            <p><?php if(isset($errors['pass'])) echo $errors['pass']; ?></p>

            <p><?php if(isset($errors['login'])) echo $errors['login']; ?></p>
            
            <input type="submit" value="Login" />
        </form>

        <center> <h4> <a href="index.php"> Back </h4></center>
    </div>
    </body>
