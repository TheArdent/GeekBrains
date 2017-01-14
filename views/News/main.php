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
    </script>
</head>
<body onload="loadComments()">
	<h1>PHP. Уровень 2</h1><br/>
	<?=$content?>
	<hr/>
	<small><a href="http://prog-school.ru">Школа Программирования</a> &copy;</small>
</body>
</html>
