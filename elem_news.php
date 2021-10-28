<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$errors = '';
$autor = '';
$autor_id = get_user_id();
$theme = '';
$news = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field = 'all';
    $find = new GetData('news', $id, 'ID', 'elem');
    $noms = $find->result_data;
    //var_dump($noms);
    foreach ($noms as $nom){
        $autor = $nom['autor'];
        $theme = $nom['theme'];
        $news = $nom['news'];
    }
}

if (isset($_POST['save']) || isset($_POST['copy'])){

    $check = new CheckFields('theme', 'text', '', '', 200, $_POST['theme']);
    $theme = $check->value;
    $errors .= $check->error;

    $check = new CheckFields('news', 'text', 0, 200, 2000, $_POST['news']);
    $news = $check->value;
    $errors .= $check->error;

    //var_dump($errors);

    if (empty($errors)){
        $element = ['id'=>$id,
                    'autor_id'=>$autor_id,
                    'theme'=>Trim($theme),
                    'news'=>Trim($news)];

        if ($id == 0) {
            $method = 'new';
        }else{
            $method = 'update';}
        
        $save = new SetData('news', $element, $method);

        if ($method == 'new') {$id = $save->result;}
        header("location: ./elem_news.php?id=$id");
    }
}

if (isset($_POST['close'])) {header("location: ./spr_news.php");}

require_once "./elem_news.html";