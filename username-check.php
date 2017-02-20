<?php

  $host="localhost";
  $user="bn_wordpress";
  $pass="*10E2334CD844DAE783D572CDFC4346FC816A5F94";
  $dbname="bitnami_wordpress";

  $dbcon = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);

  if($_POST)
  {
      $name     = strip_tags($_POST['name']);

	  $stmt=$dbcon->prepare("SELECT f_name FROM wp_fbs_users WHERE f_name=:name");
	  $stmt->execute(array(':name'=>$name));
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
