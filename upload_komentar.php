<?php
session_start();
require 'testsql.php'; // koneksi ke database

$userId = $_SESSION['user']['id'];
$komen = $_POST['komentar'];
$videoId = $_POST['id_video'];

$idVideo = isset($_POST['idVideo']) ? (int) $_POST['idVideo'] : 0;

if ($idVideo <= 0) {
    die("ID video tidak valid.");
}


if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $fotoProfil = $_SESSION['user']['profil'];
    // Lanjutkan dengan logika aplikasi Anda
} else {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idVideo = isset($_POST['idVideo']) ? (int) $_POST['idVideo'] : 0;
    $idUser = $_SESSION['user']['id'];
    $komentar = trim($_POST['komentar']);

    $tsql = "INSERT INTO Komen (idVideo, idUser, komen, tanggal, isActive) VALUES (?, ?, ?, GETDATE(), 1)";
    $params = array($idVideo, $idUser, $komentar);

    $stmt = sqlsrv_prepare($conn, $tsql, $params);

    if ($stmt) {
        sqlsrv_execute($stmt);
    } else {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Redirect kembali ke halaman video
header("Location: PageView.php?id=" . urlencode($idVideo));
exit;
?>