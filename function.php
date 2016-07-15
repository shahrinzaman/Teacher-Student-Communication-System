<?php

function connect($host,$dbusername,$password,$db){
    $conn= mysql_connect($host,$dbusername,$password);
 	 mysql_select_db($db,$conn);
 	 return $conn; 
 }

 function query($username,$password){

 	$sql="SELECT * FROM members WHERE username ='$username' and password='$password'";
 	$result= mysql_query($sql);
 	return $result;
 }

 function query_details(){

 	$details="SELECT * FROM member_details";
 	$result_details= mysql_query($details);
 	return $result_details;
 }



function query_for_image($id){   
    $member_id=$id;
    $query_image= "SELECT image_path FROM imagelink WHERE id = '$member_id'";
    $result_image = mysql_query($query_image) or die('Error, query failed');
    $row = mysql_fetch_assoc($result_image);
    $filePath = $row['image_path'];
    return $filePath;

}

function query_for_file_show(){

    $query_file= "SELECT file_path,file_name,date_file FROM filelink";
    $result_file = mysql_query($query_file) or die('Error, query failed');
    //$row = mysql_fetch_assoc($result_file);
    //$filePath = $row['file_path'];
    
    return $result_file;
}


function insert_image_query($member_id,$username,$image){
	$query = "INSERT INTO imagelink(id,name,image_path) 
    VALUES('".$member_id."','".$username."','".$image."')";
    mysql_query($query) or trigger_error(mysql_error()." in ".$query);
   return $query;
 }


 function query_for_notice(){

 	$sql="SELECT * FROM notice_board ORDER BY date_time DESC";
 	$notice= mysql_query($sql);
 	return $notice;
 }



function query_post_notice($title,$details){
$order = "INSERT INTO notice_board
            (date_time,notice_heading,notice_details,date,time)
            VALUES
            (now(),'$title','$details',now(),now())";

$result = mysql_query($order);
return $result;
}



function insert_query_for_file($filename,$file){
    $query = "INSERT INTO filelink(file_name,file_path,date_file) 
    VALUES('$filename','$file', now())";



    mysql_query($query) or trigger_error(mysql_error()." in ".$query);
   
   return $query;
 }



 function query_notice_details($no){

    $sql="SELECT notice_details FROM notice_board where no=$no";
    $notice= mysql_query($sql);
    return $notice;

 }


function query_send_message($username,$email,$message){
$msg = "INSERT INTO inbox_admin
            (date,time,datetime,username,email,message)
            VALUES
            (now(),now(),now(),'$username','$email','$message')";

$result = mysql_query($msg);
return $result;
}



 function query_for_message(){

    $sql="SELECT * FROM inbox_admin ORDER BY datetime DESC";
    $msg= mysql_query($sql);
    return $msg;
 }

?>