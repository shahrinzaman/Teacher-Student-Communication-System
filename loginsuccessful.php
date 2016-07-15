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

     $result_file=query_for_file_show();



?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSE</title>

	<link href="templatemo_style.css" type="text/css" rel="stylesheet" /> 
	<script type="text/javascript" src="js/jquery.min.js"></script> 
	<script type="text/javascript" src="js/jquery.scrollTo-min.js"></script> 
	<script type="text/javascript" src="js/jquery.localscroll-min.js"></script> 
	<script type="text/javascript" src="js/init.js"></script> 
    
<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />


</head> 
<body> 
<div id="templatemo_wrapper">
<div id="templatemo_header">
    <div id="site_title">CSE</div>
    <ul class="nav_menu">
        <li><a href="#profile">Profile</a></li>
        <li><a href="#notice">Notice</a></li>
        <li><a href="#result">Result</a></li>
       
        <li><a href="#contact">Contact</a></li>
        
        
    </ul>
    
    <div class="social_button">
        
    	<a href="https://www.facebook.com/groups/ruetcse10"><img src="images/facebook.png" alt="Facebook" /></a>
        <div class="clear"></div>
    </div>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
       
</div>

<div id="templatemo_main">
	<div id="content"> 
       	<div id="profile" class="home_slider">
            
             <?php      
                    echo "<h2>Welcome";
                    echo  "   ".$username; 
                    echo "</h2>";
                    echo "<br>";
            ?>
            <div class="p_image">
                    <?php

                     while($row=mysql_fetch_object($results))
                        {
                         
                          if($row->id==$member_id)
                          {  
                            echo '<img src="./' . $result_image . '" />';
                             echo "Name: " .$row->fullname."<br>Roll: ".$row->roll."<br>Dept: "
                             .$row->dept."<br>Mail: ".$row->mail."<br>";
                              
                          }

                        }

                    ?>  
             </div>       
                 

            <br>
            <a href="upload.php">Upload Image</a>
                 </div>

        <div class="section section_with_padding" id="notice"> 
            <h1>Notice Board</h1>
            
            <div class= "notice">
                  <table>
                    <thead>
                             
                              <th>Date</th>
                              <th>Time</th>
                              <th>Notice</th>
                             
                    </thead>
                     <?php    

                         while($row=mysql_fetch_object($result_notice))
                         {      
                                  $dateStr = strtotime($row->date);
                                  $date = date("d M,Y", $dateStr);

                                  $timeStr = strtotime($row->time);
                                  $time = date("g:i A", $timeStr);
                                  $details=$row->notice_details;
                                  $no=$row->no;
                            echo '<tr>
                                 <td id="date">' .$date.'</td>
                                 <td id="time">' .$time.'</td>
                                 <td id="heading"> '.$row->notice_heading.'<a id="see" href="#files"> see</a> </td>
                                 </tr>';
                        }
                    ?>

                 </table>	    
            </div>
            <div class="clear h40"></div>
           
            
        </div> 
        <div class="section section_with_padding" id="result"> 
            <h1>Result</h1>
             <table>
                     <thead>
                             
                              <th>Date</th>
                            
                              <th>Files</th>
                             
                    </thead>
            
                    
                     <?php  

                     
                        
                        while($row=mysql_fetch_object($result_file))
                        {

                            $file_name = $row->file_name;
                            $file_path=$row->file_path;

                            $dateString = strtotime($row->date_file);
                            $date = date("d M,Y", $dateString);

                               

                           // echo   "<a id=file_link href=\"" .$file_path."\" target="_blank"> $file_name </a>";

                        echo "<tr>
                                 <td id='date'>$date</td>
                                
                                 <td id='file'> <a id=file_link href=\"" .$file_path."\" target='_blank'> $file_name </a> </td> 
                                 </tr>";

                        } 
                        

                        ?>
                    </table>
                
           
        </div> 


        <div class="section" id="files"> 
            <h1>Details</h1>
           <?php
                        echo $details;
                   ?> 
            
        </div> 
        <?php
        /*

      }
      */
      ?>
        





        <div class="section section_with_padding" id="contact"> 
            <h1>Contact</h1> 
            <div class="half left">
                <h3>Send Message to Admin </h3>
                <div id="contact_form">
                    <form method="post" action="loginsuccessful.php#contact">
                        <label for="author">Name:</label> 
                        	<input name="username" type="text" class="required input_field" maxlength="30" />
                        <label for="email">Email:</label> 
                        	<input name="email" type="text" class="validate-email required input_field" id="email" maxlength="30" />
                      <label for="message">Message:</label> 
                        	<textarea id="message" name="message" rows="0" cols="0" class="required"></textarea>
                        <input type="submit" class="submit_btn left" name="submit" id="submit" value="Send" />
                        <input type="reset" class="submit_btn right" name="Reset" id="reset" value="Reset" />
                    </form>

                    <?php

                        if(isset($_POST['submit'])){

                     
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

                        }
                        ?>






                </div>
            </div>
            
            <div class="half right">
             
                
                <div class="clear h20"></div>

            </div>
        </div> 
    </div> 
</div>

</div>

</body> 
</html>