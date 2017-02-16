<?php
    $id_ = (int)$_GET['id'];
    $server = 'mysql.zzz.com.ua'; 
    $user = 'alinastepanova'; 
    $password = '0501010121avs'; 
    $dblink = mysqli_connect($server, $user, $password);
    $database = 'alinastepanova'; 
    $selected = mysqli_select_db($dblink, $database);
    $result = mysqli_query($dblink, "SELECT c.*, u.login FROM comment_ c INNER JOIN users u ON c.author_id=u.id_user WHERE c.comment_id ='$id_'");

    if (mysqli_num_rows($result) == 0) { ?>

        <h3 class="err_message" style="text-align:center; color:red">Помилка, сторінки не існує!</h3>
<?php
    } else { 
        $delete = "DELETE FROM comment_ WHERE comment_id = '$id_'";
        mysqli_query($dblink, $delete);
        ?>
        
        <h3 class="err_message" style="text-align:center;">Коментар успішно видалено!</h3>
<?php    } ?>