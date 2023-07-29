<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META content="MSHTML 6.00.2900.3020" name=GENERATOR></HEAD>
<BODY>
<a href="http://localhost/vse/vytvorgalerii.php">spustit</a>
<?php 



/* 

zmenšení obrázkù nefunguje špatná funkce, ale vytvoøení galerie ano

co je tøeba nastavit info
$sir - nastaveni sirky zmenseneho obrazku (osa x, osa Y se nastaví sama)
$obr1, $b - pojmenovani maleho zmenseneho obrazku + cesta k nemu (novemu obrazku pribude do nazvu jednicka (hodnota promenne $b))
$adrs - název adresáøe kde budou zmenšené obrazky
$g - nazev adresare a souboru kde jsou ulozeny obrazky ke zmenseni


*/
/////////////////////////// ZADEJ ///////////////////pro vytvoreni tabulky s zmenceninami obrazku

$sl = 6; //pocet sloupcu
$ce = "thumbnails";//cesta k zmensenym obrazkum
$naz = "gal3.html"; //nazev galeri
$pop = "otrokyne ve støedovìku až po souèasnost"; //popis do hlavicky pro title
$str = "imagepages";
$cellpad ="cellpadding=\"20\"";// v tabulce galerii rozestup mezi obrazky



//nazvy tlacitek v galerii prirazeni ZADEJ
$vse = "tsign_purple_index.gif"; //navrat do prehledu obrazku
$dop = "tsign_purple_next.gif"; //dalci obrazek
$zpet = "tsign_purple_previous.gif"; //predchozi obrazek
$zac = "tsign_purple_first.gif"; //na prvni obrazek v galerii
$kon = "tsign_purple_last.gif"; //na posledni obrazek v galerii
$adrt = "arlesimages" ; //adresar s talcitky

$class = "class=\"galeriestranky\"";//styl pro pocet stranek 1 / 3
$tec ="../"; //cesta k souboru pro tlacitka a obrazky kdyz jsou v jinem aresari

$link ="<link rel=\"stylesheet\" type=\"text/css\" href=\"../../../pozadi/styly.css\">";//nastaveni stylu stranky
$linkp ="<link rel=\"stylesheet\" type=\"text/css\" href=\"../../pozadi/styly.css\">";//nastaveni stylu uvodni stranky

$adr = "images";//nazev adresare kde jsou obrazky v puvodni velikosti
$adrs = "thumbnails";//nazev adreare kde budou zmensene obrazky

$b = 1;// prida se do nazvu noveho maleho obrazku
$sir = 100; //sirka zmenseneho obrazku


$c = 0;//cislo je uvedeno v nazvu stranek galerie page1 pokud se zmeni toto cislo je nutne zmenit i $l
$l = 1; //prvni stranka v galerii bude mit v nazvu jednicku
$d = 0; //slouzi pro vypocet poctu obrazku v galerii

if(!file_exists($adrs)) {
mkdir($adrs, 777) ;
}

if(!file_exists($str)) {
mkdir($str, 777) ;
}
 
////////////////////rozmery tlacitek v galerii
$vse1 = getimagesize(".\\$tec$adrt\\$vse"); 
$dop1 = getimagesize(".\\$tec$adrt\\$dop"); 
$zpet1 = getimagesize(".\\$tec$adrt\\$zpet");
$zac1 = getimagesize(".\\$tec$adrt\\$zac");
$kon1 = getimagesize(".\\$tec$adrt\\$kon");
/////////////////////////////////////////

$ot = opendir(".\\$adr");
while ($p = readdir($ot)) {
	if ($p !="." && $p !=".." && $p !="Thumbs.db") {
$d++;


}

} //while pocitani obrazku

