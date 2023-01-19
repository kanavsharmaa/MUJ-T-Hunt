<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db_name = "logindb";

    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  

    include('index.php');  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select * from login where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo "<h1><center> Login successful </center></h1>";  
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?>  
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
                <form name="f1" action="index.php" onsubmit = "return validation()" method="post">
                    <label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" id="user" name="user" placeholder="Username" required="">
					<input type="email" id="email" name="email" placeholder="Email" required="">
					<input type="password" id="pass" name="pass" placeholder="Password" required="">
					<button class="btn">Sign up</button>
                </form>
			</div>

			<div class="login">
                <form action="#" method="post">
                    <label for="chk" aria-hidden="true">Login</label>
					<input type="email" id="email" name="email" placeholder="Email" required="">
					<input type="password" id="pass" name="pass" placeholder="Password" required="">
					<button class="btn">Login</button>
                </form>
					<?php if($count == 1){  
            echo "<h1><center> Login successful </center></h1>";  
        }  ?>
			</div>
	</div>
</body>
</html>