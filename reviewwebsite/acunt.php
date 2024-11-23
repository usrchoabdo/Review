<?php
if(isset($_POST["SignUp"])){
    $con=mysqli_connect("localhost","root","","mini_projet");
    $user=$_POST["user"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $user_error = $email_error = $pass_error = '';
    if(preg_match("#^[a-zA-Z0-9]+$#",$user)&&strlen($user)>=4){
    if(preg_match("#^[a-zA-Z0-9]+@[a-z]{5,}\.[a-z]{2,3}$#",$email)){
        if(strlen($pass)>=8){
            $sql="INSERT into users(usename,email,passwordd) values
             ('$user','$email','$pass')";
            if(mysqli_query($con,$sql))  header("location:login.php");
        }else $pass_error ="The password must be at least 8 characters long";
    }else $email_error ="The email address is incorrect";
}else $user_error ="Username must be 4+ characters and alphanumeric";
mysqli_close($con); 
}
?>
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

        input[type="text"], input[type="email"], input[type="password"] {
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
        .error {
            color: red;
            font-size: 12px;
            margin-top: -5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <form method="post">
    <h1>Create Account</h1>
        <input type="text" name="user" placeholder="Username" required value="<?php echo isset($user) ? $user : ''; ?>"><br>
        <div class="error">
            <?php if (isset($user_error)) echo $user_error; ?>
        </div>
        <input type="text" name="email" placeholder="Email" required value="<?php echo isset($email) ? $email : ''; ?>"><br>
        <div class="error">
            <?php if (isset($email_error)) echo $email_error; ?>
        </div>
        <input type="text" name="pass" placeholder="Password" required value="<?php echo isset($pass) ? $pass : ''; ?>"><br>
        <div class="error">
            <?php if (isset($pass_error)) echo $pass_error; ?>
        </div>
        <input type="submit" value="Sign Up" name="SignUp">
    </form>
</body>
</html>
