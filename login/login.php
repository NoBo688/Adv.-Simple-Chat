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
    //read from database
    $query = "select * from users where user_name = '$user_name' limit 1";

    $result = mysqli_query($con, $query);

    if($result)
    {
      if($result && mysqli_num_rows($result) > 0)
      {

        $user_data = mysqli_fetch_assoc($result);
        
        if($user_data['password'] == $password)
        {

          $_SESSION['user_id'] = $user_data['user_id'];
          header("Location: chat.php");
          die;
        }
      }
    }

    echo 'wrong username or password!';
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
  <title>Login</title>
</head>
<body>
  <div id="box">
    <form method="post">

      <div>Login</div>
      <input type="text" name="user_name"><br><br>
      <input type="password" name="password"><br><br>

      <input type="submit" value="Login"><br><br>
      <a href="signup.php">Sign Up!</a><br><br>
    </form>
  </div>
</body>
</html>