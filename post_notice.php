
<?php
 include 'function.php';
$con=connect('localhost','root','','login');
     
	 $title=$_POST['title'];
	 $details=$_POST['details'];

$result=query_post_notice($title,$details);

	if($result)
	{
		echo("<br>Input data is succeed");
	}

	else{
		echo("<br>Input data is fail");
	}
?>