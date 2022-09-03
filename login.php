<?php
include('connection.php');


$messages="";

if (isset($_POST['un']) && isset($_POST['pw'])) {

    
    $un=$_POST['un'];
    $pw=md5($_POST['pw']);

    //check if usernam and email exist   (* means all)
    $sql = "SELECT * FROM user WHERE username='$un' AND password='$pw'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  //  var_dump($row);
  
    $_SESSION['id']=$row['id'];
    $_SESSION['fn']=$row['firstname'];
    $_SESSION['ln']=$row['lastname'];
    $_SESSION['em']=$row['email'];

    header('location:index');
}
//session_destroy();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
    <title>Signup</title>
</head>
<body>

<div class="col-md-4 col-md-offset-4" id="login">
						<section id="inner-wrapper" class="login">
							<article>
								<form  action="#" method="POST">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"> </i></span>
											<input type="text" class="form-control" name="un" placeholder="Username">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"> </i></span>
											<input type="password" class="form-control" name="pw" placeholder="Password">
										</div>
									</div>
									  <button type="submit" class="btn btn-success btn-block">Login</button>
								</form>
							</article>
						</section></div>
</body>
</html>