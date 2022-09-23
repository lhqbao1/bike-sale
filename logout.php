<?php
include 'connect.php';
session_start();
if (isset($_SESSION['mySession'])) {
    unset($_SESSION['mySession']); // xóa session login
    header('location:login.php');
}
