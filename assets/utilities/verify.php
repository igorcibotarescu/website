<?php
require 'server.php';
$errors=array();
$valid=2;
if(isset($_GET['token'])){
    $token=$_GET['token'];
    $query = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
    $results = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($results);
    if (mysqli_num_rows($results)==1){
    $username=$user['username'];
        if($user['validation']==0){
            $query="UPDATE users SET validation='1' WHERE username ='$username'";
            mysqli_query($db, $query);
            array_push($errors,'Email has been successfully verified');
            $valid=0;
        }elseif($user['validation']==1){
            array_push($errors, 'Email is already verified');
            $valid=0;
        }
    } 
    else {
        array_push($errors,  "Invalid verification link!");
        $valid=1;
} 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML FILE</title>
</head>
<body>
<?php require 'errors.php'; ?>
<?php if (($valid)==0) :?> 
          <h3>
     <?php   
            echo 'Log in on the link below:';
      ?>
          </h3>
          <a href="../login_page.php">LogIn</a>
       <?php endif ?>

       <?php if (($valid)==1) :?> 
          <h3>
     <?php   
            echo 'You can try to register again on the link below';
      ?>
          </h3>
          <a href="../login_page.php">Register</a>
       <?php endif ?>

       <?php if (($valid)==2) :?> 
          <h3>
     <?php   
            echo 'You tried to access a forbidden page!';
      ?>
          </h3>
          <a href="../index.html">Home</a>
       <?php endif ?>


</body>
</html>
