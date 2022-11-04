<?php
//********************kay�t personel guncelle***********************************
if (isset($_POST['kayit_personel_guncelle'])) {
        //if (yetkikontrol()!="yetkili") {
        //  header("location:../index.php");
        //  exit;
        //}
        $kayitguncelle=$db->prepare("UPDATE Personel SET ad=:g_ad, tur=:g_gtur, email=:g_email, sehir=:g_sehir WHERE id=:g_id");

        $guncelle=$kayitguncelle->execute(array(   // KAYIT D�ZELME YAPTI�IM FORMDAK� POST METODU �LE GELEN DE���KENLERDEK�  B�LG�LER BELLEOE AKTARILIR
          'g_id' => $_POST['g_id'],
          'g_ad' => $_POST['g_ad'],
            'g_tur' =>$_POST['g_tur']),
            'g_sehir' => $_POST['g_sehir'])
         ));



        if ($guncelle) {   // E�ER KAYIT G�NCELLENM�� �SE index.php ye git

         header("location:../kayit_personel.php");

          exit;
        } else {   // e�er kay�t g�ncellemesi yap�lmam�� ise hatay� bana g�ster
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

$host="localhost"; //Host adınızı girin varsayılan olarak Localhosttur eğer bilginiz yoksa bu şekilde bırakın
$veritabani_ismi="deneme_db"; //Veritabanı İsminiz
$kullanici_adi="deneme_user"; //Veritabanı kullanıcı adınız
$sifre="DeNeMe$12345"; //Kullanıcı şifreniz şifre yoksa 123456789 yazan yeri silip boş bırakın

try {
	$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);
	//echo "veritabanı bağlantısı başarılı";
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
echo "Kay�t Listelendi";
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
// KAYIT G�R���
if (isset($_POST['kayit_gir'])) { // kayit_gir SUBMIT ile gelen de�i�ken isim

          $ogrenciekle=$db->prepare("INSERT INTO ogrenci_kayit SET baslik=:g_baslik, adsoy=:g_adsoy, email=:g_email, telefon=:g_telefon, ders_turu=:g_ders_turu, ulasma_turu=:g_ulastirma_turu, saat=:g_saat");
            // prepare komutu ile �NSERT KOMUTUNU ��LER

            // form �zerinden de�i�kenler bellek �zerindeki de�i�kenlere aktar�l�yor.
          $ogrekleme=$ogrenciekle->execute(array(
            'g_baslik' => guvenlik($_POST['g_baslik']),
            'g_adsoy' => guvenlik($_POST['g_adsoy']),
            'g_mail' => guvenlik($_POST['g_mail']),
            'g_telefon' => guvenlik($_POST['g_telefon']),
            'g_ders_turu' => guvenlik($_POST['g_ders_turu']),
            'g_ulastirma_turu' => guvenlik($_POST['ulastirma_turu']),
            'g_saat' => guvenlik($_POST['g_saat'])

          ));
          
          if ($ogrekleme) {    // e�er kay�t yap�lm�� ise index.php ye git

          header("location:../index.php?durum=ok");
          //y�nlendirme komutu..

          exit;
        } else { // e�er kay�t yap�lmam�� ise hatalar� bana g�ster
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

        $guncelle=$kayitguncelle->execute(array(   // KAYIT D�ZELME YAPTI�IM FORMDAK� POST METODU �LE GELEN DE���KENLERDEK�  B�LG�LER BELLEOE AKTARILIR
          'g_id' => guvenlik($_POST['g_id']),
          'g_baslik' => guvenlik($_POST['g_baslik']),
            'g_adsoy' => guvenlik($_POST['g_adsoy']),
            'g_mail' => guvenlik($_POST['g_mail']),
            'g_telefon' => guvenlik($_POST['g_telefon']),
            'g_ders_turu' => guvenlik($_POST['g_ders_turu']),
            'g_ulastirma_turu' => guvenlik($_POST['ulastirma_turu']),
            'g_saat' => guvenlik($_POST['g_saat'])
         ));



        if ($guncelle) {   // E�ER KAYIT G�NCELLENM�� �SE index.php ye git

         header("location:../index.php?durum=ok");

          exit;
        } else {   // e�er kay�t g�ncellemesi yap�lmam�� ise hatay� bana g�ster
          echo "\nPDOStatement::errorInfo():\n";
          $arr = $guncelle->errorInfo();
          print_r($arr);
          exit;
        }
        exit;
      }
      //******************************
/*Oturum Açma İşlemi Giriş*/
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
		$_SESSION['kul_mail']=sifreleme($kul_mail); //Session güvenliği için sessionumuzu üç aşamalı oalrak şifreliyoruz
		$_SESSION['kul_id']=$kullanicicek['kul_id'];

		$ipkaydet=$db->prepare("UPDATE kullanicilar SET
			ip_adresi=:ip_adresi,
			session_mail=:session_mail WHERE
			kul_mail=:kul_mail
			");

		$kaydet=$ipkaydet->execute(array(
			'ip_adresi' => $_SERVER['REMOTE_ADDR'], //Güvenlik için işlemine karşı kullanıcının ip adresini veritabanına kayıt ediyoruz
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
