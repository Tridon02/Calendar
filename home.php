<?php 
   session_start();
   include "db_connect.php";
   if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

      
      	<?php if ($_SESSION['ruolo'] == 'Azienda') {?>
            <h5 class="container d-flex justify-content-center align-items-left">Azienda</h5>

      		<!-- For Admin -->
              <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
           
            
      	<?php }else { ?>
      		<!-- FORE USERS -->
              <h5 class="container d-flex justify-content-center align-items-left">Utenti</h5>
            
            <!-- Search bar -->
            <form action="home.php" method="post">
            <div class="input-group mb-3">
            <input type="text" name="name" value="" placeholder="Username" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Cerca</button>
            </div>
            </form>
            <div class="container d-flex justify-content-center align-items-center">
            <?php
            error_reporting(0);
            $input = $_POST["name"];

            if($input != ''){
            $sql=mysqli_query($conn,"SELECT * FROM users WHERE name = '$input'");
            if(mysqli_num_rows($sql)<1)  //Se non ci sono inviti uguali
            {
                echo "Nessuna azienda con questo nome";
            }
            else{
                $result = mysqli_query($conn,"SELECT * FROM users WHERE name = '$input'");
                while($row = mysqli_fetch_array($result)) {

                ?> <a href="login.php"> <?php echo $row['name']; ?> </a> <?php
                echo ".  Email :  .";
                echo $row['email'];
                
                }
            }
        }
            ?>
            </div>


              <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
              </div>
			</div>
      	<?php } ?>
      </div>
</body>
</html>
<?php }else{
	header("Location: login.php");
} ?>

