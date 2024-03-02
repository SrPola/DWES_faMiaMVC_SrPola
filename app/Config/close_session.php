<?php
    session_start();

    session_unset();
    
    // unset($_SESSION["variable_sesion"]);

    session_destroy();

    header("Location: ../index.php")
?>