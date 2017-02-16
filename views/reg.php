<?php
    $array = array();
    $sub = array();
    $file2 = fopen("./district.txt", "r");
    $i=1;
    while(!feof($file2)) {
        $word[$i]=fgets($file2);
        $i++;
    }
    fclose($file2);  
?>

	<form class="form" name="myForm" id="myForm" action="" method="post">

		<label for="username">Логін </label>
		<br>
		<input type="text" name="username" id="login" value="" />
		<p id="msg1"></p>

		<label for="email">Email</label>
		<br>
		<input id="email" name="mail" type="text">
		<p id="msg2"></p>

		<label for="password">Пароль</label>
		<br>
		<input id="password" name="password" type="password" placeholder="Пароль">
		<p id="msg3"></p>

		<label for="confirm_password"></label>
		<input id="confirm_password" name="confirm_password" type="password" placeholder="Пароль ще раз">
		<br>
		<br>

		<select class="select" name="district" required>
			<option disabled selected>Оберіть область</option>
			<?php
								foreach($word as $key => $value):
								echo '<option value="'.$key.'">'.$value.'</option>';
								endforeach;?>
		</select>
		<br>
		<br>

		<input type="submit" id="button" value="Зареєструватися" />
	</form>