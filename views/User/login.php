<? if (isset($error) && $error): ?>
<h4 style="color: red;">
    <?=$error?>
</h4>
<? endif ?>
E-mail: <input id="login" type="text" name="login" style="width: 150px"/><br/>
Пароль: <input id="password" type="password" name="password" style="width: 150px"/><br/>
<input id="remember" type="checkbox" name="remember" /> Запомить меня<br/>
<button onclick="userLogin()">Войти</button>
<button onclick="userRegister()">Зарегестрироваться</button>