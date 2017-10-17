<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/asu-fselogo-horiz-rgb-maroongold-footer-800x198.png" type="image/x-icon">
    <meta name="description" content="">
    <title>Home</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <style>
        body         { padding-top:80px; word-wrap:break-word; }
    </style>
    <style>
        .btn-primary, .btn-primary:hover,.btn-primary:active,.btn-primary:visited
        {
            background-color: #800000;
        }
    </style>



</head>
<body>
<section class="menu cid-qwLCObAEBm" once="menu" id="menu1-0" data-rv-view="187">



    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="/">
                         <img src="assets/images/asu-fselogo-horiz-rgb-maroongold-footer-800x198.png" alt="ASU IBM Watson Project " title="" media-simple="true" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-primary display-4" href="/">Cognitive Analysis using AI &nbsp;- ASU</a></span>
            </div>
        </div>

    </nav>
</section>

<div class="container">
<div class="col-sm-6 col-sm-offset-3">

    <h1><span class="fa fa-sign-in"></span> Login</h1>

    <% if (message.length > 0) { %>
        <div class="alert alert-danger"><%= message %></div>
    <% } %>

    <!-- LOGIN FORM -->
    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input id ="username" type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id ="password" name="password">
        </div>

        <button type="submit" value="Login" class="btn btn-primary btn-lg">Login</button>
    </form>

    <hr>

    <p>Need an account? <a href="/signup">Signup</a></p>
    <p>Or go <a href="/">home</a>.</p>


</div>
</div
    <?php
    if (isset($_POST['submit']))
        {
    include("config.php");
    session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];
    $_SESSION['login_user']=$username;
    $query = mysql_query("SELECT username FROM login WHERE username='$username' and password='$password'");
     if (mysql_num_rows($query) != 0)
    {
     echo "<script language='javascript' type='text/javascript'> location.href='home.php' </script>";
      }
      else
      {
    echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
    }
    }
    ?>

</body>
</html>
