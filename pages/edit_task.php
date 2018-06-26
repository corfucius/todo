<?php
   include'../database.php';
   include'../classes.php';

session_start();

$user_id = $_SESSION['user_id'];
$name =  $_SESSION["username"];  


    if(isset($_GET['as'], $_GET['item'])) {
        $as = $_GET['as'];
        $id = $_GET['item'];
        $edit_result = $conn->query("SELECT * FROM todos WHERE id = '$id'");
        echo $id;
    }
     if(isset($_POST['save_change'])) { 
        $edit_todo = strip_tags(trim( $_POST['edit_todo']));
        $id = $_GET['item'];
        $save_result = $conn->query("UPDATE todos SET todo_item = '$edit_todo' WHERE id = '$id'");
        header('location:todo.php');
     }
?>    
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <title>To Do List</title>
</head>
<?php include'../includes/header.php';?>
<body>
<div class="todo">
    <h2 class="headers">Welcome: <?php echo $name ?></h1>
    <h2 class="headers">Edit your todos</h1>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="todo-list">
        <label for="newTodo">Edit your todo here:</label><br>
        <?php
        if($edit_result->num_rows > 0) {
        //   then output data for each row
        while($row = $edit_result->fetch_assoc()) {?>
        
        <input type="text" name="edit_todo" placeholder="no todos" value=" <?php echo $row["todo_item"];?>">
        <input type="submit" value="save" name="save_change" class="submit button">
        <?php }} ?>
    </form>
</div>
</body>
<?php include'../includes/footer.php';?>
</html>