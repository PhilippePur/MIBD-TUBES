<?php
require_once 'testsql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE Videos SET title = ?, description = ? WHERE id = ?";
    $params = array($title, $description, $id);

    $stmt = sqlsrv_query($conn, $sql, params: $params);

    if ($stmt === false) {
        echo "<script>alert('Gagal mengupdate data'); window.location.href='editContent.php?id=$id';</script>";
    } else {
        echo "<script>alert('Konten berhasil diperbarui'); window.location.href='uploadList.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Konten</title>
</head>

<body>
    <div data-layer="Edit dan Delete Konten" class="EditDanDeleteKonten"
        style="width: 1512px; height: 1009px; position: relative; background: white; overflow: hidden">
        <div data-layer="Rectangle 8" class="Rectangle8"
            style="width: 1512px; height: 904px; left: 0px; top: 105px; position: absolute; background: #D9D9D9"></div>
        <div data-layer="Rectangle 9" class="Rectangle9"
            style="width: 537px; height: 77px; left: 198px; top: 160px; position: absolute; opacity: 0.36; background: #472323; border-radius: 26px">
        </div>
        <a href="homepage.php" data-layer="Youtube-Logo" class="YoutubeLogo"
            style="width: 204px; height: 45px; left: 23px; top: 33px; position: absolute; overflow: hidden">
            <div data-svg-wrapper data-layer="Vector" class="Vector" style="left: 0px; top: 0px; position: absolute">
                <svg width="65" height="45" viewBox="0 0 65 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M63.4048 7.02729C62.6586 4.25977 60.4674 2.0849 57.6794 1.34407C52.6313 4.02331e-07 32.3793 0 32.3793 0C32.3793 0 12.1276 4.02331e-07 7.07932 1.34407C4.29132 2.0849 2.10035 4.25977 1.35403 7.02729C4.05312e-07 12.0384 0 22.5 0 22.5C0 22.5 4.05312e-07 32.9616 1.35403 37.9728C2.10035 40.7403 4.29132 42.9151 7.07932 43.6558C12.1276 45 32.3793 45 32.3793 45C32.3793 45 52.6313 45 57.6794 43.6558C60.4674 42.9151 62.6586 40.7403 63.4048 37.9728C64.7589 32.9616 64.7589 22.5 64.7589 22.5C64.7589 22.5 64.7535 12.0384 63.4048 7.02729Z"
                        fill="#FF0000" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 25.90px; top: 12.86px; position: absolute">
                <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.897461 20.1422L17.7216 10.5009L0.897461 0.859497V20.1422Z" fill="white" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 71.16px; top: 3.19px; position: absolute">
                <svg width="22" height="39" viewBox="0 0 22 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.43237 26.2581L0.161133 0.191528H6.50485L9.05304 12.0077C9.70335 14.9181 10.1778 17.3999 10.4869 19.453H10.6735C10.8868 17.982 11.3666 15.5161 12.1076 12.0501L14.7462 0.191528H21.0899L13.728 26.2581V38.7622H7.42716V26.2581H7.43237Z"
                        fill="black" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 90.45px; top: 13.03px; position: absolute">
                <svg width="19" height="30" viewBox="0 0 19 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M3.99796 27.9358C2.71866 27.0786 1.807 25.745 1.26323 23.9353C0.724896 22.1257 0.453125 19.7233 0.453125 16.7176V12.6271C0.453125 9.59495 0.762296 7.15561 1.38064 5.31941C1.99899 3.48323 2.96391 2.13915 4.27518 1.29778C5.58667 0.456418 7.30843 0.0330811 9.44091 0.0330811C11.5412 0.0330811 13.2203 0.461706 14.489 1.31896C15.7524 2.17618 16.68 3.52027 17.2663 5.34058C17.8527 7.16619 18.146 9.59495 18.146 12.6271V16.7176C18.146 19.7233 17.8582 22.1362 17.2879 23.9565C16.7174 25.7821 15.7898 27.1157 14.5103 27.957C13.231 28.7985 11.4931 29.2217 9.30219 29.2217C7.04187 29.2269 5.2775 28.7931 3.99796 27.9358ZM11.1733 23.5227C11.5251 22.602 11.7064 21.1044 11.7064 19.0195V10.2407C11.7064 8.21923 11.5306 6.73756 11.1733 5.80624C10.8161 4.86964 10.1925 4.40398 9.29675 4.40398C8.43338 4.40398 7.82025 4.86964 7.46846 5.80624C7.11123 6.74287 6.93533 8.21923 6.93533 10.2407V19.0195C6.93533 21.1044 7.1058 22.6071 7.44716 23.5227C7.78829 24.4434 8.40119 24.9037 9.29675 24.9037C10.1925 24.9037 10.8161 24.4434 11.1733 23.5227Z"
                        fill="black" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 111.46px; top: 13.58px; position: absolute">
                <svg width="18" height="30" viewBox="0 0 18 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.7817 28.7676H12.7815L12.227 25.3175H12.0886C10.729 27.921 8.69263 29.2226 5.97399 29.2226C4.0922 29.2226 2.70092 28.6088 1.80536 27.3866C0.909801 26.1588 0.461914 24.2433 0.461914 21.6399V0.584389H6.85369V21.2693C6.85369 22.5288 6.99218 23.423 7.26939 23.9576C7.54661 24.492 8.01037 24.7617 8.66067 24.7617C9.2151 24.7617 9.74822 24.5925 10.26 24.2539C10.7718 23.9151 11.1449 23.4864 11.3954 22.968V0.579102H17.7817V28.7676Z"
                        fill="black" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 127.20px; top: 3.20px; position: absolute">
                <svg width="20" height="39" viewBox="0 0 20 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.1446 5.29706H12.8009V38.7665H6.54782V5.29706H0.204102V0.195923H19.1446V5.29706Z"
                        fill="black" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 144.24px; top: 13.58px; position: absolute">
                <svg width="18" height="30" viewBox="0 0 18 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.561 28.7676H12.5608L12.0063 25.3175H11.8678C10.5085 27.921 8.47215 29.2226 5.75328 29.2226C3.8715 29.2226 2.48023 28.6088 1.58467 27.3866C0.689106 26.1588 0.241211 24.2433 0.241211 21.6399V0.584389H6.63297V21.2693C6.63297 22.5288 6.77147 23.423 7.04869 23.9576C7.3259 24.492 7.78966 24.7617 8.44019 24.7617C8.99439 24.7617 9.52751 24.5925 10.0393 24.2539C10.5511 23.9151 10.9242 23.4864 11.1747 22.968V0.579102H17.561V28.7676Z"
                        fill="black" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 165.42px; top: 1.77px; position: absolute">
                <svg width="19" height="42" viewBox="0 0 19 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.7136 17.0871C17.3244 15.3091 16.7006 14.0232 15.8372 13.2242C14.9736 12.4252 13.7847 12.0283 12.2708 12.0283C11.0981 12.0283 9.99986 12.3564 8.98167 13.0178C7.96348 13.6793 7.17446 14.5418 6.62003 15.616H6.57221V0.7677H0.415039V40.7618H5.69252L6.34282 38.0949H6.48155C6.97727 39.0473 7.71823 39.7934 8.70446 40.3491C9.69069 40.8995 10.7889 41.1747 11.9936 41.1747C14.1526 41.1747 15.7465 40.1851 16.7647 38.2112C17.7829 36.2321 18.2945 33.1471 18.2945 28.9457V24.4848C18.2945 21.3362 18.0973 18.8651 17.7136 17.0871ZM11.8549 28.5857C11.8549 30.6388 11.7697 32.2476 11.599 33.4117C11.4285 34.5759 11.1459 35.4068 10.7408 35.8935C10.341 36.3856 9.79723 36.629 9.12017 36.629C8.59249 36.629 8.10742 36.5073 7.65953 36.2587C7.21186 36.0152 6.84943 35.6449 6.57221 35.158V19.1614C6.78528 18.3941 7.1586 17.7697 7.68628 17.2776C8.20875 16.7855 8.78448 16.542 9.39739 16.542C10.0479 16.542 10.5489 16.796 10.9009 17.2988C11.2579 17.8067 11.5031 18.6534 11.6418 19.8493C11.7803 21.0452 11.8497 22.7438 11.8497 24.9504V28.5857H11.8549Z"
                        fill="black" />
                </svg>
            </div>
            <div data-svg-wrapper data-layer="Vector" class="Vector"
                style="left: 186.12px; top: 13.04px; position: absolute">
                <svg width="18" height="30" viewBox="0 0 18 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.36285 18.2102C6.36285 20.0199 6.41612 21.3746 6.52288 22.2796C6.62941 23.1843 6.85335 23.8406 7.19448 24.2587C7.53562 24.6713 8.05809 24.8776 8.7671 24.8776C9.72137 24.8776 10.3823 24.5073 10.7341 23.7718C11.0913 23.0362 11.2833 21.8086 11.3153 20.0941L16.8274 20.4168C16.8593 20.6602 16.8752 20.9989 16.8752 21.4275C16.8752 24.031 16.1555 25.9783 14.7216 27.2642C13.2877 28.5501 11.2566 29.1956 8.63382 29.1956C5.48338 29.1956 3.27634 28.2166 2.0129 26.2535C0.744243 24.2904 0.115234 21.2583 0.115234 17.1518V12.2306C0.115234 8.00268 0.770993 4.91237 2.08226 2.96506C3.39375 1.01773 5.63796 0.0440674 8.82036 0.0440674C11.0113 0.0440674 12.6959 0.440945 13.8687 1.23999C15.0415 2.03901 15.8677 3.27725 16.3475 4.96529C16.8274 6.65331 17.0672 8.98163 17.0672 11.9554V16.7815H6.36285V18.2102ZM7.17318 4.92826C6.84791 5.32511 6.63485 5.97599 6.52288 6.88085C6.41612 7.78573 6.36285 9.15625 6.36285 10.9978V13.0192H11.0381V10.9978C11.0381 9.188 10.9742 7.81748 10.8515 6.88085C10.7289 5.94424 10.505 5.28807 10.1797 4.90179C9.85464 4.5208 9.35348 4.32501 8.67643 4.32501C7.99416 4.33029 7.493 4.53138 7.17318 4.92826Z"
                        fill="black" />
                </svg>
            </div>
        </a>
        <img data-layer="MainProfile" class="Mainprofile"
            style="width: 140px; height: 140px; left: 23px; top: 128px; position: absolute; border-radius: 200px"
            src="Assets/MainProfile.jpg">
        <div data-layer="Judul Konten" class="JudulKonten"
            style="width: 490px; height: 39px; left: 227px; top: 179px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 64px; font-family: Roboto; font-weight: 400; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            Judul Konten</div>
        <div data-layer="Rectangle 10" class="Rectangle10"
            style="width: 1172px; height: 322px; left: 199px; top: 260px; position: absolute; opacity: 0.36; background: #472323; border-radius: 26px">
        </div>
        <div data-layer="Rectangle 11" class="Rectangle11"
            style="width: 1172px; height: 282px; left: 199px; top: 600px; position: absolute; opacity: 0.36; background: #472323; border-radius: 26px">
        </div>
        <div data-layer="Rectangle 5" class="Rectangle5"
            style="width: 166.18px; height: 68px; left: 1205px; top: 900px; position: absolute; background: #795757; border-radius: 23px">
        </div>
        <div data-layer="Update" class="Update"
            style="width: 136.50px; height: 24.62px; left: 1220.43px; top: 922.28px; position: absolute; text-align: center; justify-content: center; display: flex; flex-direction: column; color: #FFF3F3; font-size: 32px; font-family: Roboto; font-weight: 700; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            Update</div>
        <div data-svg-wrapper data-layer="Vector 2" class="Vector2"
            style="left: 1259.83px; top: 935.17px; position: absolute">
            <svg width="4" height="3" viewBox="0 0 4 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.83203 1.17236H3.0003" stroke="white" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="Vector 3" class="Vector3"
            style="left: 1076.41px; top: 935.17px; position: absolute">
            <svg width="4" height="3" viewBox="0 0 4 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.41309 1.17236H2.58136" stroke="white" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>
        <div data-layer="Rectangle 17" class="Rectangle17"
            style="width: 163.56px; height: 68px; left: 1018px; top: 900px; position: absolute; background: #FF3636; border-radius: 23px">
        </div>
        <div data-layer="Arsipkan" class="Arsipkan"
            style="width: 134.35px; height: 24.62px; left: 1032.02px; top: 922.28px; position: absolute; text-align: center; justify-content: center; display: flex; flex-direction: column; color: #FFF3F3; font-size: 32px; font-family: Roboto; font-weight: 700; line-height: 20px; letter-spacing: 0.70px; word-wrap: break-word">
            Arsipkan</div>
        <div data-layer="Deskripsi" class="Deskripsi"
            style="width: 165px; height: 28px; left: 237px; top: 283.63px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 32px; font-family: Roboto; font-weight: 700; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            Deskripsi</div>
        <div data-layer="Thumbnail" class="Thumbnail"
            style="width: 165px; height: 28px; left: 913px; top: 622px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 32px; font-family: Roboto; font-weight: 700; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            Thumbnail</div>
        <div data-layer="Video" class="Video"
            style="width: 165px; height: 28px; left: 223px; top: 622px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 32px; font-family: Roboto; font-weight: 700; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            Video</div>
        <div data-svg-wrapper data-layer="edit-03" class="Edit03" style="left: 677px; top: 175px; position: absolute">
            <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M24.866 6.64193C26.965 4.54286 30.3683 4.54286 32.4674 6.64193L36.3581 10.5327C38.4572 12.6317 38.4572 16.035 36.3581 18.1341L17.3919 37.1003C17.0559 37.4363 16.6002 37.625 16.125 37.625H7.16667C6.17716 37.625 5.375 36.8229 5.375 35.8334V26.875C5.375 26.3998 5.56376 25.9441 5.89977 25.6081L24.866 6.64193ZM29.9336 9.17573C29.2339 8.47604 28.0995 8.47604 27.3998 9.17573L25.8255 10.75L32.25 17.1746L33.8243 15.6003C34.524 14.9006 34.524 13.7662 33.8243 13.0665L29.9336 9.17573ZM29.7162 19.7084L23.2917 13.2838L8.95833 27.6172V34.0417H15.3829L29.7162 19.7084Z"
                    fill="white" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="edit-03" class="Edit03"
            style="left: 388px; top: 283.63px; position: absolute">
            <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M16.7701 5.11228C18.1857 3.69663 20.4809 3.69662 21.8966 5.11228L24.5206 7.73626C25.9362 9.15191 25.9362 11.4471 24.5206 12.8628L11.7294 25.6539C11.5028 25.8805 11.1955 26.0079 10.875 26.0079H4.83333C4.16599 26.0079 3.625 25.4669 3.625 24.7995V18.7579C3.625 18.4374 3.75231 18.13 3.97891 17.9034L16.7701 5.11228ZM20.1878 6.82112C19.7159 6.34923 18.9508 6.34923 18.4789 6.82112L17.4172 7.88285L21.75 12.2157L22.8117 11.1539C23.2836 10.6821 23.2836 9.91698 22.8117 9.4451L20.1878 6.82112ZM20.0412 13.9245L15.7083 9.5917L6.04167 19.2584V23.5912H10.3745L20.0412 13.9245Z"
                    fill="white" />
            </svg>
        </div>
        <div data-svg-wrapper data-layer="edit-03" class="Edit03" style="left: 1306px; top: 820px; position: absolute">
            <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M16.7701 4.47946C18.1857 3.06381 20.4809 3.06381 21.8966 4.47946L24.5206 7.10345C25.9362 8.5191 25.9362 10.8143 24.5206 12.23L11.7294 25.0211C11.5028 25.2477 11.1955 25.375 10.875 25.375H4.83333C4.16599 25.375 3.625 24.8341 3.625 24.1667V18.125C3.625 17.8046 3.75231 17.4972 3.97891 17.2706L16.7701 4.47946ZM20.1878 6.1883C19.7159 5.71642 18.9508 5.71642 18.4789 6.1883L17.4172 7.25004L21.75 11.5829L22.8117 10.5211C23.2836 10.0492 23.2836 9.28417 22.8117 8.81229L20.1878 6.1883ZM20.0412 13.2917L15.7083 8.95888L6.04167 18.6255V22.9584H10.3745L20.0412 13.2917Z"
                    fill="white" />
            </svg>
        </div>
        <div data-layer="Lorem ipsum dolor sit amet, consectetur adipiscing elit. In commodo massa sed tempus porta. Aenean quis nibh sem. Phasellus sodales odio vitae felis finibus porta. Mauris vel ante vitae dolor dapibus varius. Ut imperdiet egestas molestie. Duis ullamcorper faucibus lacus, elementum placerat massa lacinia in. Praesent sed placerat diam. Etiam aliquet nibh id posuere imperdiet. Donec vel imperdiet orci. Etiam sit amet tellus placerat, lobortis nunc quis, pulvinar metus. Proin imperdiet eros ut lacus tempor vehicula. Morbi sagittis convallis quam vel aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et aliquam diam. Duis faucibus neque a magna ullamcorper, id faucibus nulla commodo. Proin posuere ante neque, aliquet fringilla quam fermentum at. In dictum, tellus dapibus viverra cursus, odio massa tincidunt lorem, a ultricies ligula tellus eget urna. Cras molestie fringilla libero, id volutpat metus convallis vel. Proin id risus arcu. Phasellus pharetra eu quam quis facilisis. Proin dignissim non diam vel vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin eget ultrices ipsum, non molestie enim. Nulla feugiat enim eu mattis rutrum. Sed aliquam odio et nibh auctor, a vehicula mauris cursus. Aliquam id magna commodo, condimentum elit mollis, vulputate neque."
            class="LoremIpsumDolorSitAmetConsecteturAdipiscingElitInCommodoMassaSedTempusPortaAeneanQuisNibhSemPhasellusSodalesOdioVitaeFelisFinibusPortaMaurisVelAnteVitaeDolorDapibusVariusUtImperdietEgestasMolestieDuisUllamcorperFaucibusLacusElementumPlaceratMassaLaciniaInPraesentSedPlaceratDiamEtiamAliquetNibhIdPosuereImperdietDonecVelImperdietOrciEtiamSitAmetTellusPlaceratLobortisNuncQuisPulvinarMetusProinImperdietErosUtLacusTemporVehiculaMorbiSagittisConvallisQuamVelAliquamLoremIpsumDolorSitAmetConsecteturAdipiscingElitInEtAliquamDiamDuisFaucibusNequeAMagnaUllamcorperIdFaucibusNullaCommodoProinPosuereAnteNequeAliquetFringillaQuamFermentumAtInDictumTellusDapibusViverraCursusOdioMassaTinciduntLoremAUltriciesLigulaTellusEgetUrnaCrasMolestieFringillaLiberoIdVolutpatMetusConvallisVelProinIdRisusArcuPhasellusPharetraEuQuamQuisFacilisisProinDignissimNonDiamVelVestibulumPellentesqueHabitantMorbiTristiqueSenectusEtNetusEtMalesuadaFamesAcTurpisEgestasProinEgetUltricesIpsumNonMolestieEnimNullaFeugiatEnimEuMattisRutrumSedAliquamOdioEtNibhAuctorAVehiculaMaurisCursusAliquamIdMagnaCommodoCondimentumElitMollisVulputateNeque"
            style="width: 1097px; height: 195px; left: 237px; top: 346.63px; position: absolute; color: black; font-size: 16px; font-family: Roboto; font-weight: 300; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In commodo massa sed tempus porta. Aenean quis nibh
            sem. Phasellus sodales odio vitae felis finibus porta. Mauris vel ante vitae dolor dapibus varius. Ut
            imperdiet egestas molestie. Duis ullamcorper faucibus lacus, elementum placerat massa lacinia in. Praesent
            sed placerat diam. Etiam aliquet nibh id posuere imperdiet. Donec vel imperdiet orci. Etiam sit amet tellus
            placerat, lobortis nunc quis, pulvinar metus.<br /><br /><br />Proin imperdiet eros ut lacus tempor
            vehicula. Morbi sagittis convallis quam vel aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing
            elit. In et aliquam diam. Duis faucibus neque a magna ullamcorper, id faucibus nulla commodo. Proin posuere
            ante neque, aliquet fringilla quam fermentum at. In dictum, tellus dapibus viverra cursus, odio massa
            tincidunt lorem, a ultricies ligula tellus eget urna. Cras molestie fringilla libero, id volutpat metus
            convallis vel. Proin id risus arcu. Phasellus pharetra eu quam quis facilisis. Proin dignissim non diam vel
            vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            Proin eget ultrices ipsum, non molestie enim. Nulla feugiat enim eu mattis rutrum. Sed aliquam odio et nibh
            auctor, a vehicula mauris cursus. Aliquam id magna commodo, condimentum elit mollis, vulputate neque.</div>
        <div data-layer="Line 3" class="Line3"
            style="width: 1173px; height: 0px; left: 198px; top: 323.63px; position: absolute; outline: 1px white solid; outline-offset: -0.50px">
        </div>
        <div data-layer="Line 4" class="Line4"
            style="width: 279px; height: 0px; left: 896px; top: 608px; position: absolute; transform: rotate(90deg); transform-origin: top left; outline: 1px white solid; outline-offset: -0.50px">
        </div>
        <div data-layer="Rectangle 15" class="Rectangle15"
            style="width: 330px; height: 176px; left: 969px; top: 673px; position: absolute; background: #D9D9D9"></div>
        <div data-layer="Rectangle 16" class="Rectangle16"
            style="width: 330px; height: 176px; left: 227px; top: 673px; position: absolute; background: #F44F4F"></div>
        <div data-layer="NamaFile" class="Namafile"
            style="left: 574px; top: 679px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: white; font-size: 32px; font-family: Roboto; font-weight: 700; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            NamaFile</div>
        <div data-layer="Size" class="Size"
            style="left: 574px; top: 708px; position: absolute; opacity: 0.28; justify-content: center; display: flex; flex-direction: column; color: white; font-size: 14px; font-family: Roboto; font-weight: 700; line-height: 16px; letter-spacing: 0.40px; word-wrap: break-word">
            Size</div>
        <img data-layer="MainProfile" class="Mainprofile"
            style="width: 330px; height: 176px; left: 969px; top: 673px; position: absolute" src="Assets/Move.png">
    </div>

</body>

</html>