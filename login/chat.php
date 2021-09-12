<?php
  session_start();
  include("connection.php");
  include("functions.php");

  $user_data = check_login($con);

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $content = $_POST['content'];
    $_SESSION['user_id'] = $user_data['user_id'];
    $user_id = $_SESSION['user_id'];

    if(!empty($content))
    {
      $query = "insert into messages (user_id, text) values ('$user_id', '$content')";
      mysqli_query($con, $query);

    } else {
      echo 'Please input non-empty data!';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"/>
  <title>Chat</title>
</head>
<body>
  <a href="logout.php">Logout</a>
  <h1>This is chat</h1>
  <br>
  <p>Hello, <?php echo $user_data['user_name']; ?></p>

  <div id="chatbox"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      function getData(){
          $.ajax({
            type: 'POST',
            url: 'data.php',
            success: function(data){
              $('#chatbox').html(data);
            }
          });
        }
        getData();
        setInterval(function () {
          getData(); 
        }, 700);  // it will refresh your data every 1 sec
    });
  </script>

  <form method="post">
    <input type="text" name="content">
    <input type="submit" value="Send">
  </form>
  <!-- chat goes here -->
</body>
</html>