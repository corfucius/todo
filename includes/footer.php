<?php
    if(isset($_POST['home']))
    header('location:../index.php');
?>

<form class="app-header" method="post">
    <span class="home-button">
    <button name="home">Home</button>
    </span>
</form>