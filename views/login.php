<style>
   #formLogin {
    min-height: inherit;
</style>

<?php
     $server = 'mysql.zzz.com.ua'; 
    $user = 'alinastepanova'; 
    $password = '0501010121avs';
    $dblink = mysqli_connect($server, $user, $password);
    $database = 'alinastepanova'; 
    $selected = mysqli_select_db($dblink, $database);
    mysqli_query($dblink, "SET NAMES 'utf8'");

    $error = "";

    if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $is_login = mysqli_query($dblink, "SELECT * FROM users WHERE login = '$login'"); 
        
    $row = mysqli_fetch_assoc($is_login);
    //повертає ряд у вигляді асоціативного масиву
    $hash_pass = isset($row['password']) ? $row['password'] : "";
       
    if (mysqli_num_rows($is_login) > 0 && password_verify($password, $hash_pass)) { 
?>
        <a href="index.php"><h3 class="to_index" style="text-align:center;">На головну</h3></a>
<?php
        //session_start();
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['login'] = $row['login'];
        $_SESSION['admin'] = $row['admin'];
        
    }
    else {
?>
        <h3 class="err_message" style="text-align:center; color:red">Неправильний логін або пароль!</h3>
<?php   
    } 
}
?>

<form class="form" name="myForm" id="formLogin" action="" method="post" >
	<label for="username">Логін </label><br>
	<input type="text" name="login" id="login" value=""/>
    <p></p>
    
	<label for="password">Пароль</label><br>
    <input id="password" name="password" type="password" placeholder="Пароль">   
    <p></p>
    
	<input type="submit" id="button" value="Увійти" 
           name="submit"/>
</form>