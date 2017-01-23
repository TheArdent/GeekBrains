<?php

class AdminController
{

	public static function actionAdd()
	{
		$User = new Users;
		$view = new View();
		if ($User->Can('CREATE_ARTICLE')) {
			$error = false;
			$New = News::Instance();
			if (isset($_POST['title']) && isset($_POST['content']) && $User->GetUid()) {
				$error = !$New->Add($_POST['title'], $_POST['content'], $User->GetUid());
				if (!$error) {
					header('Location: index.php?ctrl=Admin');
				}
			}
			$view->title = 'Добавление статьи';
			$view->error = $error;
			$view->content = $view->render('News/new');
			$view->display();
		}
		else {
			$view->title = 'Недостаточно прав!';
			$view->content = $view->render('User/error');
			$view->display();
		}
	}

	public static function actionEdit()
	{
		$User = new Users;
		$view = new View();
		$New = News::Instance();
		if (!$User->Can('EDIT_ANY_ARTICLE') and !( $User->Can('EDIT_UR_ARTICLE') && $User->GetUid() == $New->Get($_GET['id'])['id_user'])){
			$view->title = 'Недостаточно прав!';
			$view->content = $view->render('User/error');
			$view->display();
		}
		else {
			$error = false;
			if (isset($_POST['delete_id'])) {
				$error = !$New->Delete($_POST['delete_id']);
				if (!$error) {
					header('Location: index.php?ctrl=Admin');
				}
			}
			if (isset($_POST['title']) && isset($_POST['content'])) {
				$error = !$New->Edit($_GET['id'], $_POST['title'], $_POST['content']);
				if (!$error) {
					header('Location: index.php?ctrl=Admin');
				}
			}

			$view->title = 'Редактирование статьи статьи';
			$view->error = $error;
			$New = News::Instance();
			$view->article = $New->Get($_GET['id']);

			$view->content = $view->render('News/edit');
			$view->display();
		}
	}

	public function actionAll()
	{
		$User = new Users();
		$view = new View();
		if ($User->Get()) {
			$New = News::Instance();
			$news = $New->All();
			$view->articles = $news;
			$view->title = 'Главная страница редактора';
			$view->content = $view->render('News/editor');
			$view->display();
		}
		else {
			$view->title = 'Недостаточно прав!';
			$view->content = $view->render('User/error');
			$view->display();
		}
	}

	public function actionRoles()
	{
		$User = new Users();
		$view = new View();
		if ($User->Can('EDIT_USER_ROLES'))  {
			if (isset($_GET['user_id']) && isset($_GET['role']))    {
				$User->SetRoleUser($_GET['user_id'],$_GET['role']);
			}
			$view->title = 'Редактирование прав пользователей';
			$view->users = $User->GetAllUser();
			$view->content = $view->render('User/all');
			$view->display();
		}
		else {
			$view->title = 'Недостаточно прав!';
			$view->content = $view->render('User/error');
			$view->display();
		}
	}
}