<?php require 'PHPMailer/PHPMailerAutoload.php';?>
<?php
function Redirect_to($New_Location)
{header("Location:" . $New_Location);
    exit;
}

// call the contact() function if contact_btn is clicked
if (isset($_POST['reset-request-submit'])) {
    contact();
}

function contact()
{
        // Email Functionality

        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->CharSet = 'UTF-8';

	$mail->Host       = "smtp.gmail.com"; // SMTP server example
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "rotich.mercy@strathmore.edu"; 	// SMTP account username example
	$mail->Password   = "crsmhlmyreycpiqn";        // SMTP account password example


        $mail->setFrom($_POST['email']);
        $mail->addAddress('rotich.mercy@strathmore.edu');

        // The subject of the message.
        $mail->Subject = 'Received Message From Nourishkids ' . $name;

        $subject = ' Reset NourishKids password';  //create subject
        $message = '<p> We received a request for password reset. The link to reset the password is below. If you did not request for this, you can ignore this email. </p>';  //message sent to user
        $message .= '<p>Here is your reset link: </br>';
        $message.= '<a href="' . $url . '">' . $url . '</a></p>';
        
        $headers = "From: NourishKids <NourishKids@gmail.com>\r\n";
        $headers .= "Reply-To: NourishKids@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n"; //allows html to function
        
        mail($to, $subject, $message, $headers ); //server running
        header("Location: forgot-password.php?reset=success");
        

        $mail->Body = $message;

        $mail->isHTML(true);

        if ($mail->send()) {
            Redirect_to("recover.php");
        } else {
            Redirect_to("index.php");
        }

    } //Ending of Submit Button If-Condition



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nourish Kids | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Nourish</b>Kids</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="reset-request.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="reset-request-submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <?php
      if (isset($_GET["reset"])){
        if ($_GET["reset"] == "success") {
            echo '<p class="success">Check your email!</p>';
        }
      }
      ?>

      <p class="mt-3 mb-1">
        <a href="login.html">Login</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>