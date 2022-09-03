<?php
include('connection.php');


$messages="";

if (isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['em']) && isset($_POST['un']) && isset($_POST['pw'])) {

    $fn=$_POST['fn'];
    $ln=$_POST['ln'];
    $em=$_POST['em'];
    $un=$_POST['un'];
    $pw=md5($_POST['pw']);

    //check if usernam and email exist   (* means all)
    $sql = "SELECT * FROM user WHERE email='$em'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
   // print_r($row);

        $id=$row['id'];
        
        if($id > 0)
        {
            $messages= "<span style='color:red;'><br> Oooops!, Username or email already in use <br> </span>";
        }else
        {
                //Insert values
            $sql = "INSERT INTO user (firstname, lastname, username, password, email) VALUES ('$fn', '$ln', '$un', '$pw', '$em')";
    
            if ($conn->query($sql) === TRUE) {
            // $messages= "Welcome to DailyCash, Let's make some Moneeeeeyyyy!";
    
                header('location:login');
            } else {
                $messages= "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    



}

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
                            
                            <?php echo $messages;?>
                           
							<article>
								<form action="#" method="POST">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"> </i></span>
											<input type="text" class="form-control" name="fn" placeholder="First Name">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"> </i></span>
											<input type="text" class="form-control" name="ln" placeholder="Last Name">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"> </i></span>
											<input type="email" class="form-control" name="em" placeholder="Email Address">
										</div>
									</div>
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
									
									  <button type="submit" class="btn btn-success btn-block">Submit</button>
								</form>
							</article>
						</section></div>
</body>
</html>