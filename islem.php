<?php
//********************kayýt personel guncelle***********************************
if (isset($_POST['kayit_personel_guncelle'])) {
        //if (yetkikontrol()!="yetkili") {
        //  header("location:../index.php");
        //  exit;
        //}
        $kayitguncelle=$db->prepare("UPDATE Personel SET ad=:g_ad, tur=:g_gtur, email=:g_email, sehir=:g_sehir WHERE id=:g_id");

        $guncelle=$kayitguncelle->execute(array(   // KAYIT DÜZELME YAPTIÐIM FORMDAKÝ POST METODU ÝLE GELEN DEÐÝÞKENLERDEKÝ  BÝLGÝLER BELLEOE AKTARILIR
          'g_id' => $_POST['g_id'],
          'g_ad' => $_POST['g_ad'],
            'g_tur' =>$_POST['g_tur']),
            'g_sehir' => $_POST['g_sehir'])
         ));



        if ($guncelle) {   // EÐER KAYIT GÜNCELLENMÝÞ ÝSE index.php ye git

         header("location:../kayit_personel.php");

          exit;
        } else {   // eðer kayýt güncellemesi yapýlmamýþ ise hatayý bana göster
          echo "\nPDOStatement::errorInfo():\n";
          $arr = $guncelle->errorInfo();
          print_r($arr);
          exit;
        }
        exit;
      }
      //******************************
               
if (isset($_POST['kayit_listele'])) {

if (isset($_POST['musteri_no'])) {
$musteri_no=$_POST['musteri_no'];
//echo "musteri no". $musteri_no;
}

$host="localhost"; //Host adÄ±nÄ±zÄ± girin varsayÄ±lan olarak Localhosttur eÄŸer bilginiz yoksa bu ÅŸekilde bÄ±rakÄ±n
$veritabani_ismi="deneme_db"; //VeritabanÄ± Ä°sminiz
$kullanici_adi="deneme_user"; //VeritabanÄ± kullanÄ±cÄ± adÄ±nÄ±z
$sifre="DeNeMe$12345"; //KullanÄ±cÄ± ÅŸifreniz ÅŸifre yoksa 123456789 yazan yeri silip boÅŸ bÄ±rakÄ±n

try {
	$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);
	//echo "veritabanÄ± baÄŸlantÄ±sÄ± baÅŸarÄ±lÄ±";
}

catch (PDOExpception $e) {
	echo $e->getMessage();
}



//$baglanti = new PDO($baglanti_cumlesi, null, null, $ayarlar);
  $sorgu_sql= "SELECT mus_id, mus_ad,ili FROM Musteri WHERE mus_id=".$musteri_no;
$sorgu = $db->query($sorgu_sql);

$cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

echo "Musteri Id: " .
    $cikti["mus_id"] .
    "<br /> Musteri ADI: " .
    $cikti["mus_ad"] .
    "<br /> ili : ".
    $cikti["ili"] .
    "<br /> ";
echo "Kayýt Listelendi";
}

/*
                baslik
               adsoy
               email
               telefon
               ders_turu
               ulasma_turu
               saat
               submit-> kayit_gir
               */
               
//   "INSERT INTO ogrenci_kayit SET baslik=:g_baslik, adsoy=:g_adsoy, email=:g_email, telefon=:g_telefon, ders_turu=:g_ders_turu, ulasma_turu=:g_ulastirma_turu, saat=:g_saat";
 //****************************************************
