<?php
session_start();
if(isset($_SESSION['user']))
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="index1.css">
</head>
<body>
    <div class="container">

    <?php
    if(isset($_POST["register"])) {
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];

        $passwordHash=password_hash($password,PASSWORD_DEFAULT);
        $errors=array();
        if(empty($firstname) OR empty($lastname) OR empty($email) OR empty($password) OR empty($confirmpassword))
        {
            array_push($errors,"All fields are required");
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            array_push($errors,"email is not valid");
        }
        if(strlen($password)<8)
        {
            array_push($errors,"password must be at least 8 characters");
        }
        if($password!==$confirmpassword)
        {
            array_push($errors,"password does not match");
        }
        require_once "database.php";
        $sql="SELECT * FROM task1 WHERE email = '$email'";
        $result =mysqli_query($con,$sql);
        $rowCount=mysqli_num_rows($result);
        if($rowCount>0)
        {
            array_push($errors,"Email already exists");
        }

        if(count($errors)>0)
        {
            foreach($errors as $error)
            {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
        else
        {
            // insert data into database
            
            $sql="INSERT INTO task1 (firstname,lastname,email,password) VALUES(?,?,?,?)";
            $stmt=mysqli_stmt_init($con);
            $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
            if($prepareStmt)
            {
                mysqli_stmt_bind_param($stmt,"ssss",$firstname,$lastname,$email,$passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are successfully registered</div>";
            }
            else{
                die("Something went wrong");
            }
        }
    }
    ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="register">
            </div>
        </form>
        <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
    </div>
    
</body>
</html>