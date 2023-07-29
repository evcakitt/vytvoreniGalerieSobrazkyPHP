<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META content="MSHTML 6.00.2900.3020" name=GENERATOR></HEAD>
<BODY>
<?php 



/* 
co je tøeba nastavit info
$sir - nastaveni sirky zmenseneho obrazku (osa x, osa Y se nastaví sama)
$obr1, $b - pojmenovani maleho zmenseneho obrazku + cesta k nemu (novemu obrazku pribude do nazvu jednicka (hodnota promenne $b))
$adrs - název adresáøe kde budou zmenšené obrazky
$g - nazev adresare a souboru kde jsou ulozeny obrazky ke zmenseni


*/
$c = 0;//cislo je uvedeno v nazvu stranek galerie page1 pokud se zmeni toto cislo je nutne zmenit i $l
$l = 1; //prvni stranka v galerii bude mit v nazvu jednicku
$d = 0; //slouzi pro vypocet poctu obrazku v galerii
///////////////////////////////////////////nazvy tlacitek v galerii prirazeni
$vse = "tsign_purple_index.gif"; //navrat do prehledu obrazku
$dop = "tsign_purple_next.gif"; //dalci obrazek
$zpet = "tsign_purple_previous.gif"; //predchozi obrazek
$zac = "tsign_purple_first.gif"; //na prvni obrazek v galerii
$kon = "tsign_purple_last.gif"; //na posledni obrazek v galerii
$adrt = "arlesimages" ; //adresar s talcitky
$naz = "pribeh_otrokyne.html";  //nazev galerie
$class = "class=\"galeriestranky\"";//styl pro pocet stranek 1 / 3
/////////////////////////////////////////

$link ="<link rel=\"stylesheet\" type=\"text/css\" href=\"../../../pozadi/styly.css\">";//nastaveni stylu stranky
echo $link;

$adr = "obrazky";//nazev adresare kde jsou obrazky v puvodni velikosti
$adrs = "zmensobr";//nazev adreare kde budou zmensene obrazky

$b = 1;// prida se do nazvu noveho maleho obrazku
$sir = 100; //sirka zmenseneho obrazku

if(!file_exists($adrs)) {
mkdir($adrs, 777) ;
}
 
////////////////////rozmery tlacitek v galerii
$vse1 = getimagesize(".\\$adrt\\$vse"); 
$dop1 = getimagesize(".\\$adrt\\$dop"); 
$zpet1 = getimagesize(".\\$adrt\\$zpet");
$zac1 = getimagesize(".\\$adrt\\$zac");
$kon1 = getimagesize(".\\$adrt\\$kon");
/////////////////////////////////////////

$ot = opendir(".\\$adr");
while ($p = readdir($ot)) {
	if ($p !="." && $p !=".." && $p !="Thumbs.db") {
$d++;


}

} //while

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
$sirya = $roz[1]*$koef;
$siry = round($sirya);
print_r ($sirx);
echo "<br>" ;
print_r ($siry);
 echo "<br>" ;     
print_r (round($siry), 0);			
			

//vytvori novy obrazek pozadovane vysky a sirky
  $image_p = imagecreatetruecolor($sirx, $siry);
  //otevre puvodni obrazek 
  $image = imagecreatefromjpeg($g);
  //okopirujeme zmenseny puvodni obrazek do noveho
  imagecopyresampled($image_p, 
                     $image, 0, 0, 0, 0, 
                     $sirx, $siry, 
                     $roz[0], $roz[1]);
  //a ulozime 
  imagejpeg($image_p,$obr1, 95);

	
++$c;
$cmin = $c - 1;// k tlacitkum navigece na predchozi strnaku


// k tlacitkum navigece na predchozi strnaku
$cdal = $c + 1;// k tlacitkum navigece na dalsi strnaku




$mk = "page";
$ml = ".html";
$na = "$mk$c$ml";
////////////////////////////////// pokud jsem na prvnim obrazku v galerii nezobrazi se tlacitko prdchozi
if ($c > 1) {
 $dml ="<a href=\"$mk$cmin$ml\"><img src= \"$adrt/$zpet\" $zpet1[3] border=\"0\"></a>";
} else {
 $dml = "<div style=\"width:$zpet1[1]\">&nbsp;</div>";
}
//////////////////////

////////////////////////////////// pokud jsem na poslednim obrazku v galerii nezobrazi se tlacitko dalsi atd
if ($c < $maxi) {
 $dll ="<a href=\"$mk$cdal$ml\"><img src= \"$adrt/$dop\" $dop1[3] border=\"0\"></a>";
} else {
 $dll = "<div style=\"width:$zpet1[1]\">&nbsp;</div>";
}

if ($c < $maxi) {
$ko ="<a href=\"$mk$maxi$ml\"><img src= \"$adrt/$kon\" $kon1[3] border=\"0\"></a>";
} else {
 $ko = "<div style=\"width:$kon1[1]\">&nbsp;</div>";
}

if ($c > 1) {
$za ="<a href=\"$mk$l$ml\"><img src= \"$adrt/$zac\" $zac1[3] border=\"0\"></a>";
} else {
 $za = "<div style=\"width:$zpet1[1]\">&nbsp;</div>";
}
///////////////////////////////////////////
$no = fopen("$na", "w+");
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
<td><a href=\"$naz\"><img src= \"$adrt/$vse\" $vse1[3] border=\"0\"></a></td>\n
<td>$za</td>\n
<td>$dml</td>\n
<td>$dll</a></td>\n
<td>$ko</td>\n
</tr>\n
</table>\n
<span $class >$c / $d</span><br> 
<img src= \"$adr/$p\" $roz[3] border=\"0\">\n
<center>\n
</body>\n
</html>";




$pis = fwrite($no,$ah);	
	


	
	
}



}

closedir($ot);
echo "<H2>provedeno zmenseni obrazku :-) </br></H2>";







?>

<a href="http://localhost/vse/zmenseniobr.php">spustit</a>

<body>
<html>