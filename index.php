<!doctype html>

<title>todo.list</title>

<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="jquery.min.js?v=2"></script>
<script type="text/javascript" src="script.js"></script>

<div class="wrapper">
<?php
include('functions.php');
printLists();
?>

<p class="globalactions"><a href="#" class="newlist">new list</a> - <a href="?show_me_the_archive=true">ahow archive</a></p>
</div>