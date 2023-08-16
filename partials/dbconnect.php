<?php
$servername="localhost";
$username="root";
$password="";
$database="forum";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("Couldn't able to conncet to the server");
}


?>