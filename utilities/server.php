<?php
   session_start();
   require 'confirm_email.php';
  
   
   $errors = array();

   $db = mysqli_connect('localhost', 'root', '', 'website_php');


   //reg user

   if(isset($_POST['reg_user'])){

   	 $username = mysqli_real_escape_string($db, $_POST['username']);
   	 $email    = mysqli_real_escape_string($db, $_POST['email']);
   	 $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
   	 $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


   	 if ($password_1 != $password_2) {
   	 	array_push($errors, "Passwords do not match");
   	 }
     

   	 $user_check = "SELECT * FROM users WHERE username ='$username' OR email ='$email' LIMIT 1";
   	 $result = mysqli_query($db,$user_check );
   	 $user = mysqli_fetch_assoc($result);

   	 if ($user) {
   	 	if ($user['username'] === $username) {
   	 		array_push($errors, "Username Already exists"); 	 	
   	 	}

   	 	if ($user['email'] === $email) {
   	 		array_push($errors, "Email already exists");
   	 	}
   	 }

   	   //inser data into the db
   	   if (count($errors) ==0) {
		$pass_reset=0;	  
   	   	$password = md5($password_1);  //password encryption
		$token=bin2hex(random_bytes(16));	
   	   	$query = "INSERT INTO users(username,email,password,token) VALUES('$username', '$email', '$password','$token')";	 
		confirmEmail($email,$username,$token,$db,$query,$pass_reset);
         } else {
			  echo "Could not register your credentials.Please try again!";
		  } 
   }

   //Login user

   if (isset($_POST['login_user'])) {
   	$username = mysqli_real_escape_string($db, $_POST['username']);
   	 $password  = mysqli_real_escape_string($db, $_POST['password']);
   	 	$password = md5($password);
        $check_for_password = "SELECT * FROM users WHERE password='$password' LIMIT 1";
		$check_for_username="SELECT * FROM users WHERE username='$username' LIMIT 1";
		
   	 	$result_password = mysqli_query($db, $check_for_password);
		$result_username = mysqli_query($db, $check_for_username);
        if (mysqli_num_rows($result_username)==0) {
	    array_push($errors, "Wrong Username.");
        }
        if (mysqli_num_rows($result_password)==0) {
        	array_push($errors, "Wrong Password.");
        }
		if (count($errors) ==0) {
			$user_check = "SELECT * FROM users WHERE username ='$username' LIMIT 1";
			$result = mysqli_query($db,$user_check );
			$user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
			$_SESSION['email']=$user['email'];
			$_SESSION['validation']=$user['validation'];
		}
   	 
   }



   //reset password


	if(isset($_POST['reset_user'])){
	$pass_reset=0;
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$token=mt_rand(10000000,99999999);
	    $password = md5($token);
		$check_for_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$check_for_username="SELECT * FROM users WHERE username='$username' LIMIT 1";
		$result_email = mysqli_query($db, $check_for_email);
		$result_username = mysqli_query($db, $check_for_username);
		if (!mysqli_num_rows($result_email)) {
			array_push($errors, "Wrong Email address.");
		}
		if (!mysqli_num_rows($result_username)) {
			array_push($errors, "Wrong Username.");
		}
		if (count($errors) ==0) {
			$pass_reset=1;
			$query = "UPDATE users SET password='$password' WHERE username ='$username'";	   
			mysqli_query($db,$query);
			confirmEmail($email,$username,$token,$db,$query,$pass_reset);
		}
   	   
	else{
		array_push($errors, "Could not reset password.");
	}
	
}

