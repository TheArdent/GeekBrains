<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$title?></title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" media="screen" href="views/News/style.css" />
    <script src="jquery.js"></script>
    <script>
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }

        function loadComments(){
            var id = getUrlVars()["id"];
            var str = "ctrl=Comments&action=All&id="+id;
            $.ajax({
                type: "GET",
                url: "index.php",
                data: str,
                success: function(msg){
                    $("div.comments").html(msg);
                }
            });
        }

        function addcomment(){
            var id = getUrlVars()["id"];
            var name = $("#name").val();
            var text = $("#message").val();

            var str = "ctrl=Comments&action=Add&id="+id+"&name="+name+"&text="+text;
            $.ajax({
                type: "POST",
                url: "index.php",
                data: str,
                success: loadComments()
            });
        }

        function userLogin() {
            var login = $("#login").val();
            var passwd = $("#password").val();
            var remember = $("#remember").is(':checked');

            var str = "ctrl=User&action=login&login="+login+"&password="+passwd+"&remember="+remember;
            $.ajax({
                type: "POST",
                url: "index.php",
                data: str,
                success: function(msg){
                    $("div.login").html(msg);
                }
            });
        }

        function userRegister() {
            var login = $("#login").val();
            var passwd = $("#password").val();

            var str = "ctrl=User&action=register&login="+login+"&password="+passwd;
            $.ajax({
                type: "POST",
                url: "index.php",
                data: str,
                success: function(msg){
                    $("div.login").html(msg);
                }
            });
        }

        function userLogout() {
            $.ajax({
                type: "POST",
                url: "index.php",
                data: "ctrl=User&action=logout",
                success: function(msg){
                    $("div.login").html(msg);
                }
            });
        }

        function userIndex(){
            $.ajax({
                type: "POST",
                url: "index.php",
                data: "ctrl=User&action=index",
                success: function(msg){
                    $("div.login").html(msg);
                }
            });
        }

        function changeUser(user_id,item) {
            var role = $(item).prev('#roles').val();

            var str = "ctrl=Admin&action=Roles&user_id="+user_id+"&role="+role;
            $.ajax({
                type: "GET",
                url: "index.php",
                data: str,
                success: function(msg){
                    alert('Данные успешно изменены!');
                }
            });
        }

        function loadpage() {
            loadComments();
            userIndex();
        }
    </script>
</head>
<body onload="loadpage()">
    <div>
	    <h1 style="float: left;width: 70%">PHP. Уровень 2</h1>
        <div style="float:right;width: 30%;text-align: right">
            <div class="login"></div>
        </div
    </div>
    <div class="content" style="clear: both">
	<?=$content?>
    </div>
	<hr/>
	<small><a href="http://prog-school.ru">Школа Программирования</a> &copy;</small>
</body>
</html>
