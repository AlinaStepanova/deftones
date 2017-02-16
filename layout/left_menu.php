<tr>
    <td style="width:15%" class="left_menu">
        <div id="mySidenav" class="sidenav">
        <a href="?action=main">Головна</a>
            <br>
        <a href="?action=about">Про сайт</a>
	       <br>
        <a href="?action=concerts"?>Концерти</a>
            <br>
        <a href="?action=registration"?>Реєстрація</a>
	       <br>  
            <?php if(isset($_SESSION['id_user']) && $_SESSION['id_user'] > 0) { ?>
        <a href="?action=add_concert"?>Додати концерт</a>
            <br>
        <a href="?action=logout"?>Вихід</a>
            <?php } else {?>
        <a href="?action=login"?>Вхід</a>
            <?php } ?>
        </div>
    </td>
<td>
