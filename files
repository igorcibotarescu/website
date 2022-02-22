<?php include ("php/server.php");

if(!isset($_SESSION['username'])){
	header("location:login_page.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Files</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


</head>


<body>
    <h3>
    <?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
    </h3>


<form action="files.php" method="post" enctype="multipart/form-data">
<h3>Upload files here</h3>
<input type="file" name="file">
<input type="submit" name="load" value="Upload">
<!-- <button type="submit" name="downloads">Your downloads</button> -->
</form>
    <br>
    <br>
    <br>
    <br>
    <br>
<table>
    <thead>
        <th>Name</th>
        <th>Size</th>
        <th>Downloads</th>
    </thead>
    <tbody>
        <?php foreach($files as $index):?>
            <tr>
                <td><?php echo $index['name'];?></td>
                <td><?php echo $index['size'];?></td>
                <td><?php echo $index['downloads'];?></td>
                <td><a href="files.php?file_id=<?php echo $index['id'];?>">Donwload it here!</a></td>
            </tr>
            <?php endforeach;?>
    </tbody>
</table>

</body>


</html>

