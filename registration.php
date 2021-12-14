<?php
session_start();
error_reporting(0);
include("dbconnection.php");
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$prenume=$_POST['prenume'];
	$username = $_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$mobile=$_POST['phone'];
	$query=mysqli_query($con,"select email from user where email='$email'");
	$num=mysqli_fetch_array($query);
	if($num>1)
	{
  echo "<script>alert('Email-ul exista deja, va rugam sa folositi alt email');</script>";
  echo "<script>window.location.href='registration.php'</script>";
	}
	else
	{
       $insertAsist = mysqli_query($con,"insert into asistente(id,nume,prenume,functie) values (NULL,'$name','$prenume','Asistenta')");
       $insertUser = mysqli_query($con,"insert into user(id,name,prenume,username,email,password,mobile) values(NULL,'$name','$prenume','$username','$email','$password','$mobile')");
        if($insertAsist && $insertUser){
            echo "<script>alert('User adaugat cu succes.Acum poti accesa platforma cu user-ul creat anterior');</script>";
            echo "<script>window.location.href='login.php'</script>";
        }
        else {
            echo "<script>alert('Userul nu a putut fi adaugat, va rugam sa reincercati');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="assets/js/login.js" type="text/javascript"></script>
<script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.cpassword.value)
{
alert('New Password and Re-Password field does not match');
document.signup.cpassword.focus();
return false;
}
return true;
}

</script>

</head>
<body class="error-body no-top">
<div class="container">
  <div class="row login-container column-seperation">  
      <div class="col-md-5 col-md-offset-1">
          <h2>Adauga user</h2>
          <p>sau
              <a href="login.php"> logheaza-te</a>
          </p>

      </div>

      <div class="col-md-5 "> <br>
		 <form id="signup" name="signup" class="login-form" onsubmit="return checkpass();" method="post">
             <div class="row">
                 <div class="form-group col-md-10">
                    <label class="form-label">Nume </label>
                    <div class="controls">
                        <div class="input-with-icon  right">
                            <input type="text" name="name" id="name" class="form-control" >
                        </div>
                    </div>
                  </div>
              </div>

             <div class="row">
                 <div class="form-group col-md-10">
                     <label class="form-label">Prenume</label>
                     <div class="controls">
                         <div class="input-with-icon  right">
                             <input type="text" name="prenume" id="prenume" class="form-control" >
                         </div>
                     </div>
                 </div>
             </div>

             <div class="row">
                 <div class="form-group col-md-10">
                     <label class="form-label">Username</label>
                     <div class="controls">
                         <div class="input-with-icon  right">
                             <input type="text" name="username" id="username" class="form-control" >
                         </div>
                     </div>
                 </div>
             </div>

             <div class="row">
                 <div class="form-group col-md-10">
                    <label class="form-label">Email</label>
                    <div class="controls">
                        <div class="input-with-icon  right">
                            <input type="email" name="email" id="email" class="form-control" >
                        </div>
                    </div>
                  </div>
              </div>

               <div class="row">
                 <div class="form-group col-md-10">
                    <label class="form-label">Parola</label>
                    <div class="controls">
                        <div class="input-with-icon  right">
                            <input type="password" name="password" id="password" class="form-control" >
                        </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-md-10">
                    <label class="form-label">Confirmare parola</label>
                    <span class="help"></span>
                    <div class="controls">
                        <div class="input-with-icon  right">
                            <input type="password" name="cpassword" id="cpassword" class="form-control" >
                        </div>
                    </div>
                  </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-10">
                    <label class="form-label">Numar de telefon</label>
                    <span class="help"></span>
                    <div class="controls">
                        <div class="input-with-icon  right">
                            <input type="text" name="phone" id="txtpassword" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" >
                        </div>
                    </div>
                  </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-10">
                    <label class="form-label">Rol user</label>
                    <span class="help"></span>
                    <div class="control-group">
                        <div class="input-with-icon right control-label">
                            <input type="checkbox" class="checkbox-inline" value="asistenta" name="rol" id="asistenta"> Asistenta
                            <input type="checkbox" class="checkbox-inline" value="doctor" name="rol" id="doctor"> Doctor

                        </div>
                    </div>
                  </div>
              </div>

             <div class="row">
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary btn-cons pull-right" name="submit" >Adauga user</button>
                </div>
             </div>



         </form>
      </div>
  </div>
</div>

</body>
</html>