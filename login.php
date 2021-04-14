<?php

session_start();
include "db_connect.php";

?>
<!DOCTYPE html>
    <html>

    <head>
    <title>Prova</title>
    <link href="style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>

    <body>    
<b>Login</b>
<div class = "container">
    <form action="login.php" method="post">
    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp">
        <div id="password" class="form-text">We'll never share your password with anyone else.</div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <b> <a href="register.php">Register</a> </b>
    </form> 
</div>
    </body>

<?php


    if(isset($_POST['email']) && isset($_POST['password'])){

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

          $email = $_POST['email'];
          $password = $_POST['password'];

          if (empty($email)) {
            header("Location: login.php?error=Email is Required");
        }else if (empty($password)) {
            header("Location: login.php?error=Password is Required");
        }else {
    
            // Hashing the password
            $password = md5($password);
            
            $sql = "SELECT * FROM users WHERE email='$email' AND passwordd='$password'";
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) === 1) {
                // Accedi
                $row = mysqli_fetch_assoc($result);
                if ($row['passwordd'] === $password) {
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['ruolo'] = $row['ruolo'];
                    $_SESSION['email'] = $row['email'];
    
                    header("Location: home.php");
    
                }else {
                    header("Location: login.php?error=Incorect Email or Password");
                }
            }else {
                header("Location: login.php?error=Incorect Email or Password");
            }
    
        }
        
    }


?>

</html>