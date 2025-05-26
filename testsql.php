<?php
$serverName = "localhost\\SQLEXPRESS"; // atau "localhost\\SQLEXPRESS"
$connectionOptions = [
    "Database" => "Tubes",
    "TrustServerCertificate" => true
];

// Koneksi ke SQL Server dengan Windows Authentication
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    echo "Koneksi sukses!";
} else {
    echo "Gagal konek.<br>";
    die(print_r(sqlsrv_errors(), true));
}
?>
