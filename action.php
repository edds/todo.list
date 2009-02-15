<?php
include('functions.php');
if(!empty($_POST['mark'])){
    $item = mysql_real_escape_string($_POST['item']);
    $sql = "UPDATE todo_tasks SET Done = 1 - Done WHERE TaskID='".$item."'";
    $result = mysql_query($sql) or die('mark: '.mysql_error());
} else if(!empty($_POST['update'])){
    $item = !empty($_POST['item'])? mysql_real_escape_string($_POST['item']) : '';
    $list = !empty($_POST['list'])? mysql_real_escape_string($_POST['list']) : '';
    $newtext = mysql_real_escape_string($_POST['update']);
    if(!empty($list)){
        $sql = "UPDATE todo_lists SET Title='".$newtext."' WHERE ListID='".$list."'";
    } else {
        $sql = "UPDATE todo_tasks SET Text='".$newtext."' WHERE TaskID='".$item."'";
    }
    $result = mysql_query($sql) or die('update: '.mysql_error());    
} else if(!empty($_POST['insert'])){
    $text = mysql_real_escape_string($_POST['insert']);
    $list = mysql_real_escape_string($_POST['list']);
    $sql = "INSERT INTO todo_tasks (Text,ListID) VALUES ('".$text."','".$list."')";
    $result = mysql_query($sql) or die('insert: '.mysql_error());
    echo mysql_insert_id();
} else if(!empty($_GET['archive'])){
    $list = mysql_real_escape_string($_GET['archive']);
    $sql = "UPDATE todo_tasks SET Archive='1' WHERE ListID='".$list."' AND Done='1'";
    $result = mysql_query($sql) or die('archive: '.mysql_error());
    header("Location: ./");
} else if(!empty($_GET['new'])){
    $project = mysql_real_escape_string($_GET['new']);
    $sql = "INSERT INTO todo_lists (Title) VALUES ('".$project."')";
    $result = mysql_query($sql) or die('new: '.mysql_error());
    header("Location: ./");
} else if(!empty($_POST['archive'])){
    $list = mysql_real_escape_string($_POST['archive']);
    $sql = "UPDATE todo_lists SET Archive='1' WHERE ListID='".$list."'";
    $result = mysql_query($sql) or die('archive1: '.mysql_error());
    $sql = "UPDATE todo_tasks SET Archive='1' WHERE ListID='".$list."'";
    $result = mysql_query($sql) or die('archive2: '.mysql_error());
    echo 'archive';    
}

?>