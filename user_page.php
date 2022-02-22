
<?php include ("php/server.php");
$username=$_SESSION['username'];
$user_check = "SELECT * FROM users WHERE username ='$username' LIMIT 1";
$result = mysqli_query($db,$user_check );
$user = mysqli_fetch_assoc($result);
$fname=$user['fname'];
$lname=$user['lname'];
$fullname=$fname." ".$lname;
$occupation=$user['occupation'];
$country=$user['country'];
$birthday=$user['birthday'];
$email=$user['email'];
$phone=$user['phone'];
$street=$user['street'];
$city=$user['city'];
$gender=$user['gender'];
$short_bio=$user['text_area'];
$facebook=$user['facebook'];
$linkedin=$user['linkedin'];
$youtube=$user['youtube'];
$instagram=$user['instagram'];
$skype=$user['skype'];
$google=$user['google'];
if (!isset($_SESSION['devName'])){
	header("location:inner-page.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="user_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
</head>



<body>
<div class="container emp-profile">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                                <img src="<?=$user['image']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                    <?php 
                                
                                    echo " $fullname \n";?> 
                                    </h5>
                                    <h6>
                                       <?php echo $occupation ?>
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>10/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <h4 class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</h4>
                                </li>
                                <li class="nav-item">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="./php/updatebio.php">Update bio</a>
                        <br>
                        <a href="user_page.php?logout=1">Log out</a>
                        <br>
                        <a href="index.php">Back Home</a>
                        <br>
                        <a href="files.php">Your files</a>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">  
                            <p>SOME LINKS WHERE YOU CAN FIND ME</p>
                            <a href='<?php echo $facebook; ?>' target='_blank' class="fa fa-facebook"></a>

<a href='<?php echo $google; ?>' target='_blank' class="fa fa-google"></a>
<a href='<?php echo $linkedin; ?>' target='_blank' class="fa fa-linkedin"></a>
<a href='<?php echo $youtube; ?>' target='_blank' class="fa fa-youtube"></a>
<a href='<?php echo $instagram; ?>' target='_blank' class="fa fa-instagram"></a>
<a href='<?php echo $skype; ?>' target='_blank' class="fa fa-skype"></a>

                            <p>Intro</p>
                            <div class="bioinfo">
                            <?php echo $short_bio ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $country?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>City</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $city ?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Street</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $street ?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $phone ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $email ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Birthday</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $birthday ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Gender</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $gender ?></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>           
        </div>
</body>

</html>