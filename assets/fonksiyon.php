<?php ob_start();
try {
    $baglanti = new PDO("mysql:host=localhost; dbname=otel_yonetim; charset=utf8", "root", "");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

class yonetim
{
    function sorgum($vt, $sorgu, $tercih = 0) //genel sorgum
    {
        $al = $vt->prepare($sorgu);
        $al->execute();

        if ($tercih == 1) :
            return $al->fetch();
        elseif ($tercih == 2) :
            return $al;
        endif;
    }

    function siteayar($baglanti) //site ayar
    {

        $sonuc = self::sorgum($baglanti, "select * from ayarlar", 1);

        if ($_POST) : //forma basıldıysa

            $title = htmlspecialchars($_POST["title"]); //güvenlik önlemi
            $metatitle = htmlspecialchars($_POST["metatitle"]);
            $metadesc = htmlspecialchars($_POST["metadesc"]);
            $metakey = htmlspecialchars($_POST["metakey"]);
            $metaaut = htmlspecialchars($_POST["metaaut"]);
            $metaown = htmlspecialchars($_POST["metaown"]);
            $metacopy = htmlspecialchars($_POST["metacopy"]);
            $logoyazisi = htmlspecialchars($_POST["logoyazi"]);
            $twit = htmlspecialchars($_POST["twit"]);
            $face = htmlspecialchars($_POST["face"]);
            $inst = htmlspecialchars($_POST["inst"]);
            $telno = htmlspecialchars($_POST["telno"]);
            $adres = htmlspecialchars($_POST["adres"]);
            $mailadres = htmlspecialchars($_POST["mailadres"]);
            $slogan = htmlspecialchars($_POST["slogan"]);
            $refsayfabas = htmlspecialchars($_POST["refsayfabas"]);
            $filosayfabas = htmlspecialchars($_POST["filosayfabas"]);
            $yorumsayfabas = htmlspecialchars($_POST["yorumsayfabas"]);
            $iletisimsayfabas = htmlspecialchars($_POST["iletisimsayfabas"]);

            //burada veritabanı işlemleri

            $guncelleme = $baglanti->prepare("update ayarlar set title = ?, metatitle = ?, metadesc = ?, metakey = ?, metaauthor = ?, 
            metaowner = ?, metacopy = ?, logoyazisi = ?, twit = ?, face = ?, ints = ?, telefonno = ?, adres = ?,
            mailadres = ?, slogan = ?, referansbaslik = ?, filobaslik = ?, yorumbaslik = ?, iletisimbaslik = ?");

            $guncelleme->bindParam(1, $title, PDO::PARAM_STR);
            $guncelleme->bindParam(2, $metatitle, PDO::PARAM_STR);
            $guncelleme->bindParam(3, $metadesc, PDO::PARAM_STR);
            $guncelleme->bindParam(4, $metakey, PDO::PARAM_STR);
            $guncelleme->bindParam(5, $metaaut, PDO::PARAM_STR);
            $guncelleme->bindParam(6, $metaown, PDO::PARAM_STR);
            $guncelleme->bindParam(7, $metacopy, PDO::PARAM_STR);
            $guncelleme->bindParam(8, $logoyazisi, PDO::PARAM_STR);
            $guncelleme->bindParam(9, $twit, PDO::PARAM_STR);
            $guncelleme->bindParam(10, $face, PDO::PARAM_STR);
            $guncelleme->bindParam(11, $inst, PDO::PARAM_STR);
            $guncelleme->bindParam(12, $telno, PDO::PARAM_STR);
            $guncelleme->bindParam(13, $adres, PDO::PARAM_STR);
            $guncelleme->bindParam(14, $mailadres, PDO::PARAM_STR);
            $guncelleme->bindParam(15, $slogan, PDO::PARAM_STR);
            $guncelleme->bindParam(16, $refsayfabas, PDO::PARAM_STR);
            $guncelleme->bindParam(17, $filosayfabas, PDO::PARAM_STR);
            $guncelleme->bindParam(18, $yorumsayfabas, PDO::PARAM_STR);
            $guncelleme->bindParam(19, $iletisimsayfabas, PDO::PARAM_STR);

            $guncelleme->execute();
            //Gelen verileri yeni değerleriyle set etmiş olacağız

            echo '<div class="alert alert-success mt-5" role="alert">

        <strong> Site Ayarları </strong> Başarıyla Güncellendi.
        
        </div>';

            header("refresh:2 , url=control.php"); //2 saniye sonra yönlendir

        //3 parametre alır. 1. soru işaretinin sırası,, 2.hangi değer,, 3.türü ne

        else :
?>
            <form action="control.php?sayfa=siteayar" method="post">
                <!--aynı sayfaya post edilsin -->

                <div class="row">
                    <div class="col-lg-7 mx-auto mt-2">
                        <h3 class="text-success">SİTE AYARLARI</h3>
                        <!-- ***************************************************-->
                    </div>
                    <div class="col-lg-7 mx-auto mt-2 border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont ">Title</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="title" class="form-control" value="<?php echo $sonuc["title"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Meta Title</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="metatitle" class="form-control" value="<?php echo $sonuc["metatitle"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->

                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Sayfa Açıklama</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="metadesc" class="form-control" value="<?php echo $sonuc["metadesc"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->

                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Anahtar Kelimeler</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="metakey" class="form-control" value="<?php echo $sonuc["metakey"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->

                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Yapımcı</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="metaaut" class="form-control" value="<?php echo $sonuc["metaauthor"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Firma</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="metaown" class="form-control" value="<?php echo $sonuc["metaowner"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont ">Copyright</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="metacopy" class="form-control" value="<?php echo $sonuc["metacopy"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Logo Yazısı</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="logoyazi" class="form-control" value="<?php echo $sonuc["logoyazisi"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Twitter</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="twit" class="form-control" value="<?php echo $sonuc["twit"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Facebook</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="face" class="form-control" value="<?php echo $sonuc["face"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> İnstagram</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="inst" class="form-control" value="<?php echo $sonuc["ints"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Telefon Numarası</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="telno" class="form-control" value="<?php echo $sonuc["telefonno"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Adres</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="adres" class="form-control" value="<?php echo $sonuc["adres"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Mail Adresi</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="mailadres" class="form-control" value="<?php echo $sonuc["mailadres"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Slogan</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="slogan" class="form-control" value="<?php echo $sonuc["slogan"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Referans Sayfa Başlık</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="refsayfabas" class="form-control" value="<?php echo $sonuc["referansbaslik"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Filo Sayfa Başlık</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="filosayfabas" class="form-control" value="<?php echo $sonuc["filobaslik"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> Yorum Sayfa Başlık</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="yorumsayfabas" class="form-control" value="<?php echo $sonuc["yorumbaslik"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- ***************************************************-->
                    <div class="col-lg-7 mx-auto border">
                        <div class="row">
                            <div class="col-lg-3 border-right pt-3 text-left">
                                <span id="siteayarfont "> İletişim Sayfa Başlık</span>
                            </div>
                            <div class="col-lg-9 p-1">
                                <input type="text" name="iletisimsayfabas" class="form-control" value="<?php echo $sonuc["iletisimbaslik"]; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***************************************************-->

                <div class="col-lg-7 mx-auto mt-2 border-bottom">
                    <input type="submit" name="buton" class="btn btn-rounded btn-info m-1" value="GÜNCELLE" />

                </div>

            </form>

        <?php
        endif;
    }

    function sifrele($veri)
    {

        return base64_encode(gzdeflate(gzcompress(serialize($veri))));

        //gzdeflate: ona verilmiş olan veriyi kendi algoritmasına göre yani deflate yöntemi ile sıkıştırarak şifreler.
        //gzcompress: farklı bir şekilde sıkıştırma ve şifreleme işlemi yapıyor
        //base64_encode(); 64 bitlik bir yöntem ile verilen verinin şifrelenmesini sağlar
        //base64_decode(); şifrelenmiş veriyi bununla çözeriz
    }

    function coz($veri)
    {
        return unserialize(gzuncompress(gzinflate(base64_decode($veri))));
    }

    function giriskontrol($kulad, $sifre, $vt)
    {

        $sifrelihal = md5(sha1(md5($sifre))); //md5 ile şifrelendi daha sonra o halini sha1 ile şifrelendi ve daha da karmaşık şifre oldu daha sonra bu halini de md5 ile şifreleyerek kırılması imkansız bir hale geldi

        $sor = $vt->prepare("select * from yonetim where kulad='$kulad' and sifre='$sifrelihal'");
        $sor->execute();

        if ($sor->rowCount() == 0) : //Girilen bilgilerde herhangi bir eşleşme yok

            echo '
            <div class="container-fluid bg-white">
            <div class="alert alert-danger border border-dark mt-5 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">BİLGİLER HATALI</div>
            </div>';
            header("refresh:2, url=index.php");
        else :
            $gelendeger = $sor->fetch(); //deger alma
            $sor = $vt->prepare("update yonetim set aktif=1 where kulad='$kulad' and sifre='$sifrelihal'");
            $sor->execute();

            echo '
            <div class="container-fluid bg-white">
            <div class="alert alert-white border border-dark mt-5 col-md-5 mx-auto p-3 text-success font-14 font-weight-bold">GİRİŞ YAPILIYOR. LÜTFEN BEKLEYİN</div>
            </div>';
            header("refresh:2, url=control.php");

            $id = self::sifrele($gelendeger["id"]);
            setcookie("kulbilgi", $id, time() + 60 * 60 * 24);
        endif;
    }

    function kuladial($vt)
    {
        $cookid = $_COOKIE["kulbilgi"];
        $cozduk = self::coz($cookid);

        $sorgusonuc = self::sorgum($vt, "select * from yonetim where id=$cozduk", 1);

        return $sorgusonuc["kulad"];
    }

    function cikis($vt)
    {
        $cookid = $_COOKIE["kulbilgi"];

        $cozduk = self::coz($cookid);

        $sorgusonuc = self::sorgum($vt, "select * from yonetim where id=$cozduk", 1);

        self::sorgum($vt, "update yonetim set aktif=0 where id=$cozduk", 0);

        setcookie("kulbilgi", $cookid, time() - 1); //herhangi bir - değer verdiğimizde cookie bitirmiş olacağız

        echo '<div class="alert alert-info mt-5 col-md-5 mx-auto">Çıkış Yapılıyor</div>';
        header("refresh:2, url=index.php");
    }

    function kontrolet($sayfa)
    {

        if (isset($_COOKIE["kulbilgi"])) : //bu cookie tanımlı ise

            if ($sayfa == "ind") :   header("Location:control.php");
            endif;


        else :
            if ($sayfa == "cot") : header("Location:index.php");
            endif;

        endif;
    }

    function introayar($vt)
    {
        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">İNTRO RESİMLERİ</h3>
        <a href="control.php?sayfa=introresimekle" class="btn btn-warning btn-sm m-2 float-right">YENİ RESİM EKLE</a> 
        </div> ';
        $introbilgiler = self::sorgum($vt, "select * from intro", 2);
        while ($sonbilgi = $introbilgiler->fetch(PDO::FETCH_ASSOC)) :
            //sorgudan gelen sonucu dışarı aldım
            echo '<div class="col-lg-4">
           <div class="row border-light p-1 m-1">
               <div class="col-lg-12">
                  <img src="../' . $sonbilgi["resimyol"] . '">
               </div>
        
               <div class="col-lg-6 text-right">
               <a href="control.php?sayfa=introresimguncelle&id=' . $sonbilgi["id"] . '" class="fa fa-edit m-2 text-success" style="font-size:25px;"></a>
               </div>

               <div class="col-lg-6 text-left">
               <a href="control.php?sayfa=introresimsil&id=' . $sonbilgi["id"] . '" class="fa fa-close m-2 text-danger" style="font-size:25px;"></a>      
               </div>
            </div>
        </div>';
        endwhile;
        echo '</div>';
    } //mevcut introlar getiriliyor

    function introresimekleme($vt)
    {
        echo '<div class="row text-center">
        <div class="col-lg-12"> ';
        if ($_POST) : //forma basıldıysa
            //ilk dosyanın boş olup olmadığına bakacağız dosyanın boyutuna bakacağız dosyanın uzantısına bakacağız
            if ($_FILES["dosya"]["name"] == "") :
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz! </div>';
                header("refresh:2, url = control.php?sayfa=introresimekle");

            else : //boş değilse
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)) : //5 MB
                    echo '<div class="alert alert-danger mt-1">Dosya Boyutu Çok Fazla! </div>';
                    header("refresh:2, url = control.php?sayfa=introresimekle");
                else : //boyutta bir problem yoksa
                    $izinverilen = array("image/png", "image/jpeg");
                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)) : //5 MB
                        //in_array : yüklenen dosya tipini bizim izin verdiğimiz arraydeki veriler ile tek tek karşılaştırır 
                        echo '<div class="alert alert-danger mt-1">İzin Verilen Uzantı Değil!</div>';
                        header("refresh:2, url = control.php?sayfa=introresimekle");
                    else : //artık her şey tamam
                        $dosyaminyolu = '../img/carousel/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaminyolu);
                        echo '<div class="alert alert-success mt-1">DOSYA BAŞARIYLA YÜKLENDİ</div>';
                        header("refresh:2, url = control.php?sayfa=introayar");
                        $dosyaminyolu2 = str_replace('../', '', $dosyaminyolu);
                        $kayitekle = self::sorgum($vt, "insert into intro (resimyol) VALUES ('$dosyaminyolu2')", 0);
                    endif;
                endif;
            endif;
        else :
        ?>

            <div class="col-lg-4 mx-auto mt-3 p-5" style="background-color: #045d66;">
                <div class="card card-bordered" style="background-color: #07bab1;">
                    <div class="card-body">
                        <h5 class="title border-bottom">İntro Resim Yükleme Formu</h5>

                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text"><input type="file" name="dosya" /></p>
                            <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1" />
                        </form>

                        <p class="card-text text-left text-danger border-top">
                            * İzin Verilen Formatlar : jpg-png <br />
                            * İzin Verilen max.boyut : 5 MB
                        </p>
                    </div>
                </div>
            </div>
        <?php
        endif;
        echo '</div></div></div>';
    }

    function introsil($vt)
    {

        $introid = $_GET["id"]; //link üzerinden gelen değeri çekmiş oluyorum

        $verial = self::sorgum($vt, "select * from intro where id=$introid", 1);

        echo '<div class="row text-center">
        <div class="col-lg-12">';

        //dosyayı silme işlemi
        unlink("../" . $verial["resimyol"]);

        //veritabanı veri silme
        self::sorgum($vt, "delete from intro where id=$introid", 0);


        echo '<div class="alert alert-success mt-1">SİLMELER BAŞARILI </div>';
        echo '</div></div>';

        header("refresh:2, url = control.php?sayfa=introayar");
    }

    function introresimguncelleme($vt)
    {
        $gelenintroid = $_GET["id"];
        echo '<div class="row text-center">
        <div class="col-lg-12">';
        if ($_POST) : //forma basıldıysa
            //ilk dosyanın boş olup olmadığına bakacağız dosyanın boyutuna bakacağız dosyanın uzantısına bakacağız
            $formdangelenid = $_POST["introid"];
            if ($_FILES["dosya"]["name"] == "") :
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz! </div>';
                header("refresh:2, url = control.php?sayfa=introayar");
            else : //boş değilse
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)) : //5 MB
                    echo '<div class="alert alert-danger mt-1">Dosya Boyutu Çok Fazla! </div>';
                    header("refresh:2, url = control.php?sayfa=introayar");
                else : //boyutta bir problem yoksa
                    $izinverilen = array("image/png", "image/jpeg");
                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)) : //5 MB
                        //in_array : yüklenen dosya tipini bizim izin verdiğimiz arraydeki veriler ile tek tek karşılaştırır 
                        echo '<div class="alert alert-danger mt-1">İzin Verilen Uzantı Değil!</div>';
                        header("refresh:2, url = control.php?sayfa=introayar");
                    else : //artık her şey tamam
                        //mevcut dosyayı silmemiz gerekmekte ve yeni dosya yolunu kayıt etmeliyiz
                        //db'den mevcut veriyi çektik ve dosyayı sildik
                        $resimyolunabak = self::sorgum($vt, "select * from intro where id=$gelenintroid", 1);
                        $dbgelenyol = '../' . $resimyolunabak["resimyol"];
                        unlink($dbgelenyol);
                        //db'den mevcut veriyi çektik ve dosyayı sildik
                        $dosyaminyolu = '../img/carousel/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaminyolu);
                        $dosyaminyolu2 = str_replace('../', '', $dosyaminyolu);
                        self::sorgum($vt, "update intro set resimyol='$dosyaminyolu2' where id=$gelenintroid", 0);
                        echo '<div class="alert alert-success mt-1">DOSYA BAŞARIYLA GÜNCELLENDİ</div>';
                        header("refresh:2, url = control.php?sayfa=introayar");
                    endif;
                endif;
            endif;
        else :
        ?>

            <div class="col-lg-4 mx-auto mt-3 p-5" style="background-color: #045d66;">
                <div class="card card-bordered" style="background-color: #07bab1;">
                    <div class="card-body">
                        <h5 class="title border-bottom">İntro Resim Güncelleme Formu</h5>

                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text"><input type="file" name="dosya" /></p>
                            <p class="card-text"><input type="hidden" name="introid" value="<?php echo $gelenintroid; ?>" /></p>
                            <input type="submit" name="buton" value="GÜNCELLE" class="btn btn-info mb-1" />
                        </form>

                        <p class="card-text text-left text-danger border-top">
                            * İzin Verilen Formatlar : jpg-png <br />
                            * İzin Verilen max.boyut : 5 MB
                        </p>
                    </div>
                </div>
            </div>
        <?php
        endif;
        echo '</div></div></div>';
    }

    function odafilo($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">ODA FİLO RESİMLERİ</h3>
        <a href="control.php?sayfa=odafiloekle" class="btn btn-warning btn-sm m-2 float-right">YENİ RESİM EKLE</a> 
        </div>
        ';

        $introbilgiler = self::sorgum($vt, "select * from filomuz", 2);

        while ($sonbilgi = $introbilgiler->fetch(PDO::FETCH_ASSOC)) :
            //sorgudan gelen sonucu dışarı aldım
            echo '<div class="col-lg-4">
           <div class="row border-light p11 m-1">
               <div class="col-lg-12">
                  <img src="../' . $sonbilgi["resimyol"] . '">
               </div>
        
               <div class="col-lg-6 text-right">
               <a href="control.php?sayfa=odafiloguncelle&id=' . $sonbilgi["id"] . '" class="fa fa-edit m-2 text-success" style="font-size:25px;"></a>
               </div>

               <div class="col-lg-6 text-left">
               <a href="control.php?sayfa=odafilosil&id=' . $sonbilgi["id"] . '" class="fa fa-close m-2 text-danger" style="font-size:25px;"></a>      
               </div>
            </div>
        </div>';

        endwhile;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function odafiloekleme($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12">
        ';

        if ($_POST) : //forma basıldıysa

            //ilk dosyanın boş olup olmadığına bakacağız
            //dosyanın boyutuna bakacağız
            //dosyanın uzantısına bakacağız

            if ($_FILES["dosya"]["name"] == "") :
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz! </div>';
                header("refresh:2, url = control.php?sayfa=odafiloekle");

            else : //boş değilse
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)) : //5 MB

                    echo '<div class="alert alert-danger mt-1">Dosya Boyutu Çok Fazla! </div>';
                    header("refresh:2, url = control.php?sayfa=odafiloekle");

                else : //boyutta bir problem yoksa

                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)) : //5 MB
                        //in_array : yüklenen dosya tipini bizim izin verdiğimiz arraydeki veriler ile tek tek karşılaştırır 

                        echo '<div class="alert alert-danger mt-1">İzin Verilen Uzantı Değil!</div>';
                        header("refresh:2, url = control.php?sayfa=odafiloekle");

                    else : //artık her şey tamam

                        $dosyaminyolu = '../img/filo/' . $_FILES["dosya"]["name"];

                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaminyolu);
                        echo '<div class="alert alert-success mt-1">DOSYA BAŞARIYLA YÜKLENDİ</div>';
                        header("refresh:2, url = control.php?sayfa=odafilo");

                        $dosyaminyolu2 = str_replace('../', '', $dosyaminyolu);
                        self::sorgum($vt, "insert into filomuz (resimyol) VALUES ('$dosyaminyolu2')", 0);
                    endif;

                endif;

            endif;

        else :
        ?>

            <div class="col-lg-4 mx-auto mt-3 p-5" style="background-color: #045d66;">
                <div class="card card-bordered" style="background-color: #07bab1;">
                    <div class="card-body">
                        <h5 class="title border-bottom">Oda Filo Resim Yükleme Formu</h5>

                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text"><input type="file" name="dosya" /></p>
                            <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1" />
                        </form>

                        <p class="card-text text-left text-danger border-top">
                            * İzin Verilen Formatlar : jpg-png <br />
                            * İzin Verilen max.boyut : 5 MB
                        </p>
                    </div>

                </div>

            </div>
        <?php
        endif;
        echo '</div></div></div>';
    }

    function odafilosil($vt)
    {

        $introid = $_GET["id"]; //link üzerinden gelen değeri çekmiş oluyorum

        $verial = self::sorgum($vt, "select * from filomuz where id=$introid", 1);

        echo '<div class="row text-center">
        <div class="col-lg-12">';

        //dosyayı silme işlemi
        unlink("../" . $verial["resimyol"]);

        //veritabanı veri silme
        self::sorgum($vt, "delete from filomuz where id=$introid", 0);

        echo '<div class="alert alert-success mt-1">SİLMELER BAŞARILI </div>';
        echo '</div></div>';
        header("refresh:2, url = control.php?sayfa=odafilo");
    }

    function odafiloguncelleme($vt)
    {

        $gelenintroid = $_GET["id"];

        echo '<div class="row text-center">
        <div class="col-lg-12">
        ';

        if ($_POST) : //forma basıldıysa

            //ilk dosyanın boş olup olmadığına bakacağız
            //dosyanın boyutuna bakacağız
            //dosyanın uzantısına bakacağız

            $formdangelenid = $_POST["introid"];

            if ($_FILES["dosya"]["name"] == "") :
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz! </div>';
                header("refresh:2, url = control.php?sayfa=odafilo");

            else : //boş değilse
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)) : //5 MB

                    echo '<div class="alert alert-danger mt-1">Dosya Boyutu Çok Fazla! </div>';
                    header("refresh:2, url = control.php?sayfa=odafilo");

                else : //boyutta bir problem yoksa

                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)) : //5 MB
                        //in_array : yüklenen dosya tipini bizim izin verdiğimiz arraydeki veriler ile tek tek karşılaştırır 

                        echo '<div class="alert alert-danger mt-1">İzin Verilen Uzantı Değil!</div>';
                        header("refresh:2, url = control.php?sayfa=odafilo");

                    else : //artık her şey tamam

                        //mevcut dosyayı silmemiz gerekmekte ve yeni dosya yolunu kayıt etmeliyiz

                        //db'den mevcut veriyi çektik ve dosyayı sildik
                        $resimyolunabak = self::sorgum($vt, "select * from filomuz where id=$gelenintroid", 1);
                        $dbgelenyol = '../' . $resimyolunabak["resimyol"];
                        unlink($dbgelenyol);
                        //db'den mevcut veriyi çektik ve dosyayı sildik


                        $dosyaminyolu = '../img/filo/' . $_FILES["dosya"]["name"];

                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaminyolu);

                        $dosyaminyolu2 = str_replace('../', '', $dosyaminyolu);
                        self::sorgum($vt, "update filomuz set resimyol='$dosyaminyolu2' where id=$gelenintroid", 0);
                        echo '<div class="alert alert-success mt-1">DOSYA BAŞARIYLA GÜNCELLENDİ</div>';
                        header("refresh:2, url = control.php?sayfa=odafilo");


                    endif;

                endif;

            endif;

        else :
        ?>

            <div class="col-lg-4 mx-auto mt-3 p-5" style="background-color: #045d66;">
                <div class="card card-bordered" style="background-color: #07bab1;">
                    <div class="card-body">
                        <h5 class="title border-bottom">Oda Filo Resim Güncelleme Formu</h5>

                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text"><input type="file" name="dosya" /></p>
                            <p class="card-text"><input type="hidden" name="introid" value="<?php echo $gelenintroid; ?>" /></p>
                            <input type="submit" name="buton" value="GÜNCELLE" class="btn btn-info mb-1" />
                        </form>

                        <p class="card-text text-left text-danger border-top">
                            * İzin Verilen Formatlar : jpg-png <br />
                            * İzin Verilen max.boyut : 5 MB
                        </p>
                    </div>

                </div>

            </div>
        <?php
        endif;
        echo '</div></div></div>';
    }

    function hakkimizda($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="mt-3 text-info">HAKKIMIZDA AYARLARI</h3>
        </div>';

        if (!$_POST) : //form'a basılmadıysa

            $sonbilgi = self::sorgum($vt, "select * from hakkimizda", 1);

            //sorgudan gelen sonucu dışarı aldım
            echo '<div class="col-lg-6 mx-auto">
           <div class="row card-bordered p-1 m-1">

        <div class="col-lg-3 border-bottom bg-light" id="hakkimizdayazilar">
          Resim
        </div>

        <div class="col-lg-9 border-bottom">
           <img src="../' . $sonbilgi["resim"] . '"><br>
           <form action="" method="post" enctype="multipart/form-data">
           <input type="file" name="dosya"> 
        </div>

        <div class="col-lg-3 border-bottom bg-light pt-3" id="hakkimizdayazilarn">
        Başlık
        </div>

        <div class="col-lg-9 border-bottom">
        <input type="text" name="baslik" class="form-control m-2" value="' . $sonbilgi["baslik"] . '"> 
        </div>
   
        <div class="col-lg-3 border-bottom bg-light" id="hakkimizdayazilar">
          İçerik
        </div>

        <div class="col-lg-9">
        <textarea name="icerik" class="form-control" rows="8">' . $sonbilgi["icerik"] . '</textarea>
        
        </div>

        <div class="col-lg-12 border-top">
         <input type="submit" name="guncel" value="GÜNCELLE" class="btn btn-primary m-2">
         </form>
        </div>
        </div>';

        else :

            $baslik = $_POST["baslik"];
            $icerik = $_POST["icerik"];


            if (@$_FILES["dosya"]["name"] != "") :

                if ($_FILES["dosya"]["size"] < (1024 * 1024 * 5)) : //5 MB

                    $izinverilen = array("image/png", "image/jpeg");

                    if (in_array($_FILES["dosya"]["type"], $izinverilen)) : //5 MB
                        //in_array : yüklenen dosya tipini bizim izin verdiğimiz arraydeki veriler ile tek tek karşılaştırır 

                        $dosyaminyolu = '../img/' . $_FILES["dosya"]["name"];

                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaminyolu);

                        $veritabaniicin = str_replace('../', '', $dosyaminyolu);

                    endif;
                endif;
            endif;

            if (@$_FILES["dosya"]["name"] != "") :
                self::sorgum($vt, "update hakkimizda set baslik='$baslik', icerik='$icerik', resim='$veritabaniicin'", 0);

                echo '
                <div class="col-lg-6 mx-auto">
                <div class="alert alert-success mt-1">GÜNCELLEME BAŞARILI </div>
                </div>
                ';
                header("refresh:2, url = control.php?sayfa=hakkimiz");
            else :

                self::sorgum($vt, "update hakkimizda set baslik='$baslik', icerik='$icerik'", 0);

                echo '<div class="col-lg-6 mx-auto">
                <div class="alert alert-success mt-1">GÜNCELLEME BAŞARILI </div>
                </div>';
                header("refresh:2, url = control.php?sayfa=hakkimiz");

            endif;

            echo '</div>';




        endif; //en ana if
    } //mevcut introlar getiriliyor

    function hizmetlerhepsi($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">HİZMETLERİMİZ</h3>
        <a href="control.php?sayfa=hizmetekle" class="btn btn-warning btn-sm m-2 float-right">YENİ HİZMET EKLE</a> 
        </div>
        ';

        $introbilgiler = self::sorgum($vt, "select * from hizmetler", 2);

        while ($sonbilgi = $introbilgiler->fetch(PDO::FETCH_ASSOC)) :
            //sorgudan gelen sonucu dışarı aldım
            echo '<div class="col-lg-6">
           <div class="row card-bordered p11 m-1 bg-light">

               <div class="col-lg-11 pt-3">
               ' . $sonbilgi["baslik"] . '
               </div>

               <div class="col-lg-1 text-right">
               <a href="control.php?sayfa=hizmetguncelle&id=' . $sonbilgi["id"] . '" class="fa fa-edit m-2 text-success" style="font-size:25px;"></a>
               <a href="control.php?sayfa=hizmetsil&id=' . $sonbilgi["id"] . '" class="fa fa-close m-2 text-danger" style="font-size:25px;"></a> 
               </div>

               <div class="col-lg-12 border-top">
               ' . $sonbilgi["icerik"] . '
               </div>
        
            </div>
        </div>';

        endwhile;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function hizmetekleme($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">HİZMET EKLE</h3>
        </div>';

        if (!$_POST) : //post edilmediyse

            echo '<div class="col-lg-6 mx-auto">
           <div class="row card-bordered p-1 m-1 bg-light">

               <div class="col-lg-2 pt-3">
                 Başlık
               </div>
               <div class="col-lg-10 p-2">
               <form action="" method="post">
                 <input type="text" name="baslik" class="form-control">
               </div>

               <div class="col-lg-12 border-top p-2">
                İçerik
               </div>
               <div class="col-lg-12 border-top p-2">
                <textarea name="icerik" rows="5" class="form-control"></textarea>
               </div>

               <div class="col-lg-12 border-top">
               <input type="submit" name="guncel" value="HİZMET EKLE" class="btn btn-warning m-2">
               </form>
              </div>
        
            </div>
        </div>';

        else :

            $baslik = htmlspecialchars($_POST["baslik"]);
            $icerik = htmlspecialchars($_POST["icerik"]);

            if ($baslik == "" && $icerik == "") :

                echo ' <div class="col-lg-6 mx-auto">
                <div class="alert alert-danger mt-1">VERİLER BOŞ OLAMAZ</div>
                </div>';
                header("refresh:2, url = control.php?sayfa=hizmetler");

            else :

                self::sorgum($vt, "insert into hizmetler (baslik, icerik) VALUES ('$baslik', '$icerik')", 0);

                echo ' <div class="col-lg-6 mx-auto">
                    <div class="alert alert-success mt-1">EKLEME BAŞARILI</div>
                    </div>';
                header("refresh:2, url = control.php?sayfa=hizmetler");
            endif;

        endif;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function hizmetguncelleme($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">HİZMET GÜNCELLE</h3>
        </div>';

        /*
          ilk gelen id alınacak
          id ile veritabanına çıkılıp verinin bilgileri gelecek
          inputlara o veriler yazılacak
          hidden ile id post için taşınacak
        */

        $kayitid = $_GET["id"];
        $kayitbilgial = self::sorgum($vt, "select * from hizmetler where id=$kayitid", 1);

        if (!$_POST) : //post edilmediyse

            echo '<div class="col-lg-6 mx-auto">
           <div class="row card-bordered p-1 m-1 bg-light">

               <div class="col-lg-2 pt-3">
                 Başlık
               </div>
               <div class="col-lg-10 p-2">
               <form action="" method="post">
                 <input type="text" name="baslik" class="form-control" value="' . $kayitbilgial["baslik"] . '">
               </div>

               <div class="col-lg-12 border-top p-2">
                İçerik
               </div>
               <div class="col-lg-12 border-top p-2">
                <textarea name="icerik" rows="5" class="form-control">' . $kayitbilgial["icerik"] . '</textarea>
               </div>

               <div class="col-lg-12 border-top">
               <input type="hidden" name="kayitidsi" value="' . $kayitid . '">
               <input type="submit" name="guncel" value="HİZMET GÜNCELLE" class="btn btn-warning m-2">
               </form>
              </div>
        
            </div>
        </div>';

        else :

            $baslik = htmlspecialchars($_POST["baslik"]);
            $icerik = htmlspecialchars($_POST["icerik"]);
            $kayitidsi = htmlspecialchars($_POST["kayitidsi"]);

            if ($baslik == "" && $icerik == "") :

                echo ' <div class="col-lg-6 mx-auto">
                <div class="alert alert-danger mt-1">VERİLER BOŞ OLAMAZ</div>
                </div>';
                header("refresh:2, url = control.php?sayfa=hizmetler");

            else :

                self::sorgum($vt, "update hizmetler set baslik='$baslik', icerik='$icerik' where id=$kayitidsi", 0);

                echo ' <div class="col-lg-6 mx-auto">
                    <div class="alert alert-success mt-1">GÜNCELLEME BAŞARILI</div>
                    </div>';
                header("refresh:2, url = control.php?sayfa=hizmetler");
            endif;

        endif;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function hizmetsil($vt)
    {

        $kayitid = $_GET["id"]; //link üzerinden gelen değeri çekmiş oluyorum
        echo '<div class="row text-center">
        <div class="col-lg-12">';

        //veritabanı veri silme
        self::sorgum($vt, "delete from hizmetler where id=$kayitid", 0);

        echo '<div class="alert alert-success mt-1">SİLME BAŞARILI </div>';
        echo '</div></div>';
        header("refresh:2, url = control.php?sayfa=hizmetler");
    }

    //------------------------------- REFERENSLAR --------------------------------------

    function referanslarhepsi($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">ODA FİLO RESİMLERİ</h3>
        <a href="control.php?sayfa=refekle" class="btn btn-warning btn-sm m-2 float-right">YENİ REFERANS EKLE</a> 
        </div>
        ';

        $introbilgiler = self::sorgum($vt, "select * from referanslar", 2);

        while ($sonbilgi = $introbilgiler->fetch(PDO::FETCH_ASSOC)) :
            //sorgudan gelen sonucu dışarı aldım
            echo '<div class="col-lg-2 bg-light ">
           <div class="row card-bordered p-1 m-1">
               <div class="col-lg-12">
                  <img src="../' . $sonbilgi["resimyol"] . '">
                  <a href="control.php?sayfa=refsil&id=' . $sonbilgi["id"] . '" class="fa fa-close m-2 text-danger" style="font-size:25px;"></a>      
                  </div>

            </div>
        </div>';

        endwhile;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function refekleme($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12">';


        if ($_POST) : //forma basıldıysa

            //ilk dosyanın boş olup olmadığına bakacağız
            //dosyanın boyutuna bakacağız
            //dosyanın uzantısına bakacağız

            if ($_FILES["dosya"]["name"] == "") :
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz! </div>';
                header("refresh:2, url = control.php?sayfa=ref");

            else : //boş değilse
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)) : //5 MB

                    echo '<div class="alert alert-danger mt-1">Dosya Boyutu Çok Fazla! </div>';
                    header("refresh:2, url = control.php?sayfa=ref");

                else : //boyutta bir problem yoksa

                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)) : //5 MB
                        //in_array : yüklenen dosya tipini bizim izin verdiğimiz arraydeki veriler ile tek tek karşılaştırır 

                        echo '<div class="alert alert-danger mt-1">İzin Verilen Uzantı Değil!</div>';
                        header("refresh:2, url = control.php?sayfa=ref");

                    else : //artık her şey tamam

                        $dosyaminyolu = '../img/referans/' . $_FILES["dosya"]["name"];

                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaminyolu);
                        echo '<div class="alert alert-success mt-1">DOSYA BAŞARIYLA YÜKLENDİ</div>';
                        header("refresh:2, url = control.php?sayfa=ref");

                        $dosyaminyolu2 = str_replace('../', '', $dosyaminyolu);
                        self::sorgum($vt, "insert into referanslar (resimyol) VALUES ('$dosyaminyolu2')", 0);
                    endif;

                endif;

            endif;

        else :
        ?>

            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered" style="background-color: chocolate;">
                    <div class="card-body">
                        <h5 class="title border-bottom">Referans Ekleme Formu</h5>

                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text"><input type="file" name="dosya" /></p>
                            <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1" />
                        </form>

                        <p class="card-text text-left text-danger border-top">
                            * İzin Verilen Formatlar : jpg-png <br />
                            * İzin Verilen max.boyut : 5 MB
                        </p>
                    </div>

                </div>

            </div>
