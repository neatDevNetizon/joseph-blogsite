<!-- <?php
session_start();
include('App/View/includes/config.php');
error_reporting(0);
if (isset($_POST['signin'])) {
  $uname = $_POST['username'];
  $password = $_POST['password'];
  $hashPass = md5($password);
  echo "<script>alert('".$hashPass."');</script>";

  $sql = "SELECT * FROM jos_admin WHERE (admin_email=:usname || admin_password=:password)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':usname', $uname, PDO::PARAM_STR);
  $query->bindParam(':password', $hashPass, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    foreach ($results as $row) {
      $dbhashpass = $row->admin_password;
      $_SESSION['josid'] = $row->admin_id;
      $_SESSION['josname'] = $row->admin_email;
    }
    //verifying Password
    if (password_verify($password, $dbhashpass)) {
      echo "<script type='text/javascript'> document.location ='/admin'; </script>";
    } else {
      echo "<script>alert('Wrong Password');</script>";
    }
  }
  //if username or email not found in database
  else {
    echo "<script>alert('User not registered with us');</script>";
  }
}
?> -->

<html>
   <head>
      <title>Admin Login</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <style type="text/css">
         body {
            text-align: center;
             justify-content: center;
             display: flex;
             align-items: center;
         }
         .login-container {
            max-width: 450px;
            text-align: center;
            padding: 50px 20px 40px 20px;
            box-shadow: 3px 4px 7px 3px  rgba(0, 0, 0, 0.25);
         }
         .login-container h1 {
            min-width: 350px;
            margin-bottom: 50px;
         }
         .login-container input {
            margin: 0px 0px 30px 0px;
         }
         @media screen and (max-width: 450px) {
           .login-container h1 {
               min-width: 0px;
            }
            .login-container {
               width: 90% !important;
            }
         }
         @media screen and (max-width: 800px) {
           .login-container {
             width: 100%;
           }
         }
      </style>
   </head>
   <body>
      <div class="login-container">
         <h1 class="">Login</h1>
         <div class = "container">
            <h4 class = "form-signin-heading"></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "Enter your email" value="admin@admin.com" 
               required autofocus>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "Enter your password" required value="admin123456">
            <button type="button" value="Login" class = "btn btn-lg btn-primary btn-block" onclick="submitting()">Login
            </button>
         </div> 
      </div>
   </body>

   <script type="text/javascript">
      function submitting() {
         var email = $('input[name="username"]').val();
         var pwd = $('input[name="password"]').val();
         $.ajax({
            url:"/App/Controller/functions.php?id=login",
            type: "post",
            dataType: 'text',
            data: { email:email, pwd:pwd },
            success: function (res) {
               console.log(res)
               if (res === 'valid') {
                  window.location.href="/admin";
               } else {
                  alert(res)
               }
            },
            error: function(err){
                console.log(err)
            }
        });
      }
   </script>
</html>