<?php
require_once ('config.php');

$article_title = "New article title!";
$article_content = "Article content here!";

try {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
    $conn = new PDO($connect_str, DB_USER, DB_PASS);

    $row = $conn->exec("INSERT INTO articles (title, content) VALUES ('$article_title','$article_content')");

    $errors = $conn->errorInfo();

    echo "Статья успешно добавленна!";

    if ( $conn->errorCode() != 0000 )
        echo "SQL error :".$errors[2]."<br/>";

    $conn = null;
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}


