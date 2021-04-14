<?php

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

        <b>Register</b>
<div class = "container">
    <form action="register.php" method="post">
    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
              
			  <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success" role="alert">
				  <?=$_GET['success']?>
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

        <label class="form-label">Select your role!</label>

    <select class="form-select mb-3" name="role" aria-label="Default select example">
        <option selected value="Azienda">I want to be looked for</option>
        <option value="Utente">I want to make appointments</option>
    </select>
    <button type="submit" class="btn btn-primary">Submit</button>
    <b> <a href="login.php">Login</a> </b>
    </form> 
    
</div>

</body>

<?php


    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])){

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

          $email = $_POST['email'];
          $password = $_POST['password'];
          $role = $_POST['role'];
          $word = "@";

          if (empty($email)) {
            header("Location: register.php?error=Email is Required");
        }else if (empty($password)) {
            header("Location: register.php?error=Password is Required");
        }else {
            if(strpos($_POST["email"],$word) == false){
                header("Location: register.php?error=Use a valid email");
            }
            else{
            // Hashing the password
            $password = md5($password);
            
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) < 1) {
                // Registrati
                
                $sql = mysqli_query($conn, "INSERT INTO users (ruolo,email,passwordd) VALUES ('$role','$email','$password')");
                header("Location: register.php?success=Succesfully registered , go back to login");
            
            }else {
                header("Location: register.php?error=Someone already registered this email");
            }
        }
    }
    }
?>
</html>