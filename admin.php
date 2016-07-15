<?php 
session_start();
 include 'function.php';
$username=$_SESSION['username'];
if(!isset($username))
{
   
    header('Location: index.php');
    exit();
}
  

   $conn_login=connect('localhost','root','','login');


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
    <ul class="nav_menu_admin">
        <li><a href="#profile">Post</a></li>
        <li><a href="#notice">Notice Board</a></li>
        <li><a href="#result">Publish Result</a></li>
        <li><a href="#files">Upload Slides</a></li>
        <li><a href="#inbox">Inbox</a></li>
        
        
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
            
            
        <div class="p_image">
            <H2>Welcome Admin</H2>
            <h3>Post Notice</h3>
          <form method="post" action="admin.php">
              <h5>Title</h5>
              <input type="text" name="title" size="40" placeholder="Title here" autofocus>
              <div class="details">
                <h5>Details</h5>
              <textarea rows="5" cols="60" name="details"  placeholder="Whats About?"autofocus></textarea>
              </div>
              <input type="submit" name="submit" value="Post">

           </form>

           <?php
           if(isset($_POST['submit'])){

         $title=$_POST['title'];
           $details=$_POST['details'];

        $result=query_post_notice($title,$details);

          if($result)
          {
            echo("<br>Posted");
          }

          else{
            echo("<br>Failed");
          }
        }
           ?>
       </div>       
                       
       </div>

        <div class="section section_with_padding" id="notice"> 
            <h1>Notice Board</h1>
            
            <div class= "notice">
                  <table>
                    <thead>
                             
                              <th>Date</th>
                              <th>Time</th>
                              <th>Notice</th>
                              <th>Edit</th>
                             
                    </thead>
                     <?php    
                          $result_notice=query_for_notice();
                         while($row=mysql_fetch_object($result_notice))
                         {  
                                  $dateStr = strtotime($row->date);
                                  $date = date("d M,Y", $dateStr);

                                  $timeStr = strtotime($row->time);
                                  $time = date("g:i A", $timeStr);
                            echo '<tr>
                                 <td id="date">' .$date.'</td>
                                 <td id="time">' .$time.'</td>

                                 <td id="heading"> '.$row->notice_heading.'<a id="see" href="#files"> See more</a> </td>
                                 
                                
                                 </tr>';
                        }

                           
                    ?>

                 </table>     
            </div>
            <div class="clear h40"></div>
           
            
        </div> 
        <div class="section section_with_padding" id="result"> 
            <h1>Result</h1>
             <h1>Under Construction</h1>
                
            
        </div> 






        <div class="section" id="files"> 
            <h1>files</h1>
            
         <?php

                         /*   $result_file=query_for_file_show();
                           while($row=mysql_fetch_object($result_file))
                        {
                                echo '<img src="./' . $result_file . '" />';
                        }
                 */



$upload_errors = array(
    UPLOAD_ERR_OK         => "No errors.",
    UPLOAD_ERR_INI_SIZE   => "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE  => "Larger than form MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL    => "Partial upload.",
    UPLOAD_ERR_NO_FILE    => "No file.",
    UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
    UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
    UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
);

if(isset($_POST['submit'])) {
  $tmp_file = $_FILES['file_upload']['tmp_name'];
  $target_file = basename($_FILES['file_upload']['name']);
  $upload_dir = "files/";
  
  
  if(move_uploaded_file($tmp_file, $upload_dir.$target_file)) {
    $message = "File uploaded successfully.";
    $file = $upload_dir. $_FILES['file_upload']['name'];
    $filename= $_FILES['file_upload']['name'];
      
      $conn=connect('localhost','root','','login');

    //$image = mysql_real_escape_string($image);

        $query= insert_query_for_file($filename,$file);
  
  } 
  
  else {
    $error = $_FILES['file_upload']['error'];
    $message = $upload_errors[$error];
  }
  
} 

?>  <?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
    <form action="admin.php#files" enctype="multipart/form-data" method="POST">

      <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
      <input id="browse" type="file" name="file_upload" />
      <br>
      <input id="upload"type="submit" name="submit" value="Upload" />
    </form>
              
        </div> 
        





        <div class="section section_with_padding" id="inbox"> 
            <h1>Inbox</h1> 
            
                    
             <?php    
                          $result_inbox=query_for_message();
                         while($row=mysql_fetch_object($result_inbox))
                         {  
                                  $dateStr = strtotime($row->date);
                                  $date = date("d M,Y", $dateStr);

                                  $timeStr = strtotime($row->time);
                                  $time = date("g:i A", $timeStr);
                            
                                    echo "Name: " .$row->username."<br>Mail: ".$row->email."<br>Time: "
                             .$row->datetime."<br>Messsage: ".$row->message."<br>";

                                 
                                
                        echo "<br>"   ;      
                        }


                           
                    ?>
              
          
            
        </div> 
    </div> 
</div>

</div>

</body> 
</html>