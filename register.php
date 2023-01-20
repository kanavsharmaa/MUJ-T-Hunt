<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

// Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Email cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This email is already registered"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);

// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// // Check for confirm password field
// if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
//     $password_err = "Passwords should match";
// }


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
	<div class="container">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
                <form name="f1" action="" method="post">
                    <label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" id="username" name="username" placeholder="E-mail" required>
					<!-- <input type="email" id="email" name="email" placeholder="Email" required> -->
					<input type="password" id="password" name="password" placeholder="Password" required>
					<button class="btn">Sign up</button>
                    <?php echo($username_err) ?>
                    <?php echo($password_err) ?>
                </form>
                <a href="login.php">
                    <button class="btn">Login</button>
                </a>
			</div>
	</div>
</body>
</html>