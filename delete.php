<?php
include 'connect.php';

$this_id = $_GET['this_id'];

$sql = "DELETE FROM concert WHERE id='$this_id' ";

mysqLi_query($conn, $sql);

header('location:admin.php');
