<?php
session_start();
unset($_SESSION["token"]);
header("Location: /dang-nhap");
?>