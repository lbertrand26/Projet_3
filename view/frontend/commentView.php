<?php session_start(); ?>

<form action="?action=addComment&id=<?= $_GET['id'] ?>" method="post">
    <textarea name="comment" id="comment" rows="15" cols="80"></textarea><br>
    <input type="submit">
</form>