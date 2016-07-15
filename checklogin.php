<?php
   session_start();
  include 'function.php';



	 $conn=connect('localhost','root','','login');
     
	 $username=$_POST['username'];
	 $password=$_POST['password'];
	 $remember=$_POST['remember'];

     if( empty($username)|| empty($password))
		{

			$status="provide valid name & mail";
			header("location:index.php");

		}

else {
	     $_SESSION['username'] = $username;

	 
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		

		$result=query($username,$password);

		$count=mysql_num_rows($result);

	

		if($count==1){

		        if ($remember=="yes")
		        	{
						setcookie("username", $username, time()+7600); 
						
						while($row=mysql_fetch_object($result))
							 	{
							   	  $temp_id=$row->id;
							  	  $_SESSION['id']=$temp_id;							  	  							  	  
							  	  $role=$row->role;
							 	}
						if($role=="admin"){	 	
						header("location:admin.php");	 
						}
						else	
						header("location:loginsuccessful.php");	
					 }

		 		else  
				    {
						
						while($row=mysql_fetch_object($result))
							 	{
							   	  $temp_id=$row->id;
							  	  $_SESSION['id']=$temp_id;
							 	  $role=$row->role;
							 	}

						if($role=="admin"){	 	
							header("location:admin.php");	 
							}
						else	
						    header("location:loginsuccessful.php");	
					}	 
		}


		else {
		  $status="provide valid name & mail";
		  header("location:index.php");
	   }
}





			    // 	while($row=mysql_fetch_object($result))
						 // {
						 //   	  $role=$row->role;	
						 // }	

?>
