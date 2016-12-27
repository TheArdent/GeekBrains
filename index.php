<?php
require_once 'classes.php';

// Здесь разместить код, использующий классы из classes.php

$newarticle1 = new NewsArticle(1,"First article","Content for first article");
$newarticle2 = new NewsArticle(2,"Second article","Content for second article");
$newarticle3 = new NewsArticle(3,"New article","Content for new article");


$crosarticle1 = new CrossArticle(4,"First cross article","Content for first cross article","http://geekbrains.loc/");
$crosarticle2 = new CrossArticle(5,"Second cross article","Content for second cross article","http://localhost/");
$crosarticle3 = new CrossArticle(6,"New cross article","Content for new cross article","http://127.0.0.1/");

$articleList = new ArticleList();

$articleList->add($newarticle1);
$articleList->add($newarticle2);
$articleList->add($newarticle3);

$articleList->add($crosarticle1);
$articleList->add($crosarticle2);
$articleList->add($crosarticle3);


$fullArticle1 = new FullArticle(7,"1st article with img","Content with google img","http://www.jobvine.co.za/Content/images/ig/google_logo.jpg");
$fullArticle2 = new FullArticle(8,"2nd article with img","Content with Chrome img","http://blog.sudobits.com/wp-content/uploads/2011/04/google-chrome-11-logo.jpg");

$articleList->add($fullArticle1);
$articleList->add($fullArticle2);