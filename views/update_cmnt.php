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
        $row_c = $row['comment'];
    $error_comment = "";
        if (isset($_POST['submit'])) {
        $text_comment = $_POST['text_comment'];
        
        if(strlen($text_comment) < 2) {
            $error_comment .= "Некоректні дані!";
        }
        if (strlen($text_comment) > 2) {
            $sql = "UPDATE `comment_` SET `comment`='".$text_comment."' WHERE comment_id='$id_'";
            mysqli_query($dblink, $sql);
            $row_c = "";
            ?>
         <h3 class="err_message" style="text-align:center;">Коментар успішно оновлено!</h3>
<?php
            
        }
} else {
?>
    <html>
        <form id="add_comment" class="form" name="add_comment" action="" method="post">
        <textarea rows="8" cols="48" name="text_comment" placeholder="Введіть коментар"><?= $row_c ?></textarea>
        <p><?= $error_comment; ?></p>
        <input type="submit" id="button" value="Надіслати" 
           name="submit"/>
        </form>    
    </html>
<?php
}
    }
?>