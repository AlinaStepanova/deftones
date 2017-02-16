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

/*$server = 'localhost'; 
    $user = 'root'; 
    $password = ''; 
*/
    $dblink = mysqli_connect($server, $user, $password);
    $database = 'alinastepanova'; 
    $selected = mysqli_select_db($dblink, $database);
    mysqli_query($dblink, "SET NAMES 'utf8'");
    $result = mysqli_query($dblink, "SELECT * FROM concerts WHERE concert_id = '$id_'");
    $result_comments = mysqli_query($dblink, "SELECT c.*, u.login FROM comment_ c INNER JOIN users u ON c.author_id=u.id_user WHERE c.concert ='$id_'");

//_________________________if page does not exist______________________________//
    if (mysqli_num_rows($result) == 0) {
?>
        <h3 class="err_message" style="text-align:center; color:red">Помилка, сторінки не існує!</h3>
<?php
    } else {
    $row = mysqli_fetch_assoc($result);
    $error_comment = "";
        if (isset($_POST['submit'])) {
        $text_comment = mysqli_real_escape_string($dblink, $_POST['text_comment']);

        if(strlen($text_comment) < 2) {
            $error_comment .= "Некоректні дані!";
        }
        if (strlen($text_comment) > 2) {
            $sql = "INSERT INTO `comment_` (`author_id`, `comment`, `concert`) VALUES ('".$_SESSION['id_user']."','".$text_comment."','".$id_."')";
            mysqli_query($dblink, $sql);
            $sql = "";
            $text_comment = "";
        
?>
    <h3 class="success_concert" style="text-align:center";>Коментар успішно додано!</h3>
<?php
    }
}
?>
    <html>
        <div class="concerts" id="concerts" style="text-align:center;">
            <hr><h3><div>Дата: <?= $row['concert_date']?> </div>
            <div>Місце: <?= $row['venue'] ?> </div>
            <div>Місто: <?= $row['city'] ?></div>
            <div>Країна: <?= $row['country'] ?></div></h3>
            <div class="crud" id="crud" style="font-size: 11pt">
                <?php if(isset($_SESSION['admin']) &&  $_SESSION['admin'] == 1) { ?><a href="?action=update&id=<?= $row['concert_id'] ?>">Редагувати</a> <a href="?action=delete&id=<?= $row['concert_id'] ?>">Видалити</a>
                <?php } ?>
            </div><hr>
        </div>   
    </html>

<?php
    while($row_c = mysqli_fetch_array($result_comments)) {
?>
    <html>
        <div class="comment" id="comment">
            <div><?= $row_c['comment']?> </div>
            <h5>Автор: <?= $row_c['login'] ?> | Опубліковано: <?= $row_c['posted'] ?></h5>
            <div class="crud" id="crud" style="font-size: 11pt">
                <a href="?action=view_cmnt&id=<?= $row_c['comment_id'] ?>">Перегляд </a>
                <?php if(isset($_SESSION['admin']) &&  $_SESSION['admin'] == 1) { ?><a href="?action=update_cmnt&id=<?= $row_c['comment_id'] ?>">Редагувати</a> <a href="?action=delete_cmnt&id=<?= $row_c['comment_id'] ?>">Видалити</a>
                <?php } ?>
            </div>
            <hr>
        </div>
    </html>
<?php
    }
?>

<!--_________________________________add comment_______________________________---->
    <html>
        <form id="add_comment" class="form" name="add_comment" action="" method="post">
        <textarea rows="8" cols="48" name="text_comment" placeholder="Введіть коментар"></textarea>
        <p><?= $error_comment; ?></p>
        <input type="submit" id="button" value="Надіслати" 
           name="submit"/>
        </form>    
    </html>
<?php
}
?>