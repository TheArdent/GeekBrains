<h3>Добро пожаловать,<?=$login?>!</h3>
<a href="Admin">Консоль редактора</a><br/>
<? if (isset($admin) && $admin) : ?>
    <a href="Admin/Roles">Админка</a><br/>
<? endif; ?>
<button id="logout" onclick="userLogout()">Выйти</button>