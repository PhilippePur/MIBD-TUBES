<?php
require_once 'testsql.php';
header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: application/json");

$videoId = $_POST['video_id'] ?? null;
$action = $_POST['action'] ?? null;
$userId = 2; // ID user yang login — ganti sesuai kebutuhan

if (!$videoId || !$action) {
    // echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    exit;
}

// Cek apakah user sudah memberi like/dislike sebelumnya
$cekSql = "SELECT * FROM Tonton WHERE idVideo = ? AND idUser = ?";
$stmt = sqlsrv_query($conn, $cekSql, [$videoId, $userId]);

if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    // Jika sudah ada, update like/dislike
    $update = "UPDATE Tonton SET likeDislike = ? WHERE idVideo = ? AND idUser = ?";
    sqlsrv_query($conn, $update, [$action, $videoId, $userId]);
} else {
    // Jika belum ada, insert baru
    $insert = "INSERT INTO Tonton (idVideo, idUser, lamaMenonton, likeDislike) VALUES (?, ?, 0, ?)";
    sqlsrv_query($conn, $insert, [$videoId, $userId, $action]);
}

// Hitung total like & dislike
$countSql = "SELECT 
    SUM(CASE WHEN likeDislike = 1 THEN 1 ELSE 0 END) AS likes,
    SUM(CASE WHEN likeDislike = 2 THEN 1 ELSE 0 END) AS dislikes
    FROM Tonton WHERE idVideo = ?";
$stmt = sqlsrv_query($conn, $countSql, [$videoId]);
$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// Kirim respons JSON
echo json_encode([
    'success' => true,
    'likes' => $data['likes'] ?? 0,
    'dislikes' => $data['dislikes'] ?? 0
]);
?>