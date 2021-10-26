<?php

require_once "./function.php";
require_once "autoload.php";

$field = '';
$text_search = '';
$field_search = '';
$sp_type = 'news';

$cols = ['id'=>'ID'];
$cols += ['date_news'=>'Дата',
          'autor'=>'Автор',
          'Theme'=>'Тема'];
$cols += ['modif'=>'Модификация'];

$find = new GetData('news', $text_search, $field_search, 'list');
$res = $find->result_data;

    $result_tab = '';
    $id = 0;

    foreach($res as $r){
        if (isset($r['apteka_id'])) {
            if ($sp_type == 'invoices' && get_role_id() == 2) {
                if ($r['apteka_id'] !== get_apteka_id()) {continue;}
            }
        }
        $keys = array_keys($r);
        $result_tab .= '<tr>';
            foreach ($keys as $value) {
                if ($value == 'id' || $value == 'm_id' || $value == 'invoice_id'){$id = (int) $r[$value];}
                $result_tab .= '<td>' . $r[$value] . '</td>';
            }

            $result_tab .= '<td>' . "<a href=/elem_news.php?id=$id>изменить</a></td>";
        $result_tab .= '</tr>';
    }

    $count = count($res);
    setcookie('text_search', $text_search);
    setcookie('field_search', $field_search);
    setcookie('sp_type', $sp_type);

if (isset($_GET['submit_new'])) {header("location: ./elem_news.php?id=0");}

require_once "./spr_news.html";