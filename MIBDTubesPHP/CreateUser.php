<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE Username = ? AND PasswordHash = ?";
    $params = [$username, $password];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "Login berhasil!";
    } else {
        echo "Username atau password salah.";
    }
}
?>
