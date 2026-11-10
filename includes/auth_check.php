<?php 

function cekLogin ()
{
    if (!isset($_SESSION['logged-in'])) {
        header("Location: /../auth/login.php");
        return;
    }
}

?>