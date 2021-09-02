<?php
try {
    $baglanti = new PDO("mysql:host=localhost; dbname=otel_yonetim; charset=utf8", "root", "");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

class kurumsal
{
    public  $normaltitle, $metatitle, $metadesc, $metakey, $metaout, $metaown, $metacopy,
        $logoyazi, $tvit, $face, $ints, $telno, $mailadres, $normaladres, $slogan,
        $referansbaslik, $filobaslik, $yorumbaslik, $iletisimbaslik, $hizmetlerbaslik;

    function __construct() //KURUCU fonksiyon: class çağrıldığında ilk çalışacak fonksiyon
    {
        try {
            $baglanti = new PDO("mysql:host=localhost; dbname=otel_yonetim; charset=utf8", "root", "");
            $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $ayarcek = $baglanti->prepare("select * from ayarlar");
        $ayarcek->execute();
        $sorguson = $ayarcek->fetch();

        $this->normaltitle = $sorguson["title"];
        $this->metatitle = $sorguson["metatitle"];
        $this->metadesc = $sorguson["metadesc"];
        $this->metakey = $sorguson["metakey"];
        $this->metaout = $sorguson["metaauthor"];
        $this->metaown = $sorguson["metaowner"];
        $this->metacopy = $sorguson["metacopy"];
        $this->logoyazi = $sorguson["logoyazisi"];
        $this->tvit = $sorguson["twit"];
        $this->face = $sorguson["face"];
        $this->ints = $sorguson["ints"];
        $this->telno = $sorguson["telefonno"];
        $this->mailadres = $sorguson["mailadres"];
        $this->normaladres = $sorguson["adres"];
        $this->slogan = $sorguson["slogan"];
        $this->referansbaslik = $sorguson["referansbaslik"];
        $this->filobaslik = $sorguson["filobaslik"];
        $this->yorumbaslik = $sorguson["yorumbaslik"];
        $this->iletisimbaslik = $sorguson["iletisimbaslik"];
        $this->hizmetlerbaslik = $sorguson["hizmetlerbaslik"];
    }

    function introbak($baglanti)
    {
        $introal = $baglanti->prepare("select * from intro");
        $introal->execute();

        while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) :

            echo '<div class="item" style="background-image: url(' . $sonucum["resimyol"] . ');"></div>';

        endwhile;
    }

    function hakkimizda($baglanti)
    {
        $introal = $baglanti->prepare("select * from hakkimizda");
        $introal->execute();

        $sonucum = $introal->fetch();

        echo ' <div class="row">
        <div class="col-lg-6 hakkimizda-img">
            <img src=' . $sonucum["resim"] . ' alt="' . $sonucum["resim"] . '-Hakkında" />

        </div>

        <div class="col-lg-6 content">
            <h2>' . $sonucum["baslik"] . '</h2>
            <h3>' . $sonucum["icerik"] . '</h3>

        </div>
    </div>';
    }

    function hizmetler($baglanti)
    {
        $introal = $baglanti->prepare("select * from hizmetler");
        $introal->execute();


        echo '<div class="section-header">
        <h2>HİZMETLERİMİZ</h2>
        <p>'; echo $this->hizmetlerbaslik; echo '</p>
    </div>

    <div class="row">';
    
    while($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) :

        echo ' <div class="col-lg-6">
        <div class="box wow fadeInLeft">
            <div class="icon"><i class="fa fa-map" aria-hidden="true"></i></div>
            <h4 class="title"><a href="#">' . $sonucum["baslik"] . '</a></h4>
            <p class="description">' . $sonucum["icerik"] . '</p>
        </div>

    </div>';
    endwhile;
   
    echo '</div>';
    }

    function referans($baglanti)
    {
        $introal = $baglanti->prepare("select * from referanslar");
        $introal->execute();

       // <p></p> kısmını ayarlar tablosunda inşa ettik
        echo '<div class="section-header">
        <h2>REFERANSLAR</h2>
        <p>'; echo $this->referansbaslik; echo '</p> 
    </div>

    <div class="owl-carousel clients-carousel">';

        while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) :

            echo '<img src=' . $sonucum["resimyol"] . ' alt="Referans-' . $sonucum["id"] . '" />';

        endwhile;
        echo '</div>';
    }

    function filomuz($baglanti)
    {
        $introal = $baglanti->prepare("select * from filomuz");
        $introal->execute();

        echo '
        <div class="container">
            <div class="section-header">
                <h2>ODALARIMIZ</h2>
                <p>'; echo $this->filobaslik; echo '</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row no-gutters">';
            while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) :

               echo '<div class="col-lg-3 col-md-4">
                <div class="filo-item wow fadeInUp">
                    <a href="' . $sonucum["resimyol"] . '" class="filo-popup">
                        <img src="' . $sonucum["resimyol"] . '" alt="Oda-' . $sonucum["id"] . '" />
                        <div class="filo-overlay"></div>
                    </a>
                </div>
            </div>';    
            endwhile;

              echo' </div></div>';
    
    }

    function yorumlar($baglanti)
    {
        $introal = $baglanti->prepare("select * from yorumlar");
        $introal->execute();

        echo ' <div class="section-header">
        <h2>Müşteri Yorumları</h2>
        <p>'; echo $this->yorumbaslik; echo '</p>
    </div>

    <div class="owl-carousel testimonials-carousel">';

    while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) :

        echo ' <div class="testimonial-item" style="background-color: wheat;">
        <p>
            <img src="img/sol.png" class="quote-sign-left" alt="" />
            '.$sonucum["icerik"].'
            <img src="img/sag.png" class="quote-sign-right" alt="" />
        </p>
        <img src="img/yorum.jpg" class="testimonial-img" alt="" />
        <h3>'.$sonucum["isim"].'</h3>
    </div>';
     endwhile;

   echo' </div>';

    }
}
?>
