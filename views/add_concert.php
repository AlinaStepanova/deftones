<style>
   #addConcertForm {
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
     $server = 'mysql.zzz.com.ua'; 
    $user = 'alinastepanova'; 
    $password = '0501010121avs';
    $dblink = mysqli_connect($server, $user, $password);
    $database = 'alinastepanova'; 
    $selected = mysqli_select_db($dblink, $database);
    mysqli_query($dblink, "SET NAMES 'utf8'");

    $error_date = "";
    $error_venue = "";
    $error_city = "";
    $error_country = "";

if (isset($_POST['submit'])) {
    $date = mysqli_real_escape_string($dblink, $_POST['date']);
    $venue = mysqli_real_escape_string($dblink, $_POST['venue']);
    $country = mysqli_real_escape_string($dblink, $_POST['country']);
    $city = mysqli_real_escape_string($dblink, $_POST['city']);
    
    if (!preg_match("/^[0-9]{4}\.(0[1-9]|1[0-2])\.(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
        $error_date .= 'Введіть дату у форматі yyyy.mm.dd!';
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
    $sql = "INSERT INTO `concerts` (`author_id`, `published`, `concert_date`, `venue`, `city`, `country`) VALUES ('".$_SESSION['id_user']."','".$_SESSION['admin']."','".$date."','".$venue."','".$city."', '".$country."')";
    mysqli_query($dblink, $sql);
?>
    <h3 class="success_concert" style="text-align:center";>Концерт успішно додано!</h3>
<?php
    }   
}
?>

<form class="form" name="myForm" id="addConcertForm" action="" method="post" >
	<label for="date">Дата </label><br>
	<input type="text" name="date" id="date" value=""/>
    <p><?= $error_date; ?></p>
    
	<label for="venue">Місце проведення </label><br>
	<input type="text" name="venue" id="venue" value=""/>
    <p><?= $error_venue; ?></p>
    
    <label for="city">Місто </label><br>
	<input type="text" name="city" id="city" value=""/>
    <p><?= $error_city; ?></p>
    
    <label for="country">Країна </label><br>
	<input type="text" name="country" id="country" value=""/>
    <p><?= $error_country; ?></p>
    
	<input type="submit" id="button" value="Надіслати" 
           name="submit"/>
</form>