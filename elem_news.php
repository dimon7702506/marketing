<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$errors = '';
$autor = '';
$autor_id = get_user_id();
$theme = null;
$news = '';

$visible = '';
$visible_checked = '';
$visible_value = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field = 'all';
    $find = new GetData('news', $id, 'ID', 'elem');
    $noms = $find->result_data;

    foreach ($noms as $nom){
        $autor = $nom['autor'];
        $theme = $nom['theme'];
        $news = $nom['news'];

        $visible = (int)$nom['visible'];
        if ($visible == 1) {$visible_checked = 'checked';}
    }
}

if (isset($_POST['save']) || isset($_POST['copy'])){

    $check = new CheckFields('Тема', 'text', 1, '', 200, $_POST['theme']);
    $theme = $check->value;
    $errors .= $check->error;

    $check = new CheckFields('news', 'text', 30, 200, 2000, $_POST['news']);
    $news = $check->value;
    $errors .= $check->error;

    if (!empty($_POST['visible'])){$visible_value = $_POST['visible'];}
    if ($visible_value == 'on'){$visible = 1;}else{$visible = 0;}

    if (empty($errors)){
        $element = ['id'=>$id,
                    'autor_id'=>$autor_id,
                    'theme'=>Trim($theme),
                    'news'=>Trim($news),
                    'visible'=>$visible];

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