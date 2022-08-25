<?php
//~ $db = new Mongo('mongodb://localhost:27017', array(
    //~ 'username' => 'root',
    //~ 'password' => 'root',
    //~ 'db'       => 'admin'
//~ ));

//$m = new MongoClient("mongodb://root:root@localhost:27017");
$m = new MongoDB\Driver\Manager("mongodb://root:root@localhost:27017");
$command = new MongoDB\Driver\Command(['ping' => 1]);

try {
    $cursor = $m->executeCommand('testdatabasename', $command);
    
    //$filter = ['x' => ['$gt' => 1]];
    if(isset($_POST['user_name'] , $_POST['password']) ){
		$username = $_POST['user_name'];
		$password = $_POST['password'];
	}else{
		$username = '';
		$password = '';
		}
    $filter = ['user_name' => $username, "password" => $password ];
    //$filter = ['user_name' => "gunjan", "password" => "123456"];
	$options = [];

	$query = new MongoDB\Driver\Query($filter, $options);
	$cursor = $m->executeQuery('testdatabasename.login_user', $query);
	//echo '<pre>';
	//print_r($cursor->_id);
	//die('sdfsdf');
	if($cursor)
		foreach ($cursor as $document) {
			//echo '<pre>';
			//print_r($document);
			//die('kkkkk');
			if(!empty($document)){
				session_start();
				$_SESSION["id"] = $document->_id;
				$_SESSION["name"] = $document->name;
				if($_SESSION["id"] != ''){
						header("Location: dashboard.php");
				}else{}
			}else{
				$message  = 'Invalid Username or Password';
			}
		}
	

    
    //$query = new MongoDB\Driver\Query($filter, $options);
    //$bulk = new MongoDB\Driver\BulkWrite;
	//$bulk->insert(['x' => 1, 'y' => 'foo']);
	//$bulk->insert(['x' => 2, 'y' => 'bar']);
	//$bulk->insert(['x' => 3, 'y' => 'bar']);
	//$m->executeBulkWrite('testdatabasename.testcollection', $bulk);
} catch(MongoDB\Driver\Exception $e) {
    echo $e->getMessage(), "\n";
    exit;
}

/* The ping command returns a single result document, so we need to access the
 * first result in the cursor. */
//$response = $cursor->toArray()[0];
//$db = $m->testdatabasename;
//var_dump($response);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>HTML5 Login Form with validation Example</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
  <h2>Login <?php //echo $_SESSION["id"]; ?></h2>
  <form id="login-form" name="frmUser" method="post" action="">
	  <div class="message"><?php //if($message!="") { echo $message; } ?></div>

    <p>
    <input type="text" id="username" name="user_name" placeholder="Username" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="password" id="email" name="password" placeholder="Password" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="submit" name="submit" id="login" value="Login">
    </p>
  </form>
  <div id="create-account-wrap">
    <!--p>Not a member? <a href="#">Create Account</a><p-->
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->
  
</body>
</html>