if(isset($_POST['update_fname'])){
	$username=$_SESSION['username'];
	$fname=mysqli_real_escape_string($db, $_POST['fname']);
	$query = "UPDATE users SET fname='$fname' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_lname'])){
	$username=$_SESSION['username'];
	$lname=mysqli_real_escape_string($db, $_POST['lname']);
	$query = "UPDATE users SET lname='$lname' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_nr'])){
	$username=$_SESSION['username'];
	$phone=mysqli_real_escape_string($db, $_POST['phone']);
	$query = "UPDATE users SET phone='$phone' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_birthday'])){
	$username=$_SESSION['username'];
	$birthday = mysqli_real_escape_string($db, $_POST['birthday']);
	$query = "UPDATE users SET birthday='$birthday' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_gender'])){
	$username=$_SESSION['username'];
	$gender = mysqli_real_escape_string($db, $_POST['gender']);
	$query = "UPDATE users SET gender='$gender' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_occupation'])){
	$username=$_SESSION['username'];
	$occupation = mysqli_real_escape_string($db, $_POST['occupation']);
	$query = "UPDATE users SET occupation='$occupation' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_account'])){
	$username=$_SESSION['username'];
    $account_name = mysqli_real_escape_string($db, $_POST['social_media']);
	$account_link = mysqli_real_escape_string($db, $_POST['account']);
	$query = "UPDATE users SET $account_name='$account_link' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_short_bio'])){
	$username=$_SESSION['username'];
	$short_bio = mysqli_real_escape_string($db, $_POST['short_bio']);
	$query = "UPDATE users SET text_area='$short_bio' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_country'])){
	$username=$_SESSION['username'];
	$country = mysqli_real_escape_string($db, $_POST['country']);
	$query = "UPDATE users SET country='$country' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_city'])){
	$username=$_SESSION['username'];
	$city = mysqli_real_escape_string($db, $_POST['city']);
	$query = "UPDATE users SET city='$city' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_street'])){
	$username=$_SESSION['username'];
	$street = mysqli_real_escape_string($db, $_POST['street']);
	$query = "UPDATE users SET street='$street' WHERE username ='$username'";
	mysqli_query($db,$query);
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}
if(isset($_POST['update_all'])){
	$username=$_SESSION['username'];
	$street = mysqli_real_escape_string($db, $_POST['street']);
	if(strlen($street)!=0){
		$query = "UPDATE users SET street='$street' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
   
	$city = mysqli_real_escape_string($db, $_POST['city']);
	if(strlen($city)!=0){
		$query = "UPDATE users SET city='$city' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$country = mysqli_real_escape_string($db, $_POST['country']);
	if($country!='nocountry'){
		$query = "UPDATE users SET country='$country' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$short_bio = mysqli_real_escape_string($db, $_POST['short_bio']);
	if(strlen($short_bio)!=0){
		$query = "UPDATE users SET text_area='$short_bio' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$account_name = mysqli_real_escape_string($db, $_POST['social_media']);
	$account_link = mysqli_real_escape_string($db, $_POST['account']);
	if(($account_name!='Select an account you would like to add')&&(strlen($account_link)!=0)){
		$query = "UPDATE users SET $account_name='$account_link' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$occupation = mysqli_real_escape_string($db, $_POST['occupation']);
	if($occupation!='Select an occupation'){
		$query = "UPDATE users SET occupation='$occupation' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$gender = mysqli_real_escape_string($db, $_POST['gender']);
	if($gender!='Select your gender'){
		$query = "UPDATE users SET gender='$gender' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$birthday = mysqli_real_escape_string($db, $_POST['birthday']);
	if(!empty($birthday)){
		$query = "UPDATE users SET birthday='$birthday' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$phone=mysqli_real_escape_string($db, $_POST['phone']);
	if(strlen($phone)!=0){
		$query = "UPDATE users SET phone='$phone' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$lname=mysqli_real_escape_string($db, $_POST['lname']);
	if(strlen($lname)!=0){
		$query = "UPDATE users SET lname='$lname' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	$fname=mysqli_real_escape_string($db, $_POST['fname']);
	if(strlen($fname)!=0){
		$query = "UPDATE users SET fname='$fname' WHERE username ='$username'";
		mysqli_query($db,$query);
	}
	
	function function_alert($message) {
        echo "<script>alert('$message');</script>";
	}
	  function_alert("YOU SUCCESFULLY UPDATED YOUR PROFILE!");
	
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header('location: index.html');
}


if (isset($_POST['send_message'])) {
$name= mysqli_real_escape_string($db, $_POST['name']);
$email= mysqli_real_escape_string($db, $_POST['email']);
$subject= mysqli_real_escape_string($db, $_POST['subject']);
$message= mysqli_real_escape_string($db, $_POST['message']);
sendMessage($email,$name,$subject,$message);
}


if (isset($_POST['load']) && isset($_FILES['uploadfile'])) {

	$img_name = $_FILES['uploadfile']['name'];
	$img_size = $_FILES['uploadfile']['size'];
	$tmp_name = $_FILES['uploadfile']['tmp_name'];
	$error = $_FILES['uploadfile']['error'];


	if ($error === 0) {
		if ($img_size > 20000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: updatebio.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("images_users/IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = '../'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
        $username_img=$_SESSION['username'];
        $query = "UPDATE users SET image='$new_img_name' WHERE username ='$username_img'";	   
        mysqli_query($db,$query);
			}else {
				$em = "You can't upload files of this type";
		        header("Location: updatebio.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: updatebio.php?error=$em");
	}
	
}


if (isset($_POST['load']) && isset($_FILES['file'])) {
	$file_name = $_FILES['file']['name'];
	$file_size = $_FILES['file']['size'];
	$tmp_name = $_FILES['file']['tmp_name'];
	$error = $_FILES['file']['error'];
	$file_upload_path = './files/'.$file_name;
	$file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	if (in_array($file_extension, ['zip','pdf','docx','jpg','png','jpeg','txt'])) {
		if($error){
			$error='Error.Upload your file again!';
		header("location:files.php?error=$error");
		}
		if($file_size >10000000){
			$error='File exceeds 10MB!';
		header("location:files.php?error=$error");
		}
		move_uploaded_file($tmp_name, $file_upload_path);
		$username_file=$_SESSION['username'];
		$query = "INSERT INTO files(username,size,name) VALUES('$username_file','$file_size','$file_name')";	   
       if(mysqli_query($db,$query)){
		echo "You've succesfully uploaded your file!";
	   }else{
		echo "We could'nt upload your file!";

	   }
		
	}else {
		$error='WRONG FILE EXTENSION!';
		header("location:files.php?error=$error");
	}




}



if(isset($_GET['file_id'])){
	$id=$_GET['file_id'];
	$sql = "SELECT*FROM files WHERE id =$id";
	$results_sql=mysqli_query($db,$sql);
	$all_files=mysqli_fetch_assoc($results_sql);
	$all_files_path= './files/'.$all_files['name'];
	if(file_exists($all_files_path)){
		header('Content-Type: application/octet-stream');
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment;filename='.basename($all_files_path));
		header('Expires:0');
		header('Cache-Control:must-revalidate');
		header('Pragma:public');
		header('Content-Length:'.filesize('./files/'.$all_files['name']));
		readfile('./files/'.$all_files['name']);
		$donwload_counter=$all_files['downloads'];
		$donwload_counter++;
		// $update_q = "INSERT INTO files(donwloads) VALUES('$donwload_counter')";
		$update_q="UPDATE files SET downloads='$donwload_counter' WHERE id='$id'";
		mysqli_query($db,$update_q);
		exit;
		
	}
	
}

$username=$_SESSION['username'];
$query = "SELECT*FROM files WHERE username ='$username'";
$results_files=mysqli_query($db,$query);
$files=mysqli_fetch_all($results_files,MYSQLI_ASSOC);

?>