<?php
        endif;
        echo '</div></div></div>';
    }

    function refsil($vt)
    {

        $refid = $_GET["id"]; //link üzerinden gelen değeri çekmiş oluyorum

        echo '<div class="row text-center">
        <div class="col-lg-12">';

        //veritabanı veri silme
        self::sorgum($vt, "delete from referanslar where id=$refid", 0);

        echo '<div class="alert alert-success mt-1">SİLME BAŞARILI </div>';
        echo '</div></div>';
        header("refresh:2, url = control.php?sayfa=ref");
    }

    //--------------------------- MÜŞTERİ YORUMLARI --------------------------------------

    function yorumlarhepsi($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">YORUMLAR</h3>
        <a href="control.php?sayfa=yorumlarekle" class="btn btn-warning btn-sm m-2 float-right">+</a> 
        </div>
        ';

        $introbilgiler = self::sorgum($vt, "select * from yorumlar", 2);

        while ($sonbilgi = $introbilgiler->fetch(PDO::FETCH_ASSOC)) :
            //sorgudan gelen sonucu dışarı aldım
            echo '<div class="col-lg-6">
           <div class="row card-bordered p-1 m-1 bg-light" style="border-radius:10px;">

               <div class="col-lg-11 pt-3">
               <h5>İsim : ' . $sonbilgi["isim"] . '</h5>
               </div>

               <div class="col-lg-1 text-right">
               <a href="control.php?sayfa=yorumlarguncelle&id=' . $sonbilgi["id"] . '" class="fa fa-edit m-2 text-success" style="font-size:25px;"></a>
               <a href="control.php?sayfa=yorumlarsil&id=' . $sonbilgi["id"] . '" class="fa fa-close m-2 text-danger" style="font-size:25px;"></a> 
               </div>

               <div class="col-lg-12 border-top">
               ' . $sonbilgi["icerik"] . '
               </div>
        
            </div>
        </div>';

        endwhile;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function yorumlarekleme($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">YORUM EKLE</h3>
        </div>';

        if (!$_POST) : //post edilmediyse

            echo '<div class="col-lg-6 mx-auto">
           <div class="row card-bordered p-1 m-1 bg-light">

               <div class="col-lg-2 pt-2">
                 Müşteri İsmi
               </div>
               <div class="col-lg-10 p-2">
               <form action="" method="post">
                 <input type="text" name="isim" class="form-control">
               </div>

               <div class="col-lg-12 border-top p-2">
              Mesaj
               </div>
               <div class="col-lg-12 border-top p-2">
                <textarea name="mesaj" rows="5" class="form-control"></textarea>
               </div>

               <div class="col-lg-12 border-top">
               <input type="submit" name="guncel" value="YORUM EKLE" class="btn btn-warning m-2">
               </form>
              </div>
        
            </div>
        </div>';

        else :

            $isim = htmlspecialchars($_POST["isim"]);
            $mesaj = htmlspecialchars($_POST["mesaj"]);

            if ($isim == "" && $mesaj == "") :

                echo ' <div class="col-lg-6 mx-auto p-5">
                <div class="alert alert-danger mt-1">VERİLER BOŞ OLAMAZ</div>
                </div>';
                header("refresh:2, url = control.php?sayfa=yorumlar");

            else :

                self::sorgum($vt, "insert into yorumlar (icerik, isim) VALUES ('$mesaj', '$isim')", 0);

                echo ' <div class="col-lg-6 mx-auto p-5">
                    <div class="alert alert-success mt-1">YORUM BAŞARIYLA EKLENDİ.</div>
                    </div>';
                header("refresh:2, url = control.php?sayfa=yorumlar");
            endif;

        endif;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function yorumlarguncelleme($vt)
    {

        echo '<div class="row text-center">
        <div class="col-lg-12 border-bottom">
        <h3 class="float-left mt-3 text-info">YORUM GÜNCELLE</h3>
        </div>';

        /*
          ilk gelen id alınacak
          id ile veritabanına çıkılıp verinin bilgileri gelecek
          inputlara o veriler yazılacak
          hidden ile id post için taşınacak
        */

        $kayitid = $_GET["id"];
        $kayitbilgial = self::sorgum($vt, "select * from yorumlar where id=$kayitid", 1);

        if (!$_POST) : //post edilmediyse

            echo '<div class="col-lg-6 mx-auto">
           <div class="row card-bordered p-1 m-1 bg-light">

               <div class="col-lg-2 pt-3">
                 Müşteri İsmi
               </div>
               <div class="col-lg-10 p-2">
               <form action="" method="post">
                 <input type="text" name="isim" class="form-control" value="' . $kayitbilgial["isim"] . '">
               </div>

               <div class="col-lg-12 border-top p-2">
                İçerik
               </div>
               <div class="col-lg-12 border-top p-2">
                <textarea name="mesaj" rows="5" class="form-control">' . $kayitbilgial["icerik"] . '</textarea>
               </div>

               <div class="col-lg-12 border-top">
               <input type="hidden" name="kayitidsi" value="' . $kayitid . '">
               <input type="submit" name="guncel" value="YORUM GÜNCELLE" class="btn btn-warning m-2">
               </form>
              </div>
        
            </div>
        </div>';

        else :

            $isim = htmlspecialchars($_POST["isim"]);
            $mesaj = htmlspecialchars($_POST["mesaj"]);
            $kayitidsi = htmlspecialchars($_POST["kayitidsi"]);

            if ($isim == "" && $mesaj == "") :

                echo ' <div class="col-lg-6 mx-auto p-5">
                <div class="alert alert-danger mt-1">VERİLER BOŞ OLAMAZ</div>
                </div>';
                header("refresh:2, url = control.php?sayfa=yorumlar");

            else :

                self::sorgum($vt, "update yorumlar set icerik='$mesaj', isim='$isim' where id=$kayitidsi", 0);

                echo ' <div class="col-lg-6 mx-auto p-5">
                    <div class="alert alert-success mt-1">GÜNCELLEME BAŞARILI</div>
                    </div>';
                header("refresh:2, url = control.php?sayfa=yorumlar");
            endif;

        endif;

        echo '</div>';
    } //mevcut introlar getiriliyor

    function yorumlarsil($vt)
    {

        $kayitid = $_GET["id"]; //link üzerinden gelen değeri çekmiş oluyorum
        echo '<div class="row text-center">
        <div class="col-lg-12">';

        //veritabanı veri silme
        self::sorgum($vt, "delete from yorumlar where id=$kayitid", 0);

        echo '<div class="alert alert-success mt-1">SİLME BAŞARILI </div>';
        echo '</div></div>';
        header("refresh:2, url = control.php?sayfa=yorumlar");
    }
}

//this : class içerisindeki herhangi bir fonksiyona veya değişkene ulaşabilmek
//self : this'in bir alternatifi
