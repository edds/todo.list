<!doctype html>

<title>todo.list</title>

<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js?v=2"></script>
<script type="text/javascript" src="script.js"></script>

<div class="wrapper">
<?php
include('functions.php');
printLists();
?>

<a href="#" class="newlist">new list</a>
</div>