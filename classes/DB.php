<?php

define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','Geekbrains');
define('DB_USER','root');
define('DB_PASS','123');

/*
 *
 * try {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
    $conn = new PDO($connect_str, DB_USER, DB_PASS);

    $result = $conn->query("SELECT * FROM articles WHERE 1");

    $errors = $conn->errorInfo();

    if ( $conn->errorCode() != 0000 )
        echo "SQL error :".$errors[2]."<br/>";
    echo "<table border='1' style='width:50%;margin: auto'>";
    while($row = $result->fetch())
    {
        echo "<tr><td>".$row['id_articles']."</td><td>".$row['title']."</td><td>".$row['content']."</td></tr>";
    }
    echo "</table>";

    $conn = null;
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}



 */