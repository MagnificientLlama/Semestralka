<?php

if (isset($_SESSION['userPrivilegy'])) {
    if ($_SESSION['userPrivilegy'] < 3) {
        echo $_SESSION['userPrivilegy'];
        header('Location: index.php');
        die();
    }
}else{
    header('Location: index.php');
    die();
}
//echo $_SESSION['userPrivilegy'];
