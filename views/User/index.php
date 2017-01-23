<h3>Добро пожаловать,<?=$login?>!</h3>
<a href="index.php?ctrl=Admin">Консоль редактора</a><br/>
<? if (isset($admin) && $admin) : ?>
    <a href="index.php?ctrl=Admin&action=Roles">Админка</a><br/>
<? endif; ?>
<button id="logout" onclick="userLogout()">Выйти</button>