

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">


    <title>Login</title>

  
    <link href="dist/css/bootstrap.css" rel="stylesheet">

  
    <link href="css/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">
      <form class="form-signin" method="post" action="checklogin.php">
        <h2 class="form-signin-heading">Please Log in</h2>

        
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus>
        <input type="password" name="password" id="password"  class="form-control" placeholder="Password">
        <label class="checkbox">
          <input type="checkbox" name="remember" value="yes"> Remember Me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="login">Log in</button>
      </form>
<!--        <?php 
if(empty($_SESSION['username'])) {
 echo "<p> incorrect username & password please try again.</p>" ;
}
?>   -->

    </div> <!-- /container -->

  </body>
</html>
