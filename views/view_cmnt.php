<style>
    #add_comment {
    min-height: inherit;
    }
    p {
    font-size: 11pt;
    text-shadow: none;
    color: #d02929;
    text-shadow: 1px 1px 1px rgba(134, 86, 86, 0.65);
}
</style>

<?php
    $id_ = (int)$_GET['id'];
    $server = 'mysql.zzz.com.ua'; 
    $user = 'alinastepanova'; 
    $password = '0501010121avs'; 
    $dblink = mysqli_connect($server, $user, $password);
    $database = 'alinastepanova'; 
    $selected = mysqli_select_db($dblink, $database);
    mysqli_query($dblink, "SET NAMES 'utf8'");
    $result_comments = mysqli_query($dblink, "SELECT c.*, u.login FROM comment_ c INNER JOIN users u ON c.author_id=u.id_user WHERE c.comment_id ='$id_'");
  if (mysqli_num_rows($result_comments) == 0) {
?>
        <h3 class="err_message" style="text-align:center; color:red">Помилка, сторінки не існує!</h3>
<?php
    } else {
    $row = mysqli_fetch_assoc($result_comments);
?>
    <html>
        <div class="comment" id="comment">
            <div><?= $row['comment']?> </div>
            <h5>Автор: <?= $row['login'] ?> | Опубліковано: <?= $row['posted'] ?></h5>
            <div class="crud" id="crud" style="font-size: 11pt">
                <?php if(isset($_SESSION['admin']) &&  $_SESSION['admin'] == 1) { ?><a href="?action=update_cmnt&id=<?= $row['comment_id'] ?>">Редагувати</a> <a href="?action=delete_cmnt&id=<?= $row['comment_id'] ?>">Видалити</a>
                <?php } ?>
            </div>
        </div>
    </html>
<?php
    }
?>