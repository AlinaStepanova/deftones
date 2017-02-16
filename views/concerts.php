<?php
     $server = 'mysql.zzz.com.ua'; 
    $user = 'alinastepanova'; 
    $password = '0501010121avs';
    $dblink = mysqli_connect($server, $user, $password);
    $database = 'alinastepanova'; 
    $selected = mysqli_select_db($dblink, $database);
    mysqli_query($dblink, "SET NAMES 'utf8'");
    $result = mysqli_query($dblink, "SELECT * FROM concerts WHERE published = 1"); 
    
    while($row = mysqli_fetch_array($result)) {
?>
    <html>
        <div class="concerts" id="concerts" style="text-align:center;">
            <hr><h3><div>Дата: <?= $row['concert_date']?> </div>
            <div>Місце: <?= $row['venue'] ?> </div>
            <div>Місто: <?= $row['city'] ?></div>
            <div>Країна: <?= $row['country'] ?></div></h3>
            <div class="crud" id="crud" style="font-size: 11pt">
                <a href="?action=read&id=<?= $row['concert_id'] ?>">Перегляд </a>
                <?php if(isset($_SESSION['admin']) &&  $_SESSION['admin'] == 1) { ?><a href="?action=update&id=<?= $row['concert_id'] ?>">Редагувати</a> <a href="?action=delete&id=<?= $row['concert_id'] ?>">Видалити</a>
                <?php } ?>
            </div><hr>
        </div>
        
    </html>
<?php
}
?>