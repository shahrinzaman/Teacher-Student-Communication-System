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


	 $conn_login=connect('localhost','root','','login');
	// $conn_teacher=connect('localhost','root','','teacher');
     $results=query_details();

     $result_image=query_for_image($member_id);

     $result_notice=query_for_notice();

?>



<html>
<body>
<h2>Login Successful</h2>
 <?php      
        echo "<h3>Welcome";
	    echo  "   ".$username; 
	    echo "</h3>";
 		echo "<br>";
        
		 while($row=mysql_fetch_object($results))
		 	{
		     
		      if($row->id==$member_id)
		      {
		      	 echo "Name: " .$row->fullname."<br>Roll: ".$row->roll."<br>Dept: ".$row->dept."<br>Mail: ".$row->mail."<br>";
		      	 echo '<img src="./' . $result_image . '" />';
		      }

		 	}

           
		 	while($row=mysql_fetch_object($result_notice))
		 	{
		      	 echo "<br>No: " .$row->no."<br>date: ".$row->date."<br>Heading: ".$row->notice_heading."<br>Details: ".$row->notice_details."<br>";

		 	}







	    ?>  
<br>
<a href="upload.php">Upload Image</a>
<a href="logout.php">logout</a>
</body>
</html>