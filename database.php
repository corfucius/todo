<?php 
//Create DB connnection 

$conn = new mysqli("localhost", "root", "", "todolist");
if (!$conn) {
    echo "Error: Unable to connect.";
}
?>	
