<?php
  require"pdo.php";
  session_start();

  if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pswd = substr($_POST['password'],0,3).$_POST['password'];
    $pswd = hash('md5',$pswd);

    $stmt = $pdo -> prepare('SELECT * FROM Admin WHERE username = :user');
    $stmt -> execute(array(
              ':user' => $_POST['username']
    ));
    $row = $stmt ->fetch(PDO::FETCH_ASSOC);

    if ($pswd ==$row['passwrd']){
      $_SESSION['admin'] = $row['username'];
      header("Location:panel.php");
      return;
    }
    else{
      $_SESSION['error']= 'Invalid Password';
      header("Location:admin.php");
      return;
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>K News-Login</title>

   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Manjari:wght@700&family=Mukta:wght@800&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Gayathri:wght@700&display=swap" rel="stylesheet">
   <link href="css/kn-admin.css" rel="stylesheet">

 </head>

   <body id="login-body">
     <?php
     if (isset($_SESSION['admin'])) {
       die('  <div class="container">
                <div class="row justify-content-center" style="height:100vh;">
                  <div class="card bg-success mx-auto my-auto">
                    <a class="btn" href="./panel.php">
                      <h4 class="text-white"> You are already Logged in <hr class="bg-white">Click here to Admin Panel</h4>
                    </a>
                  </div>
                </div>
              </div>');
     }
      ?>
      <div class="container ">
        <div class="row" style="height:100vh;">
          <div class="col-12 col-md-4 col-sm-6 my-auto mx-auto">
            <div class="card col-sm-12 rounded text-dark shadow" id="login-card">
              <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">Admin Panel  </h5>
              </div>
              <div class="card-body">
                <form class="needs-validation"  method="post" novalidate>
                  <?php
                    if (isset($_SESSION['error'])){
                      echo "<p class=\"text-danger\" id=\"pswrd_wrong\">".$_SESSION['error']."<p>";
                      unset($_SESSION['error']);
                    }
                   ?>
                  <div class="form-group col-sm" >
                    <label for="username">Username</label>
                    <input class="form-control" id="username" type="text" name="username" placeholder="Username" required>
                    <div class="invalid-feedback">Username required</div>
                  </div>
                  <div class="form-group col-sm">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                    <div class="invalid-feedback">Password required</div>
                  </div>
                  <div class="row justify-content-center ">
                    <button  class="btn btn-primary btn-block col-6 ml-3" type="submit" name="submit"><strong>Log In</strong></button>
                    <button class="btn btn-primary btn-block col-6 ml-3 bg-secondary btn-outline-secondary text-white" type="button" onclick="window.location=\'./main.php\';return false;">Back to Home</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="js/sb-admin-2.min.js"></script>
     <script>

      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
       'use strict';
       window.addEventListener('load', function() {
         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         var forms = document.getElementsByClassName('needs-validation');
         // Loop over them and prevent submission
         var validation = Array.prototype.filter.call(forms, function(form) {
           form.addEventListener('submit', function(event) {
             if (form.checkValidity() === false) {
               event.preventDefault();
               event.stopPropagation();
             }
             form.classList.add('was-validated');
           }, false);
         });
       }, false);
      })();


      //if password is wrong
      if (document.getElementById('pswrd_wrong')){
        document.getElementById('pswrd_wrong').style.display = 'none';
        alert('Password is incorrect');
      }
     </script>
  </body>
</html>
