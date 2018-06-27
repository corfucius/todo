<?php
    require '../database.php';
    require '../classes.php';
    session_start();
    $edit_page_id = $_SESSION['user_id'];
    
    if(isset($_GET['as'], $_GET['item'])) {
        $as = $_GET['as'];
        $id = $_GET['item'];

        switch($as) {
        case 'done':
        $change_status = $conn->query("UPDATE todos SET todo_status = 1 WHERE id = '$id'");
        break;
    
        case 'delete':
         $hide_item = $conn->query("UPDATE todos SET todo_status = 2 WHERE id = '$id'");
         break;

        case 'closeArchive':
        $close_archive = $conn->query("UPDATE todos SET archive_status = 1 WHERE user_id = '$edit_page_id'");
         break;
    }
}

header('location: todo.php');