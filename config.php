<?php

  $conn = mysqli_connect("localhost","root","","urlshortener");

  if($conn)
  {
    echo "Database connected".mysqli_connect_error();
  } 
?>