//////////////////////////////
$maxi = $d; //pro tlacitka v galerii
/////////////////////////////
$ot = opendir(".\\$adr");
while ($p = readdir($ot)) {
	if ($p !="." && $p !=".." && $p !="Thumbs.db") {



$obr1 = ".\\$adrs\\$b$p";//jmeno zmenseneho obrazku + cesta



$g = ".\\$adr\\$p";


$roz = getimagesize($g);



//rozmer zmenšeneho obrazku
$koef = $sir/$roz[0];

$sirx = $roz[0]*$koef;
$siry = $roz[1]*$koef;
#print_r ($sirx);
#print_r ($siry);

//vytvori obrazek pozadovane vysky a sirky - nefungovalo to tak jsem to vykrižkovala
 # $image_p = imagecreatetruecolor($sirx, $siry);
 # //otevre puvodni obrazek 
  #$image = imagecreatefromjpeg($g);
  #//okopirujeme zmenseny puvodni obrazek do noveho
 # imagecopyresampled($image_p, 
 #                    $image, 0, 0, 0, 0, 
 #                    $sirx, $siry, 
  #                   $roz[0], $roz[1]);
  //a ulozime 
  #imagejpeg($image_p,$obr1, 95);

	
++$c;
$cmin = $c - 1;// k tlacitkum navigece na predchozi strnaku


// k tlacitkum navigece na predchozi strnaku
$cdal = $c + 1;// k tlacitkum navigece na dalsi strnaku




$mk = "page";// jmeno stranky s obrazkem
$ml = ".html";// pripona stranky s obrazkem
$na = "$mk$c$ml";// jmeno stranky s obrazkem a cislem
////////////////////////////////// pokud jsem na prvnim obrazku v galerii nezobrazi se tlacitko prdchozi
if ($c > 1) {
 $dml ="<a href=\"$mk$cmin$ml\"><img src= \"$tec$tec$adrt/$zpet\" $zpet1[3] border=\"0\"></a>";
} else {
 $dml = "<div style=\"width:$zpet1[1]\">&nbsp;</div>";
}
//////////////////////

////////////////////////////////// pokud jsem na poslednim obrazku v galerii nezobrazi se tlacitko dalsi atd
if ($c < $maxi) {
 $dll ="<a href=\"$mk$cdal$ml\"><img src= \"$tec$tec$adrt/$dop\" $dop1[3] border=\"0\"></a>";
} else {
 $dll = "<div style=\"width:$zpet1[1]\">&nbsp;</div>";
}

if ($c < $maxi) {
$ko ="<a href=\"$mk$maxi$ml\"><img src= \"$tec$tec$adrt/$kon\" $kon1[3] border=\"0\"></a>";
} else {
 $ko = "<div style=\"width:$kon1[1]\">&nbsp;</div>";
}

if ($c > 1) {
$za ="<a href=\"$mk$l$ml\"><img src= \"$tec$tec$adrt/$zac\" $zac1[3] border=\"0\"></a>";
} else {
 $za = "<div style=\"width:$zpet1[1]\">&nbsp;</div>";
}
///////////////////////////////////////////vytvori soubor kde jsou obrazky
$no = fopen("$str//$na", "w+");
$ah = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n
<html>\n
<head>\n
<meta http-equiv=Content-Type content=\"text/html;charset=windows-1250\">\n
$link
<title>$mk$c</title>\n
</head>\n
<body>\n
<center>\n
<table border=\"0\" align=\"center\" >\n
<tr>\n
<td><a href=\"$tec$naz\"><img src= \"$tec$tec$adrt/$vse\" $vse1[3] border=\"0\"></a></td>\n
<td>$za</td>\n
<td>$dml</td>\n
<td>$dll</a></td>\n
<td>$ko</td>\n
</tr>\n
</table>\n
<span $class >$c / $d</span><br> 
<img src= \"$tec$adr/$p\" $roz[3] border=\"0\">\n
<center>\n
</body>\n
</html>";




$pis = fwrite($no,$ah);	
	


	
	
}



}

closedir($ot);
echo "<H2>provedeno zmenseni obrazku :-) </br></H2>";






///////////////////////////////////////////////zacina vytvareni tabulky, ve ktere jsou zmenseniny
$f = 0; //nemenit cislo v nazvu stranek galeri
$c = 0; //nemenit ++$c slozi nize pro pocitani obrazku
$a1 = "<table $cellpad border=\"0\"><tr>\n";
$hla = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n
<html>\n
<head>\n
<title>$naz $pop</title>\n
<meta http-equiv=Content-Type content=\"text/html;charset=windows-1250\">\n
<style>td {text-align:center}</style>\n
$linkp\n
</head>\n
<body><center>\n";


$sou = fopen($naz, "w+");
fwrite($sou, $hla);
fwrite($sou, $a1);


$ot = opendir($ce); 
while ($cti = readdir($ot)) {
	if ($cti !="." && $cti !=".." && $cti !="Thumbs.db") {//nacte jmena obrazku z adresare
++$f;

$obr = getimagesize("$ce\\$cti");
$a2 = "<td><a href=\"$str\\$mk$f$ml\"><img src=\"$ce/$cti\" alt=\"$cti\" title=\"\" $obr[3] border=\"3\"/></a></td>\n" ;
fwrite($sou, $a2);



$novy = array(++$c); //vytvoreni pole, aby se mohla pouzit funkce max pro zjisteni poctu obrazku 
//vytvoreni souboru kde budou umistene obrazky v puvodni velikosti


	
				if (bcmod($c,$sl) ==0) {
				$a3 = "</tr>\n<tr>"; //vytvori sloupce
				fwrite($sou, $a3);
}//if vlozeni sloupcu

}//if						
}
closedir($ot);



//pokud v tabulce chybi obrazky, musi se vytvorit prazdna okna, aby tabulka byla uplna

$pr = max($novy); //pocet obrazku v tabulce 
$od = bcmod($pr,$sl) ;
$vy = $sl - $od;//vysledek kolik prazdnych bunek musim pridat
$a = 0;
while ($a<$vy) {
++$a;


$a4 = "<td>&nbsp;</td>";//vlozit tolik prazdnych poli kolich chybi do zarovnani tabulky
fwrite($sou, $a4);

//vytvori soubory s obrazky v puvodni velikosti


//////////////////////////////////////////////////

}

//konec vytvareni prazdnych poli v tabulce
$a5 = "</tr></table>"; //vlozi konec tabulky
fwrite($sou, $a5);
fwrite($sou, "</center></body></html>");








?>


<body>
<html>