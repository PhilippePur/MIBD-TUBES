<?php
require_once 'testsql.php';
session_start();

$videoId = $_GET['idVideo'] ?? ''; // ID video dari dashboard.php

$sql = "
SELECT
    V.idVideo AS idVideo,
    V.title AS videoTitle,
    V.thumbnail AS thumb,
    V.uploaded_at As VideoDate,
    V.idChannel
FROM Videos V 
WHERE V.idVideo = ?
";
$params = [];
$params[] = $videoId;
$stmt = sqlsrv_query($conn, $sql, $params);

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$userProfilePic = $_SESSION['fotoProfil'];

$videoThumb = isset($row['thumb']) ? $row['thumb'] : '';
$videoDate = isset($row['VideoDate'])  != null ? $row['VideoDate']->format('F d, Y') : 0;
$videoTitle = isset($row['videoTitle']) == null ? '' : $row['videoTitle'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idVideo = $_POST['idVideo'];
    $waktuMuncul = $_POST['waktu_muncul'];
    $waktuSelesai = $_POST['waktu_selesai'];
    $isiTeks = $_POST['isi_teks'];

    if (!$idVideo || !$waktuMuncul || !$waktuSelesai || !$isiTeks) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO Subtitle (idVideo, waktuMuncul, waktuSelesai, isiTeks)
            VALUES (?, ?, ?, ?)";
    $params = array($idVideo, $waktuMuncul, $waktuSelesai, $isiTeks);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "<script>alert('Subtitle berhasil ditambahkan.'); window.location.href='EditKonten.php?id=$idVideo';</script>";
}
function getViews($videoId)
{
    require 'testsql.php'; // Koneksi ke database
    $sql = "SELECT SUM(jumlahTonton) AS total_views FROM Tonton WHERE idVideo = ? ";
    $stmt = sqlsrv_query($conn, $sql, [$videoId]);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_close($conn);
    return $row['total_views'] ?? 0;
}
?>

