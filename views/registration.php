<style>
p {
    font-size: 11pt;
    text-shadow: none;
    color: #d02929;
    text-shadow: 1px 1px 1px rgba(134, 86, 86, 0.65);
}
</style>

<?php
//_________________________________DATABASE___________________________________________________________//

    $server = 'mysql.zzz.com.ua'; 
    $user = 'alinastepanova'; 
    $password = '0501010121avs'; 
    $dblink = mysqli_connect($server, $user, $password);
    
    $database = 'alinastepanova'; 
    $selected = mysqli_select_db($dblink, $database);
    mysqli_query($dblink, "SET NAMES 'utf8'");
    
//----------------------------------VALIDATION--------------------------------------------------------//

    $file = fopen("views/district.txt", "r");
    $i=1;
    while(!feof($file)) {
        $word[$i]=fgets($file);
        $i++;
    }
    fclose($file);

    $error_login = "";
    $error_email = "";
    $error_pasword = "";
    $error_confirm = "";
    $error_option = "";

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    echo $login;
    echo $password;
    
    if(!preg_match('/[a-z0-9_-а-яєїіґ]{4,255}/i', $login)) {
        $error_login .= 'Некоректний логін!';
    }
    if(!preg_match('/[0-9a-z_-]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i', $email)) {
        $error_email .= "Некоректний email!";
    }
    if(!preg_match('/[a-z0-9_-а-яєїіґ]{7,255}/i', $password)) {
        $error_pasword .= "Некоректний пароль!";
    }
    if ($password != $confirm_password) {
        $error_confirm .= "Паролі не однакові!";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    if(!isset($_POST['district'])){
        $error_option .= "Оберіть область!";
    }
    else if(($_POST['district'] < 1) || ($_POST['district'] > 27)) {
        $error_option .= "Некоректна область!";
    }
    
    if ($error_confirm == "" && $error_email == "" && $error_login =="" && $error_option == "" && $error_pasword == "") {
        $sql = "INSERT INTO `users` (`login`, `email`, `password`, `district`) VALUES ('".$_POST['login']."','".$_POST['email']."','".$password."','".$_POST['district']."')";
        mysqli_query($dblink, $sql);
        //Выполняет запрос к базе данных
        
        header("Location: index.php?action=registration_finish");
    }
}
//________________________________FORM______________________________________________________//
?>

<form class="form" name="myForm" id="myForm" action="" method="post">
    
	<label for="username">Логін </label><br>
	<input type="text" name="login" id="login" value=""/>
	<p><?= $error_login; ?></p>
	
	<label for="email">Email</label><br>
    <input id="email" name="email" type="text">
    <p><?= $error_email; ?></p>
    
	<label for="password">Пароль</label><br>
    <input id="password" name="password" type="password" placeholder="Пароль">
    <p><?= $error_pasword; ?></p>
    
    <label for="confirm_password"></label>
    <input id="confirm_password" name="confirm_password" type="password" placeholder="Пароль ще раз">
    <p><?= $error_confirm; ?></p>
    
    <select class="select" name="district" min=0 max=27 id="district" required>
        <option disabled selected>Оберіть область</option>
        <?php
            foreach($word as $key => $value):
            echo '<option value="'.$key.'">'.$value.'</option>';
            endforeach;
        ?>
    </select>
    <p><?= $error_option; ?></p>
    
	<input type="submit" id="button" value="Зареєструватися" 
           name="submit"/>
</form>
