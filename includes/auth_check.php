<?php 

function cekLogin ()
{
    if (!isset($_SESSION['logged_in'])) {
        header("Location: /../auth/login.php");
        return;
    }
}

?>