<form action="?action=addComment&id=<?= $_GET['id'] ?>#comment" method="post">
    <textarea name="comment" id="comment" rows="15" cols="80"><?= $userComment['post'] ?></textarea><br>
    <input type="submit" value="Poster">
</form>