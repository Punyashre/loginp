<!doctype html>
<?php
@include 'config.php';
if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $cpassword=mysqli_real_escape_string($conn,$_POST['cpassword']);

    $select="SELECT * FROM login WHERE email = '$email' && password = '$password' ";
    $result=mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0) 
    {
        $error[]='user already exists';
    } else {
        if($password!=$cpassword)
        {
            $error[]='password not matched';
        }
        else
        {
            $insert="INSERT INTO login(name,email,password) VALUES('$name','$email','$password')";
            mysqli_query($conn,$insert);
            header('location:login.php');

        }

    }
};
?>

<html>
 <head>
     <meta name="viewport" content="width=device-width,intial-scale=1.0">
     <title>signup</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>register here</h2>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="email" name="email"  placeholder="enter email address" reqiured>
            <input type="text" name="name" required placeholder="enter your name">

            <input type="password" name="password" required placeholder="enter your password">

            <input type="password" name="cpassword" required placeholder="confirm your password">
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account?<a href="login.php">login now</a></p>


</form>
</div>

</body>

</html>
