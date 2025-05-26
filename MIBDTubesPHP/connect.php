<?php
$serverName = "DESKTOP-NHGRFV3\SQLEXPRESS"; // atau IP SQL Server
$connectionOptions = array(
    "Database" => "Davin",
    "Uid" => "Davin",
    "PWD" => "12345",
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die("Koneksi SQL Server gagal: " . print_r(sqlsrv_errors(), true));
} else {
    echo "Koneksi berhasil!";
}
?>