<?php


// Store File in a name : DisplayPhoto.php 
 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'login';
 
 // some basic sanity checks

     $link = mysql_connect("$host", "$user", "$pass")
     or die("Could not connect: " . mysql_error());
 
     // select our database
     mysql_select_db("$db") or die(mysql_error());
 
     // get the image from the db
     $sql = "SELECT image FROM testblob WHERE image_id=2;";
 
     // the result of the query
     $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
 
     // set the header for the image
     header("Content-type: image/jpeg");
     echo mysql_result($result, 0);
 
     // close the db link
     mysql_close($link);






















/*** some basic sanity checks ***/
// if(filter_has_var(INPUT_GET, "image_id") !== false && filter_input(INPUT_GET, 'image_id', FILTER_VALIDATE_INT) !== false)
//     {
//     /*** assign the image id ***/
//     $image_id = filter_input(INPUT_GET, "image_id", FILTER_SANITIZE_NUMBER_INT);
//     try     {
//         /*** connect to the database ***/
//         $dbh = new PDO("mysql:host=localhost;dbname=login", 'root', '');

//         /*** set the PDO error mode to exception ***/
//         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         /*** The sql statement ***/
//         $sql = "SELECT image, image_type FROM testblob WHERE image_id=$image_id";

//         /*** prepare the sql ***/
//         $stmt = $dbh->prepare($sql);

//         /*** exceute the query ***/
//         $stmt->execute(); 

//         ** set the fetch mode to associative array **
//         $stmt->setFetchMode(PDO::FETCH_ASSOC);

//         /*** set the header for the image ***/
//         $array = $stmt->fetch();

//         /*** check we have a single image and type ***/
//         if(sizeof($array) == 2)
//             {
//             /*** set the headers and display the image ***/
//             header("Content-type: ".$array['image_type']);

//             /*** output the image ***/
//             echo $array['image'];
//             }
//         else
//             {
//             throw new Exception("Out of bounds Error");
//             }
//         }
//     catch(PDOException $e)
//         {
//         echo $e->getMessage();
//         }
//     catch(Exception $e)
//         {
//         echo $e->getMessage();
//         }
//         }
//   else
//         {
//         echo 'Please use a real id number';
//         }
?>