<?php
session_start();
include 'function.php';

$username=$_SESSION['username'];
$member_id=$_SESSION['id'];

if(!isset($username))
{
   
    header('Location: index.php');
    exit();
}

// In an application, this could be moved to a config file
$upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
	  UPLOAD_ERR_OK 				=> "No errors.",
	  UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);

if(isset($_POST['submit'])) {
	$tmp_file = $_FILES['image_upload']['tmp_name'];
	$target_file = basename($_FILES['image_upload']['name']);
	$upload_dir = "images/";
  
	
	if(move_uploaded_file($tmp_file, $upload_dir.$target_file)) {
		$message = "File uploaded successfully.";
		$image = $upload_dir. $_FILES['image_upload']['name'];
	    
	    $conn=connect('localhost','root','','login');

		//$image = mysql_real_escape_string($image);

        $query= insert_image_query($member_id,$username,$image);
	
	} 
	else {
		$error = $_FILES['image_upload']['error'];
		$message = $upload_errors[$error];
	}
	
}	

?>

<html>
	<head>
		<title>Upload</title>
	</head>
	<body>


		<?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
		<form action="upload.php" enctype="multipart/form-data" method="POST">

		  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		  <input type="file" name="image_upload" />

		  <input type="submit" name="submit" value="Upload" />
		</form>
	    <a href="loginsuccessful.php">Profile</a>
	</body>
</html>