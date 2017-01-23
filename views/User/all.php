<? foreach ( $users as $user) : ?>
	<div>
		<strong>Пользователь : </strong><?=$user['login']?>
		<strong>Роль : </strong>
		<input id="roles" name="role" type="text" style="width: 100px" value="<?=$user['name']?>"/>
		<input id="buttonchange" type="button" onclick="changeUser(<?=$user['id_user']?>,this)" value="Изменить"/>
	</div>
<? endforeach;?>
