<?php
    
    include('connect.php');

    if($_POST)                         // if form is submitted
    {
        //not empty
        //atleast 6 characters long

        $errors = array();
        $fname=$_POST['fName'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $gender=$_POST['gender'];
        $username=$_POST['uName'];
        $usertype=$_POST['usertype'];

        //start validation
        if(empty($_POST['fName']))
        {
            $errors['fName1'] = "Your first name cannot be empty";
        }
        if(strlen($_POST['fName']) < 8)
        {
            $errors['fName2'] = "Your first name must be atleast 8 characters long";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        {
             $errors['email1'] = "Invalid email format"; 
        }
        else
        {
            $query = "select * from employe_table where Email='$email'";                
            
            $result = mysqli_query($conn,$query);
             
            if(mysqli_num_rows($result) > 0)
            {
                $errors['email2'] = "Email Taken";       
            }
        }
        if(empty($username))
        {
            $errors['uName1'] = "Your username cannot be empty";   
        }
        else
        {
            $query = "select * from employe_table where Username='$username'";                
            
            $result = mysqli_query($conn,$query);

            $sps=count_chars($username,1);

            foreach ($sps as $key => $value) 
            {
                if($key == 32)
                {
                    $errors['uName3'] = "Username cannot contain Space";
                }
            }  
            
            if(mysqli_num_rows($result) > 0)
            {
                $errors['uName2'] = "Username Taken";       
            }
        }
        if(empty($_POST['password']))
        {
            $errors['password1'] = "Password cannot be empty";
        }
        else if(strlen($_POST['password']) < 8)
        {
            $errors['password2'] = "Password must be atlest 8 characters long";
        }
        else if(strlen($_POST['password']) > 25)
        {
            $errors['password3'] = "Password can be maximum of 25 character";
        }
        else
        {
            $pass=count_chars($password,1);

            $ch=$sp=$dg=0;

            foreach ($pass as $key => $value) {
                if($key >= 33 && $key <= 47)
                {
                    $sp=1;
                }
                else if($key >= 58 && $key <= 64)
                {
                    $sp=1;
                }
                else if($key >= 91 && $key <= 96)
                {
                    $sp=1;
                }
                else if($key >= 123 && $key <= 126)
                {
                    $sp=1;
                }
                else if($key >= 48 && $key <= 57)
                {
                    $dg=1;
                }
                else if($key >= 65 && $key <= 90)
                {
                    $ch=1;
                }
                else if($key >= 97 && $key <= 122)
                {
                    $ch=1;
                }

            }

            if($sp==0 || $dg ==0 || $ch==0)
            {
                $errors['password4'] = "Password must contain a digit, a letter and a special cheracter";
            }
        }

        if ($_POST['repass'] !== $_POST['password']) 
        {
             $errors['repass'] = "Password Doesn't match"; 
        }

        if (empty($_POST["gender"])) 
        {
             $errors['gender'] = "Gender is required";
        }

        if (empty($_POST["usertype"])) 
        {
             $errors['usertype'] = "Gender is required";
        }

        //check errors
        if(count($errors) == 0)
        {
            $query = "insert into employe_table(Name,Email,Password,Username,Gender,Usertype) values('$fname','$email','$password','$username','$gender','$usertype')";                
            
            $result = mysqli_query($conn,$query);
            if($result)
            {
              //show success message if registration successfully completed
              echo "<script>alert('Registered Successfully. Check your database');</script>";
            } 
            else 
            {
                $msg =mysqli_error($conn);
                echo '<script>alert("'.$msg.'");</script>';
            }

            if($usertype === "employe")
            {
                $query = "insert into leave_status(Username,Enjoyed,Remains) values('$username','0','20')";                
            
                $result = mysqli_query($conn,$query);
                if($result)
                {
                  //show success message if registration successfully completed
                  echo "<script>alert('Registered Successfully. Check your database');</script>";
                } 
                else 
                {
                    $msg =mysqli_error($conn);
                    echo '<script>alert("'.$msg.'");</script>';
                }
            }

           header("Location: index.php");
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

    <center><h1> Office Leave Management System </h1></center>

    <div id="body">

        <form method="post" target="">
            <p>
            <label for="fName">Full Name</label>
            <input type="text" name="fName" id="fName" value="<?php if(isset($_POST['fName'])) echo $_POST['fName'];?>" /> <!-- output the field value -->
            </p>
            <p><?php if(isset($errors['fName1'])) echo $errors['fName1']; ?></p>   <!-- output errors if error occurs -->
            <p><?php if(isset($errors['fName2'])) echo $errors['fName2']; ?></p>

            <p>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" />
            </p>

            <p><?php if(isset($errors['email1'])) echo $errors['email1']; ?></p>   <!-- output errors if error occurs -->
            <p><?php if(isset($errors['email2'])) echo $errors['email2']; ?></p>

            <p>
            <label for="uName">Username</label>
            <input type="text" name="uName" id="uName" value="<?php if(isset($_POST['uName'])) echo $_POST['uName'];?>" /> <!-- output the field value -->
            ( Must be Unique )
            </p>
            <p><?php if(isset($errors['uName1'])) echo $errors['uName1']; ?></p>   <!-- output errors if error occurs -->
            <p><?php if(isset($errors['uName2'])) echo $errors['uName2']; ?></p>
            <p><?php if(isset($errors['uName3'])) echo $errors['uName3']; ?></p>

            <p>
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" />
            </p>
            
            <p><?php if(isset($errors['password1'])) echo $errors['password1']; ?></p>
            <p><?php if(isset($errors['password2'])) echo $errors['password2']; ?></p>
            <p><?php if(isset($errors['password3'])) echo $errors['password3']; ?></p>
            <p><?php if(isset($errors['password4'])) echo $errors['password4']; ?></p>

            <p>            
            <label for="repass">Re-enter Password</label>
            <input type="password" name="repass" id="repass" />
            </p>

            <p><?php if(isset($errors['repass'])) echo $errors['repass']; ?></p>

            <p>
            <label for="gender">Gender: </label>
            <input type="radio" name="gender" id="gender" value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] == "male") echo "checked";?> /> Male
            <input type="radio" name="gender" id="gender" value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] == "female") echo "checked";?> /> Female
            </p>

            <p><?php if(isset($errors['gender'])) echo $errors['gender']; ?></p>

            <p>
            <label for="usertype">User Type: </label>
            <input type="radio" name="usertype" id="usertype" value="admin" <?php if(isset($_POST['usertype']) && $_POST['usertype'] == "admin") echo "checked";?> /> Admin
            <input type="radio" name="usertype" id="usertype" value="employe" <?php if(isset($_POST['usertype']) && $_POST['usertype'] == "employe") echo "checked";?> /> Employe
            </p>

            <p><?php if(isset($errors['usertype'])) echo $errors['usertype']; ?></p>

            <input type="submit" value="Submit" />
        </form>

        <center> <h4> <a href="index.php"> Back </h4></center>
    </div>
    </body>
