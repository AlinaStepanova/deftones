<style>
   #updateForm {
    min-height: inherit;
    }
   p{
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
    $result = mysqli_query($dblink, "SELECT * FROM concerts WHERE concert_id = '$id_'");

    $row = mysqli_fetch_assoc($result);

    $error_date = "";
    $error_venue = "";
    $error_city = "";
    $error_country = "";
    
    if (isset($_POST['submit'])) {
    $date = mysqli_real_escape_string($dblink, $_POST['date']);
    $venue = mysqli_real_escape_string($dblink, $_POST['venue']);
    $country = mysqli_real_escape_string($dblink, $_POST['country']);
    $city = mysqli_real_escape_string($dblink, $_POST['city']);
        
    if ((isset($_POST['visible'])) && ($_POST['visible'] == "yes")) {
        $published = 1;
    } else {
        $published = 0;
    }
    
    if (!preg_match("/^[0-9]{4}.(0[1-9]|1[0-2]).(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
        $error_date .= 'Введіть дату у форматі xxxx.yy.mm!';
    } 
    if(!preg_match('/^[A-ZА-Я]{1}([a-z0-9а-яєїіґ ]{2,255})/', $venue)) {
        $error_venue .= "Некоректні дані!";
    }
    if(!preg_match('/^[A-ZА-Я]{1}([a-zа-яєїіґ ]{2,255})/', $city)) {
        $error_city .= "Некоректні дані!";
    }
    if(!preg_match('/^[A-ZА-Я]{1}([a-zа-яєїіґ ]{2,255})/', $country)) {
        $error_country .= "Некоректні дані!";
    }
    
    if ($error_date == "" && $error_venue == "" && $error_city =="" && $error_country == "") {
    $sql = "UPDATE `concerts` SET `concert_date`='".$_POST['date']."', `venue`='".$_POST['venue']."', `city`='".$_POST['city']."', `country`='".$_POST['country']."', `published`='".$published."' WHERE concert_id='$id_'";
        
        mysqli_query($dblink, $sql);
    }
}

?>

<?php if (mysqli_num_rows($result) == 0) {
?>
        <h3 class="err_message" style="text-align:center; color:red">Помилка, сторінки не існує!</h3>
<?php
    } else {
    ?>
    
    <form class="form" name="myForm" id="updateConcert" action="" method="post" >
	<label for="date">Дата </label><br>
	<input type="text" name="date" id="date" value="<?= $row['concert_date'] ?>"/>
    <p><?= $error_date; ?></p>
    
	<label for="venue">Місце проведення </label><br>
	<input type="text" name="venue" id="venue" value="<?= $row['venue'] ?>"/>
    <p><?= $error_venue; ?></p>
    
    <label for="city">Місто </label><br>
	<input type="text" name="city" id="city" value="<?=$row['city']?>"/>
    <p><?= $error_city; ?></p>
    
    <label for="country">Країна </label><br>
	<input type="text" name="country" id="country" value="<?=$row['country']?>"/>
    <p><?= $error_country; ?></p>
    
    <div>
    <input type="radio" name="visible" value="yes" checked>Видимий<Br>
    <input type="radio" name="visible" value="no">Невидимий
    </div>
    <p></p>
	<input type="submit" id="button" value="Надіслати" 
           name="submit"/>
</form>
    
<?php   
}
?>


