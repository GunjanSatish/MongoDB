<?php
session_start();
//print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>User Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
  <h2>Dashboard</h2>
  <?php
if($_SESSION["name"]) {
	//echo $_SESSION["name"];
?>
Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" tite="Logout">Logout.
<?php
}else {
	header("Location: login.php");
	}
?>
  <div id="create-account-wrap">
    <!--p>Not a member? <a href="#">Create Account</a><p-->
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->
  
</body>
</html>
