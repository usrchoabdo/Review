<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .signup-text {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .signup-text a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
            text-align: left;
        }
    </style>
</head>
<body>
    <form method="post">
    <h1>Sign In</h1>
        <input type="text" name="user" placeholder="Username or Email" value="<?php echo isset($_POST['user']) ? $_POST['user'] : ''; ?>" required ><br>
        <input type="text" name="pass"  placeholder="Password" value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>" required><br>
        <?php
if(isset($_POST["SignIn"])){
    $con=mysqli_connect("localhost","root","","mini_projet");
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    if(preg_match("#@#",$user)){
    $sql="SELECT * FROM users WHERE email='$user' and passwordd='$pass'";
    $r=mysqli_query($con,$sql);
    if(mysqli_num_rows($r)>0){
    }else echo"The username or password is incorrect";
    }else{

        $sql="SELECT * FROM users WHERE usename='$user' and passwordd='$pass'";
    $r=mysqli_query($con,$sql);
    if(mysqli_num_rows($r)>0){
        header("location:login.php");
    }else echo '<div class="error-message">The username or password is incorrect</div>';
    }
    mysqli_close($con); 
}
?>
        <p class="signup-text">Don't have an account? <a href="acunt.php">Sign up</a></p>
        <input type="submit" value="Sign In" name="SignIn">
    </form>
</body>
</html>
