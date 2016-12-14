<?php
require_once ('config.php');

try {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
    $conn = new PDO($connect_str, DB_USER, DB_PASS);

    if (isset($_GET['id_articles']))
    {
        if (is_numeric($_GET['id_articles']) && (int)$_GET['id_articles'] == $_GET['id_articles'] )
        {
            $id_articles = (int)$_GET['id_articles'];

            $result = $conn->query("SELECT * FROM articles WHERE id_articles=$id_articles");

            $errors = $conn->errorInfo();

            if ($conn->errorCode() != 0000)
                echo "SQL error :" . $errors[2] . "<br/>";

            if ($result->rowCount())
            {
                while ($row = $result->fetch()) {
                    echo "id_articles = ".$row['id_articles']."<br/>title = ".$row['title']."<br/>content = ".$row['content'];
                }
            }
            else echo "<h3>Ошибка!Записи с id_articles = $id_articles не найдено!</h3>";
        }
        else
            echo "<h3>Ошибка!Номер записи должен быть целочисленным!</h3>";
    }
    else
    {
        echo "<h3>Ошибка!Введите номер записи в GET запрос(/article.php?id_articles=номер записи)</h3>";
    }

    $conn = null;
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}