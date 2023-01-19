<?php
//This script will handle login
session_start();

// check if the user is already logged in
// if(isset($_SESSION['username']))
// {
//     header("location: welcome.php");
//     exit;
// }
require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: welcome.php");
                        }
                        else{
                            $password_err = "Incorrect Password";
                        }
                    }
                }
    }
}    
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/style.css">
    <script src="./JavaScript/validation.js"></script>
</head>
<body>
    <div class="login">
        <form name="f1" action="" method="post">
            <label for="chk" aria-hidden="true">Login</label>
            <input type="email" id="username" name="username" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <?php echo($password_err) ?>
            <button class="btn">Login</button>
        </form>
    </div>
</body>
</html>