<div data-layer="Subtitle Edit" class="SubtitleEdit"
    style="width: 1512px; height: 1160px; position: relative; background: white; overflow: hidden">
    <div data-layer="Youtube-Logo" class="YoutubeLogo"
        style="width: 381px; height: 84px; left: 36px; top: 77px; position: absolute; overflow: hidden">
        <div data-svg-wrapper data-layer="Vector" class="Vector" style="left: 0px; top: 0px; position: absolute">
            <svg width="121" height="84" viewBox="0 0 121 84" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M118.418 13.1176C117.024 7.95157 112.932 3.89182 107.725 2.50894C98.2967 7.51018e-07 60.4732 0 60.4732 0C60.4732 0 22.6501 7.51018e-07 13.2217 2.50894C8.01467 3.89182 3.9227 7.95157 2.52885 13.1176C7.56979e-07 22.4718 0 42 0 42C0 42 7.56979e-07 61.5283 2.52885 70.8826C3.9227 76.0486 8.01467 80.1083 13.2217 81.4909C22.6501 84 60.4732 84 60.4732 84C60.4732 84 98.2967 84 107.725 81.4909C112.932 80.1083 117.024 76.0486 118.418 70.8826C120.947 61.5283 120.947 42 120.947 42C120.947 42 120.937 22.4718 118.418 13.1176Z"
                    fill="#FF0000" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector" style="left: 48.37px; top: 24px; position: absolute">
            <svg width="32" height="36" viewBox="0 0 32 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.367188 35.9987L31.7887 18.0017L0.367188 0.00439453V35.9987Z" fill="white" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector"
            style="left: 132.90px; top: 5.96px; position: absolute">
            <svg width="40" height="73" viewBox="0 0 40 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14.4834 49.6151L0.90332 0.95752H12.7511L17.5103 23.0144C18.7248 28.4471 19.6108 33.0798 20.1883 36.9123H20.5367C20.935 34.1663 21.8312 29.5633 23.2151 23.0935L28.1431 0.95752H39.991L26.2415 49.6151V72.9562H14.4737V49.6151H14.4834Z"
                    fill="black" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector"
            style="left: 168.93px; top: 24.33px; position: absolute">
            <svg width="34" height="55" viewBox="0 0 34 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M7.55508 52.4135C5.16579 50.8133 3.46314 48.324 2.44756 44.9459C1.44214 41.5678 0.93457 37.0835 0.93457 31.4727V23.8371C0.93457 18.1772 1.51199 13.6238 2.66685 10.1962C3.8217 6.76865 5.62383 4.2597 8.07281 2.68915C10.5222 1.1186 13.7379 0.328369 17.7206 0.328369C21.6432 0.328369 24.7792 1.12847 27.1486 2.72867C29.5083 4.32883 31.2406 6.83778 32.3357 10.2357C33.4309 13.6435 33.9787 18.1772 33.9787 23.8371V31.4727C33.9787 37.0835 33.4411 41.5876 32.376 44.9854C31.3104 48.3933 29.5781 50.8826 27.1884 52.453C24.7991 54.0238 21.5534 54.8138 17.4615 54.8138C13.24 54.8235 9.9448 54.0137 7.55508 52.4135ZM20.9561 44.1756C21.6131 42.457 21.9518 39.6615 21.9518 35.7697V19.3826C21.9518 15.6092 21.6233 12.8434 20.9561 11.1049C20.2889 9.3566 19.1244 8.48737 17.4513 8.48737C15.8389 8.48737 14.6938 9.3566 14.0367 11.1049C13.3696 12.8533 13.0411 15.6092 13.0411 19.3826V35.7697C13.0411 39.6615 13.3594 42.4666 13.997 44.1756C14.6341 45.8943 15.7788 46.7536 17.4513 46.7536C19.1244 46.7536 20.2889 45.8943 20.9561 44.1756Z"
                    fill="black" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector"
            style="left: 208.17px; top: 25.35px; position: absolute">
            <svg width="33" height="54" viewBox="0 0 33 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M32.5182 52.9663H23.1795L22.144 46.526H21.8854C19.3462 51.3858 15.543 53.8155 10.4655 53.8155C6.95099 53.8155 4.35257 52.6698 2.67998 50.3883C1.00739 48.0964 0.170898 44.5209 0.170898 39.6611V0.357526H12.1085V38.9693C12.1085 41.3205 12.3671 42.9896 12.8849 43.9875C13.4026 44.985 14.2687 45.4886 15.4833 45.4886C16.5188 45.4886 17.5144 45.1727 18.4703 44.5406C19.4262 43.9081 20.123 43.108 20.5908 42.1403V0.347656H32.5182V52.9663Z"
                    fill="black" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector"
            style="left: 237.57px; top: 5.97px; position: absolute">
            <svg width="36" height="73" viewBox="0 0 36 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M35.9464 10.4878H24.0986V72.9642H12.4201V10.4878H0.572266V0.965698H35.9464V10.4878Z"
                    fill="black" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector"
            style="left: 269.39px; top: 25.35px; position: absolute">
            <svg width="33" height="54" viewBox="0 0 33 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M32.738 52.9663H23.3992L22.3638 46.526H22.1051C19.5664 51.3858 15.7631 53.8155 10.6852 53.8155C7.17072 53.8155 4.57232 52.6698 2.89973 50.3883C1.22714 48.0964 0.390625 44.5209 0.390625 39.6611V0.357526H12.3282V38.9693C12.3282 41.3205 12.5869 42.9896 13.1046 43.9875C13.6223 44.985 14.4885 45.4886 15.7034 45.4886C16.7385 45.4886 17.7342 45.1727 18.6901 44.5406C19.6459 43.9081 20.3427 43.108 20.8105 42.1403V0.347656H32.738V52.9663Z"
                    fill="black" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector"
            style="left: 308.94px; top: 3.30px; position: absolute">
            <svg width="35" height="76" viewBox="0 0 35 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M33.245 30.7625C32.5181 27.4436 31.3531 25.0433 29.7406 23.5518C28.1277 22.0603 25.9074 21.3194 23.0799 21.3194C20.8896 21.3194 18.8385 21.9318 16.9369 23.1666C15.0353 24.4013 13.5617 26.0113 12.5262 28.0165H12.4369V0.299683H0.9375V74.9553H10.794L12.0085 69.9771H12.2676C13.1934 71.7549 14.5773 73.1477 16.4192 74.1851C18.2611 75.2124 20.3122 75.726 22.5622 75.726C26.5944 75.726 29.5713 73.8789 31.4729 70.1942C33.3745 66.4999 34.33 60.7413 34.33 52.8986V44.5717C34.33 38.6943 33.9617 34.0814 33.245 30.7625ZM22.3031 52.2266C22.3031 56.0591 22.1439 59.0621 21.8252 61.2352C21.5068 63.4083 20.9789 64.9593 20.2224 65.8678C19.4757 66.7863 18.4601 67.2408 17.1956 67.2408C16.2101 67.2408 15.3041 67.0136 14.4676 66.5495C13.6316 66.095 12.9547 65.4037 12.4369 64.4948V34.6346C12.8349 33.2023 13.5321 32.0368 14.5176 31.1181C15.4934 30.1995 16.5686 29.7451 17.7133 29.7451C18.9283 29.7451 19.8639 30.2192 20.5213 31.1577C21.1881 32.1059 21.6461 33.6863 21.9052 35.9187C22.1638 38.151 22.2934 41.3217 22.2934 45.4407V52.2266H22.3031Z"
                    fill="black" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector" class="Vector"
            style="left: 347.60px; top: 24.35px; position: absolute">
            <svg width="33" height="55" viewBox="0 0 33 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.265 34.259C12.265 37.6371 12.3645 40.1659 12.5639 41.8551C12.7629 43.5439 13.1811 44.7691 13.8182 45.5494C14.4553 46.3197 15.4311 46.7049 16.7553 46.7049C18.5376 46.7049 19.772 46.0135 20.429 44.6406C21.0962 43.2676 21.4547 40.9761 21.5144 37.7757L31.8091 38.3779C31.8687 38.8324 31.8984 39.4645 31.8984 40.2646C31.8984 45.1244 30.5543 48.7595 27.8763 51.1598C25.1983 53.5601 21.4048 54.7651 16.5064 54.7651C10.6225 54.7651 6.5005 52.9377 4.14084 49.2732C1.77145 45.6087 0.59668 39.9487 0.59668 32.2833V23.0971C0.59668 15.2049 1.82141 9.43638 4.27039 5.8014C6.7198 2.16639 10.9112 0.348877 16.8548 0.348877C20.9467 0.348877 24.093 1.08971 26.2833 2.58126C28.4736 4.07276 30.0167 6.38415 30.9129 9.53516C31.8091 12.6861 32.257 17.0323 32.257 22.5834V31.592H12.265V34.259ZM13.7784 9.46603C13.171 10.2068 12.773 11.4218 12.5639 13.1109C12.3645 14.8 12.265 17.3583 12.265 20.7959V24.5692H20.9967V20.7959C20.9967 17.4176 20.8773 14.8592 20.6483 13.1109C20.4193 11.3625 20.001 10.1377 19.3935 9.41663C18.7865 8.70545 17.8505 8.33996 16.586 8.33996C15.3117 8.34983 14.3758 8.72519 13.7784 9.46603Z"
                    fill="black" />
            </svg>
        </div>
    </div>
    <div data-svg-wrapper data-layer="Vector 2" class="Vector2"
        style="left: 1221.97px; top: 177.43px; position: absolute">
        <svg width="5" height="3" viewBox="0 0 5 3" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.9668 1.42566H3.20153" stroke="white" stroke-width="2" stroke-linecap="round" />
        </svg>
    </div>
    <div data-layer="Line 5" class="Line5" style="width: 931px; height: 0px; left: 397px; top: 229px; position: absolute; transform: rotate(90deg);
    transform-origin: top left; outline: 1px black solid; outline-offset: -0.50px">
    </div>
    <div data-layer="Line 6" class="Line6"
        style="width: 1512px; height: 0px; left: 0px; top: 229px; position: absolute; outline: 1px black solid; outline-offset: -0.50px">
    </div>
    <div data-layer="Rectangle 27" class="Rectangle27"
        style="width: 320px; height: 165px; left: 36px; top: 274px; position: absolute; background: #E179CF; border-radius: 20px">
        <img src="<?= htmlspecialchars(string: $userProfilePic) ?>" alt="Thumbnail"
            style="width: 100%; height: 100%; border-radius: 20px;">
    </div>
    <div data-layer="Ini merupakan video pertamaku yang berjudul...." class="IniMerupakanVideoPertamakuYangBerjudul"
        style="width: 258px; height: 28px; left: 47px; top: 509px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 20px; font-family: Roboto; font-weight: 400; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
        Ini merupakan video pertamaku yang berjudul....</div>
    <div data-layer="35 Views" class="Views"
        style="width: 71px; height: 28px; left: 47px; top: 550px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 14px; font-family: Roboto; font-weight: 400; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
        35 Views</div>
    <div data-layer="KONTEN 1 (Ini Ceritanya JUDUL)" class="Konten1IniCeritanyaJudul"
        style="width: 402px; left: 47px; top: 469px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 20px; font-family: Roboto Slab; font-weight: 700; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
        <?= htmlspecialchars($videoTitle) ?></div>
    <div data-svg-wrapper data-layer="Rectangle 31" class="Rectangle31"
        style="left: 508px; top: 336px; position: absolute">
        <svg width="1" height="1" viewBox="0 0 1 1" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="1" height="1" fill="#D9D9D9" />
        </svg>
    </div>
    <div data-layer="Rectangle 32" class="Rectangle32"
        style="width: 988px; height: 839px; left: 482px; top: 296px; position: absolute; background: #D9D9D9; border-radius: 35px">
    </div>
    <img data-layer="MainProfile" class="Mainprofile"
        style="width: 120px; height: 120px; left: 1308px; top: 58px; position: absolute; border-radius: 200px"
        src="Assets/MainProfile.jpg" />
    <div data-layer="Rectangle 33" class="Rectangle33"
        style="width: 320px; height: 165px; left: 1086px; top: 337px; position: absolute; background: #E179CF; border-radius: 20px">
    </div>

    <div data-svg-wrapper data-layer="add" class="Add" style="left: 506px; top: 695px; position: absolute">
        <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M20.5 10.25C21.4435 10.25 22.2083 11.0148 22.2083 11.9583L22.2083 18.7917L29.0417 18.7917C29.9852 18.7917 30.75 19.5565 30.75 20.5C30.75 21.4435 29.9852 22.2083 29.0417 22.2083H22.2083L22.2083 29.0417C22.2083 29.9852 21.4435 30.75 20.5 30.75C19.5565 30.75 18.7917 29.9852 18.7917 29.0417L18.7917 22.2083H11.9583C11.0148 22.2083 10.25 21.4435 10.25 20.5C10.25 19.5565 11.0148 18.7917 11.9583 18.7917H18.7917L18.7917 11.9583C18.7917 11.0148 19.5565 10.25 20.5 10.25Z"
                fill="black" />
        </svg>
    </div>

    <textarea name="isi_teks" data-layer="Rectangle 37" class="Rectangle37" style="width: 450px; height: 141px; left: 508px; top: 356px; position: absolute; 
           background: rgba(217, 217, 217, 0); border-radius: 10px; 
           border: 1px black solid; resize: none;">
    </textarea>

    <div data-layer="Rectangle 46" class="Rectangle46"
        style="width: 250px; height: 487px; left: 1121px; top: 523px; position: absolute; background: rgba(217, 217, 217, 0); border-radius: 10px; border: 1px black solid">
    </div>

    <textarea name="isi_teks" data-layer="Rectangle 38" class="Rectangle38" style="width: 450px; height: 141px; left: 508px; top: 545px; position: absolute;
        background: rgba(217, 217, 217, 0); border-radius: 10px;
        border: 1px black solid; resize: none;">
    </textarea>

    <input type="text" name="waktu_menit" placeholder="mm:ss" data-layer="Rectangle 40" class="Rectangle40" style="width: 100px; height: 34px; left: 964px; top: 372px; position: absolute;
           background: rgba(217, 217, 217, 0); border-radius: 10px;
           border: 1px black solid; text-align: center;" />

    <input type="text" name="waktu_menit" placeholder="mm:ss" data-layer="Rectangle 40" class="Rectangle40" style="width: 100px; height: 34px; left: 964px; top: 372px; position: absolute;
           background: rgba(217, 217, 217, 0); border-radius: 10px;
           border: 1px black solid; text-align: center;" />

    <input type="text" name="waktu_menit_3" placeholder="mm:ss" data-layer="Rectangle 42" class="Rectangle42" style="width: 100px; height: 34px; left: 963px; top: 561px; position: absolute;
    background: rgba(217, 217, 217, 0); border-radius: 10px;
    border: 1px black solid; text-align: center;" />


    <input type="text" name="waktu_menit_2" placeholder="mm:ss" data-layer="Rectangle 41" class="Rectangle41" style="width: 100px; height: 34px; left: 964px; top: 448px; position: absolute;
           background: rgba(217, 217, 217, 0); border-radius: 10px;
           border: 1px black solid; text-align: center;" />

    <input type="text" name="waktu_menit_4" placeholder="mm:ss" data-layer="Rectangle 43" class="Rectangle43" style="width: 100px; height: 34px; left: 963px; top: 637px; position: absolute;
    background: rgba(217, 217, 217, 0); border-radius: 10px;
    border: 1px black solid; text-align: center;" />

    <button type="submit" style="
        width: 145px; height: 52px;
        position: absolute; 
        left: 1231px; top: 1028px;
        background: #795757;
        border-radius: 23px;
        border: none;
        cursor: pointer;
        color: #FFF3F3;
        font-size: 16px;
        font-family: Roboto;
        font-weight: 400;
        letter-spacing: 0.40px;
        display: flex;
        align-items: center;
        justify-content: center;
    ">
        Add to Video
    </button>
</div>