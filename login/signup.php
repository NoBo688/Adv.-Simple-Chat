<?php
session_start();

  include("connection.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //somthing was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
      //save to database
      $user_name = stripslashes(htmlspecialchars($user_name));
      $user_id = random_num(20);
      $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

      mysqli_query($con, $query);

      header("Location: login.php");
      die;
    }else
    {
      echo "please enter valid info";
    }
  }



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
</head>
<body>
  <div id="box">
    <form method="post">

      <div>Signup</div>
      <input type="text" name="user_name"><br><br>
      <input type="password" name="password"><br><br>

      <input type="submit" value="Signup"><br><br>
      <a href="login.php">Log In!</a><br><br>
    </form>
  </div>
</body>
</html>