// KAYIT GÝRÝÞÝ
if (isset($_POST['kayit_gir'])) { // kayit_gir SUBMIT ile gelen deðiþken isim

          $ogrenciekle=$db->prepare("INSERT INTO ogrenci_kayit SET baslik=:g_baslik, adsoy=:g_adsoy, email=:g_email, telefon=:g_telefon, ders_turu=:g_ders_turu, ulasma_turu=:g_ulastirma_turu, saat=:g_saat");
            // prepare komutu ile ÝNSERT KOMUTUNU ÝÞLER

            // form üzerinden deðiþkenler bellek üzerindeki deðiþkenlere aktarýlýyor.
          $ogrekleme=$ogrenciekle->execute(array(
            'g_baslik' => guvenlik($_POST['g_baslik']),
            'g_adsoy' => guvenlik($_POST['g_adsoy']),
            'g_mail' => guvenlik($_POST['g_mail']),
            'g_telefon' => guvenlik($_POST['g_telefon']),
            'g_ders_turu' => guvenlik($_POST['g_ders_turu']),
            'g_ulastirma_turu' => guvenlik($_POST['ulastirma_turu']),
            'g_saat' => guvenlik($_POST['g_saat'])

          ));
          
          if ($ogrekleme) {    // eðer kayýt yapýlmýþ ise index.php ye git

          header("location:../index.php?durum=ok");
          //yönlendirme komutu..

          exit;
        } else { // eðer kayýt yapýlmamýþ ise hatalarý bana göster
          echo "\nPDOStatement::errorInfo():\n";
          $problem_goster = $ogrekleme->errorInfo();
          print_r($problem_goster);
          header("location:../index.php?durum=no");
          exit;
        }
}
//*******************************************************
if (isset($_POST['kayit_guncelle'])) {
        //if (yetkikontrol()!="yetkili") {
        //  header("location:../index.php");
        //  exit;
        //}
        $kayitguncelle=$db->prepare("UPDATE ogrenci_kayit SET baslik=:g_baslik, adsoy=:g_adsoy, email=:g_email, telefon=:g_telefon, ders_turu=:g_ders_turu, ulasma_turu=:g_ulastirma_turu, saat=:g_saat WHERE ogr_id=:g_id");

        $guncelle=$kayitguncelle->execute(array(   // KAYIT DÜZELME YAPTIÐIM FORMDAKÝ POST METODU ÝLE GELEN DEÐÝÞKENLERDEKÝ  BÝLGÝLER BELLEOE AKTARILIR
          'g_id' => guvenlik($_POST['g_id']),
          'g_baslik' => guvenlik($_POST['g_baslik']),
            'g_adsoy' => guvenlik($_POST['g_adsoy']),
            'g_mail' => guvenlik($_POST['g_mail']),
            'g_telefon' => guvenlik($_POST['g_telefon']),
            'g_ders_turu' => guvenlik($_POST['g_ders_turu']),
            'g_ulastirma_turu' => guvenlik($_POST['ulastirma_turu']),
            'g_saat' => guvenlik($_POST['g_saat'])
         ));



        if ($guncelle) {   // EÐER KAYIT GÜNCELLENMÝÞ ÝSE index.php ye git

         header("location:../index.php?durum=ok");

          exit;
        } else {   // eðer kayýt güncellemesi yapýlmamýþ ise hatayý bana göster
          echo "\nPDOStatement::errorInfo():\n";
          $arr = $guncelle->errorInfo();
          print_r($arr);
          exit;
        }
        exit;
      }
      //******************************
/*Oturum AÃ§ma Ä°ÅŸlemi GiriÅŸ*/
if (isset($_POST['oturumac'])) {
$sayi1=$_POST['sayi1'];
$sayi2=$_POST['sayi2'];
$tsonuc=$_POST['sonuc'];
$toplam=$sayi1+$sayi2;
if ($toplam!=$tsonuc) {
header("location:../login.php?durum=hata&sayi1=$sayi1&sayi2=$sayi2");
}
    $mailonay=1;
	$gir_id=guvenlik($_POST['giris_durum']);
	$kul_mail=guvenlik($_POST['kul_mail']);
	$kul_sifre=md5($_POST['kul_sifre']);
	//$kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE gir_id=:gir_id and kul_mail=:mail and kul_sifre=:sifre and mail_onay=:mail_onay");
	$kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:mail and kul_sifre=:sifre and mail_onay=:mail_onay");
     //'gir_id'=> $gir_id,
    $kullanicisor->execute(array(

		'mail'=> $kul_mail,
		'mail_onay'=> $mailonay,
		'sifre'=> $kul_sifre
	));
	$sonuc=$kullanicisor->rowCount();
	//$_SERVER['REMOTE_ADDR']
	if ($sonuc>0) {
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$_SESSION['kul_mail']=sifreleme($kul_mail); //Session gÃ¼venliÄŸi iÃ§in sessionumuzu Ã¼Ã§ aÅŸamalÄ± oalrak ÅŸifreliyoruz
		$_SESSION['kul_id']=$kullanicicek['kul_id'];

		$ipkaydet=$db->prepare("UPDATE kullanicilar SET
			ip_adresi=:ip_adresi,
			session_mail=:session_mail WHERE
			kul_mail=:kul_mail
			");

		$kaydet=$ipkaydet->execute(array(
			'ip_adresi' => $_SERVER['REMOTE_ADDR'], //GÃ¼venlik iÃ§in iÅŸlemine karÅŸÄ± kullanÄ±cÄ±nÄ±n ip adresini veritabanÄ±na kayÄ±t ediyoruz
			'session_mail' => sifreleme($kul_mail),
			'kul_mail' => $kul_mail
		));
                  /*
                  $islemisim="Sing in";
                  $islemkod="singin";
                  $kulid=$kullanicicek['kul_id'];
                  $g_tarih=date("Y/m/d G.i:s");
                $isekle=$db->prepare("INSERT islemler_giris SET
                    kul_id=:kul_id,
                    islem_isim=:islem_isim,
                    islem_kod=:islem_kod,
            		islem_tarih=:islem_tarih,
            		ip_adresi=:ip_adresi
                ");

                $islemler=$isekle->execute(array(
                    'kul_id' => $kulid,
                    'islem_isim' => $islemisim,
                    'islem_kod' => $islemkod,
                    'islem_tarih' => $g_tarih,
                    'ip_adresi' => $_SERVER['REMOTE_ADDR']
                 ));
                  */
                 header("location:../index.php");
		         exit;
                 } else {
		         header("location:../login.php?durum=hata&hata=$sonuc");
		         exit;
           }


  header("location:../index.php");
	exit;
}

?>
