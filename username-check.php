<?php
  $host="localhost:3306";
  $user="bn_wordpress";
  $pass="3b4a4042b1";
  $dbname="bitnami_wordpress";

  $dbcon = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);

  if($_POST)
  {
      $login     = strip_tags($_POST['login']);

	  $stmt=$dbcon->prepare("SELECT login FROM `wp_fbs_users` WHERE login=:name");
	  $stmt->execute(array(':login'=>$login));
	  $count=$stmt->rowCount();

	  if($count>0)
	  {
		  echo "<span style='color:brown;'>Sorry username already taken !!!</span>";
	  }
	  else
	  {
		  echo "<span style='color:green;'>available</span>";
	  }
  }
?>
