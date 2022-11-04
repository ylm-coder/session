<?php
include "baglan.php";

if (isset($_POST['kayit_personel_ara'])) {
    $sor=$db->prepare("SELECT * FROM Personel where ad=:g_ad");
	$sor->execute(array(
		'g_ad' => $_POST['g_ad']
	));
	$kayitcek=$sor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:kayit_personel_ara.php");
}
// not
/*
not:
kayitcek=$kayitsor->fetch(PDO::FETCH_ASSOC);
Bu fonksiyon a�a��daki gibi matris �eklinde belle�e aktar�r..

$kayitcek[baslik][1]
$kayitcek[adsoy][1]
...
$kayitcek[baslik][2]
$kayitcek[adsoy][2]
,
,
,
,
where email=:g_email
select komutu ile aranan email adresinden yanl�zca biri ile e�le�ir.
 $kayitcek[baslik][20]
$kayitcek[adsoy][20]

*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PERSONEL KAYIT DUZELTME FORMU</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

               
               
    <div class="main">

        <div class="container">
            <form method="POST" action="islem.php" class="appointment-form" id="appointment-form">
                <h2>Personel formu</h2>
                <div class="form-group-1">
                    <input type="text" name="g_ad" id="g_ad" value="<?php echo $kayitcek['ad']; ?>" placeholder="ad gir" required />
                    <input type="text" name="g_tur" id="g_tur" value="<?php echo $kayitcek['tur']; ?>" placeholder="tur gir" required />
                    <input type="email" name="g_email" id="g_email" value="<?php echo $kayitcek['email']; ?>" placeholder="Email" required />
                    <input type="text" name="g_sehir" id="g_sehir" value="<?php echo $kayitcek['sehir']; ?>" placeholder="sehir gir" required />

                </div>

                <div class="form-check">
                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                    <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree to the  <a href="#" class="term-service">Terms and Conditions</a></label>
                </div>
                <div class="form-submit">
                    <input type="hidden" name="g_id" id="g_id" value="<?php echo $kayitcek['id']; ?>" />

                    <input type="submit" name="kayit_personel_guncelle" id="submit" class="submit" value="KAYIT PERSONEL DUZELT" />
                </div>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
