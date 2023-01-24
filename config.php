<?php
$db = mysqli_connect('localhost', 'root', 'rev', 'webspp');
if (!$db) {
    throw new Exception("Database gagal terkoneksi", 1);
}
?>