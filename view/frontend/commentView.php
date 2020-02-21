<?php session_start(); ?>

<form action="?action=addComment&id=<?= $_GET['id'] ?>" method="post">
    <textarea name="comment" id="comment" rows="10" cols="50"></textarea>
    <input type="submit">
</form>