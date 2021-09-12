<?php
include('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $query = "select * from messages";
  $result = mysqli_query($con, $query);
  $messages = array();
  while($row = $result->fetch_array()){
    $messages[] = "<div>".$row['text']." | <span style=\"font-size: 10px;\">".$row['date']."</span></div><br>";
  }
  foreach (array_reverse($messages) as &$message){
    echo $message;
  }
}