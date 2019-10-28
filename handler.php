<?php
session_start();
include_once 'db.php';
require_once 'functions.php';

$name = htmlspecialchars($_POST['name']);
$text = htmlspecialchars($_POST['text']);

if(!empty($name) && !empty($text)){

    if(check_length($name, 4, 20) && check_length($text, 2, 1000)){
        //SQL запрос в БД на вставку данных
        $insert = "INSERT INTO blog.comments (`name`, `comments`) 
        VALUES (:name, :text);";

        //Так как в запросе есть переменная, его нужно сперва подготовить
        $statement = $pdo->prepare($insert);
        
        //Выполняем
        $statement->execute($_POST);
        $_SESSION['flash'] = 'Ваш комментарий добавлен';
        /*if(clean($name) && clean($text)){
            
        }*/
    }
}

header('Location: /marlin/index.php');

?>