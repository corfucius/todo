<?php
   include'../database.php';
   include'../classes.php';

?>
<?php
 session_start();
 //initialize db set session vars
$db = new mysqli("localhost", "root", "", "todolist");
//these two vars are carried over from login
$name =  $_SESSION["username"];  
$todo_page_id = $_SESSION['user_id'];

if (isset($_POST["submit"]) ) {
    $newItem = $_POST['newItem'];
    //verfiy handle on session id
    echo "$todo_page_id";
     //add users todo to db
    $add_user_todo = $db->query('INSERT INTO todos (user_id, todo_item, todo_date) VALUES("'.$todo_page_id.'", "'.$newItem.'", NOW())');
}
//logout end session
if(isset($_POST['logout'])) {
    session_destroy();
    header('location:../index.php');
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
    <h2 class="headers">Add a Todo</h1>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="todo-list">
        <label for="newTodo">Add new item:</label><br>
        <input type="text" name="newItem" placeholder="Add new item">
        <input type="submit" name="submit" class="submit button">
        <ul class="newTodoItems">
        <?php
        if(isset($name)) {
        $todo_result = $db->query("SELECT * FROM todos WHERE user_id = '$todo_page_id'");
        //   if query returns a value
        if($todo_result->num_rows > 0) {
        //   then output data for each row
        while($row = $todo_result->fetch_assoc()) { ?>
            <li class="todoArea">
                <!--let the css classes do the work of marking complete and deleting by echoing a variable that represents different states for the todo item   -->
                <span class="list-<?php echo $row['todo_status'];?>-items">
                <?php echo $row["todo_item"].'<br> '.$row["todo_date"];?>
                </span>
            </li>
            <span class="buttonArea">
                <a href="buttons.php?as=done&item=<?php echo $row['id'];?>"class="mark-<?php echo $row['todo_status'];?>-complete"> Mark Complete </a>
                <a href="buttons.php?as=delete&item=<?php echo $row['id'];?>"class="delete-<?php echo $row['todo_status'];?>-todo"> Delete</a>
                <a href="edit_task.php?as=edit&item=<?php echo $row['id'];?>"class="edit-<?php echo $row['todo_status'];?>-todo"> Edit</a> 
            </span>
            <?php }}} ?>
        </ul>

    <button name="archive">view archived items</button><br>
    <?php 
        // if archive button clicked
        if(isset($_POST['archive'])) { 
        // select all for the current user
        //$todo_result = $db->query("SELECT * FROM todos WHERE user_id = '$todo_page_id'");
        // if query returns a value then do this stuff
        if($todo_result->num_rows > 0) {
        //   output data for each row
        while($row = $todo_result->fetch_assoc()) { ?>
        <ul class="archived-<?php echo $row['archive_status'];?>-items">
            <li class="archiveArea">
                <span class="archive list">
                    <?php echo $row["todo_item"].' '.$row["todo_date"];?>
                </span>
            </li>
        </ul>
            <?php }?>
            <span>
                <a href="buttons.php?:as=closeArchive&item=archive;?>" class="archived-0-button">CLOSE ARCHIVE</a>
            </span>
            <?php } else {
                echo 'You do not have any archived items';
            }
            }?>
    <button name="logout">logout</button>
    </form>
</div>
</body>
<?php include'../includes/footer.php';?>
</html>