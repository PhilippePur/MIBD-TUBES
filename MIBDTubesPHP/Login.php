<?php
session_start();
require_once 'testsql.php';

if (!isset($_POST['login'])) {
  header("Location: index.php"); exit;
}

$user = trim($_POST['username']);
$pass = $_POST['password'];

/* query cari user */
$sql  = "SELECT Id, Username, Email, Pass
         FROM Users WHERE Username = ? OR Email = ?";
$params = [$user, $user];
$stmt = sqlsrv_query($conn, $sql, $params);


if ($stmt && ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))) {
    /* verifikasi password tanpa hash */
    if ($pass === $row['Pass']) {
        $_SESSION['uid']   = $row['Id'];
        $_SESSION['uname'] = $row['Username'];
        header("Location: homePage.php");   // halaman sesudah login
        exit;
    }
}

/* jika gagal */
echo "<script>alert('Login gagal! username/email atau password salah'); 
      window.location.href='index.php';</script>";
