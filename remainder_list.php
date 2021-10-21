<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$name = '';
$tab = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $find = new SearchFromNamesRemainder($id);
    $noms = $find->result_data;

    //var_dump($noms);

    foreach ($noms as $nom){
        $name = trim($nom['name']);
        $apteka = $nom['apteka'];
        $adres = $nom['adres'];
        $tel = $nom['tel'];
        $price = $nom['price'];
        $quantity = $nom['quantity'];
        $relevance = $nom['relevance'];
        $price_zak = $nom['price_zak'];
        $date_pr = $nom['date_pr'];
        $date_sr = $nom['date_sr'];

        $tab .= "<tr>";
        $tab .= "<td>$apteka<br>$adres<br>$tel</td>
                 <td>$price_zak</td>
                 <td>$price</td>
                 <td>$quantity</td>
                 <td>$date_pr</td>
                 <td>$date_sr</td>
                 <td>$relevance</td>";
        $tab .= "</tr>";
    }
}

if (isset($_POST['close'])) {

    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './names_remainder.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        $str_search = './names_remainder.php';
    }
    header("location: $str_search");
}

require_once "./remainder_list.html";