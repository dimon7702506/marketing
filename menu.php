<?php

//var_dump($_SESSION);
if ($_SESSION['role_id'] == 1){
    include "./menu.html";
}else{
    include "./menu_apteka.html";
}