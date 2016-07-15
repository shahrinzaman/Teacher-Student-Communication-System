
<?php
 include 'function.php';
$con=connect('localhost','root','','login');
     
	 $username=$_POST['username'];
	 $email=$_POST['email'];
	 $message=$_POST['message'];

$result= query_send_message($username,$email,$message);

	if($result)
	{
		echo("<br>Message Sent");
	}

	else{
		echo("<br> Failed");
	}
?>