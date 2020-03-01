<? /*
***********************************
        Hejri Date Script Version 1.0
   		4-4-1430
   Programed By : Saeed Hubaishan
          saeed@hubaishan.com
***********************************
       O?NiE CaECNiI CaaINi
	ENaIE: AEi CaICNE CaICOaEi
	aONY aa?U OYICE CaOiI a?Ea Ea aCIi CaaCIUi NIaa Caaa
	www.muqbel.net
***********************************
EIIiECE CaO?NiEE OEaON EADa Caaa Yi aa?U
		www.salafsoft.com

///////////////////////////////////////////////////
//              ONi?E CaEN?iE                    //
//                                               //
//         ?a ENYU aDC CaaaY Aai aa?U?           //
//      ?a ECOEIUCA CaaaY aa aa?U? aECONE        //
//   aAOCYE CaECNiI CaaINi aaa?U? COEIIa CaAaN     //
//            include ("hejridate.php")              //
//  aDa? Yi Ai OYIE ENiI ! aU aaCIUE aOCN CaaaY   //
///////////////////////////////////////////////////


/* ==========================adate ICaE EaOi? Caa?E CaUNEiE
EUaa aYO Uaa CaICaE date aa?a aU UNO CaECNiI ECaUNEi
***********AINY EaOi? CaECNiI CaaINi 
	_j Caiaa EIaa AOYCN
	_d iaa aU AOYCN
	 _z N?a Caiaa Yi CaOaE
	 _M,_F COa CaOaN
	 _m   N?a CaOaN aU AOYCN
	 _n N?a CaOaN EIaa AOYCN
	 _t UII CaAiCa Yi CaOaN
	 _L CaOaE ?EiOE Aa aC 1=?EiOE
	 _Y CaOaE N?a ?Caa
	 _y CaOaE aa N?aia
******AINY EaOi? CaECNiI CaaiaCIi CaEi Ea AUCIE EaIiaaC
	l,D COa iaa CaAOEaU
	F COaCA CaAOaN CaONiCaiE (?Caaa! OECO...)
	M COaCA CaAOaN (EOaiE AaIaiOiE)iaCiN ! YENCiN...)
	a ,A OECIC aaOCA aaa?E
*/

function adate($format='_j _M _YaU',$timestamp=0)
         {
$gmonths=array("iaCiN","YENCiN","aCNO","AENia","aCia","iaaia","iaaia","AUOOO","OEEaEN","A?EaEN","aaYaEN","IiOaEN");
$smonths=array("?Caaa CaECai","OECO","ADCN","aiOCa","AiCN","IOiNCa","EaaO","AE","Aiaaa","EONia CaAaa","EONia CaECai","?Caaa CaAaa");
$days=array("CaAII","CaAEaia","CaEaCECA","CaANEUCA","CaIaiO","CaIaUE","CaOEE");
$hmonths=array("aINa","OYN","OaN NEiU CaAaa","OaN NEiU CaECai","IaCIi CaAaai","IaCIi CaAINE","NIE","OUECa","OaN NaOCa","OaCa","Da Ca?UIE","Da CaIIE");

if ($timestamp==0) {$timestamp=time();}
list($w, $mn,$am)=explode(' ', date("w n a",$timestamp));
$j=intval($timestamp/86400);
$j=$j+492150; //492534;
$n = intval($j / 10631);
$j=$j-($n*10631);
$y = intval($j / 354.36667);
$hy = ($n*30)+$y+1;
$j=$j-round($y*354.36667);
$z=$j;
$m = intval($j/29.5);
$hm = $m+1;
$j=$j-round($m*29.5);
$d = $j;
$hd = intval($d);

If ($hd == 0) {
$hd=($hm%2==1)? (29): (30);
$hm = $hm - 1;
}

If ($hm == 0 ) {
$hm = 12;
$hy = $hy - 1;
if (round(($hy%30)*0.36667)>round((($hy-1)%30)*0.36667)) {
	$hd=30;
	$z=355;
	} else {
		$hd=29;
		$z=354;
	}
}
$L=(round(($hy%30)*0.36667)>round((($hy-1)%30)*0.36667))?(1):(0);
$str='';
for ($n=0;$n<=strlen($format);$n++) {
	$c=substr($format,$n,1);
switch ($c) {
	case "l":
	case "D":
	$str.=$days[$w];
	break;
	case "F":
	$str.=$smonths[($mn-1)];
	break;
	case "M":
	$str.=$gmonths[($mn-1)];
	break;
	case "a":
	$str.=($am=='am')? ('O'):('a');
	break;
	case "A":
	$str.=($am=='AM')? ('OECI?C'):('aOCA?');
	break;
	case "_":
		$n=$n+1;
		switch (substr($format,$n,1)) {
			case "j":
			$str.=$hd;
			break;
			case "d":
			$str.=str_pad($hd,2,"0",STR_PAD_LEFT);
			break;
			case "z":
			$str.=$z-1;
			break;
			case "F":case "M":
			$str.=$hmonths[($hm-1)];
			break;
			case "t":
			$t=($hm%2==1)? (30): (29);
			If ($hm == 12 && $L==1) $t =30;
			$str.=$t;
			break;
			case "m":
			$str.=str_pad($hm,2,"0",STR_PAD_LEFT);
			break;
			case "n":
			$str.=$hm;
			break;
			case "y":
			$str.=substr($hy,2);
			break;
			case "Y":
			$str.=$hy;
			break;
			case "L":
			$str.=$L;
			break;
		}	
	break;
	case '\\':
	$str.=substr($format,$n,2);
	$n++;
	break;
	default:
	$str.=$c;
	break;
}	
	
}
return date($str,$timestamp);
}
/* ==========================edate ICaE EaOi? Caa?E CAaIaiOiE
English date format
do same of (date) but if can view hejri date
***********hejridate format letters 
	_j Day of the month without leading zeros
	_d Day of the month, 2 digits with leading zeros
	 _z The day of the year (starting from 0)
	 _M, _F A full textual representation of a month, such as Ramadan
	 _m  Numeric representation of a month, with leading zeros
	 _n Numeric representation of a month, without leading zeros
	 _t Number of days in the given month
	 _L Whether it's a leap year, 1 if it is a leap year, 0 otherwise
	 _Y A full numeric representation of a year, 4 digits
	 _y A two digit representation of a year
*/
function edate($format='_j _M _Y',$timestamp=0)
         {
$hmonths=array("\M\u\h\a\\r\\r\a\m","\S\a\f\a\\r","\R\a\b\i' \A\w\w\a\l","\R\a\b\i' \T\h\a\\n\i","\J\a\m\a\d\a \E\l \O\u\l\a","\J\a\m\a\d\a \E\l \T\h\a\\n\i\a\h","\R\a\j\a\b","\S\h\a'\b\a\\n","\R\a\m\a\d\a\\n","\S\h\a\w\w\a\l","\T\h\o\u\l \K\i'\d\a\h","\T\h\o\u\l \H\i\j\j\a\h");

if ($timestamp==0) {$timestamp=time();}
list($w, $mn,$am)=explode(' ', date("w n a",$timestamp));
$j=intval($timestamp/86400);
$j=$j+492150; //492534;
$n = intval($j / 10631);
$j=$j-($n*10631);
$y = intval($j / 354.36667);
$hy = ($n*30)+$y+1;
$j=$j-round($y*354.36667);
$z=$j;
$m = intval($j/29.5);
$hm = $m+1;
$j=$j-round($m*29.5);
$d = $j;
$hd = intval($d);

If ($hd == 0) {
$hd=($hm%2==1)? (29): (30);
$hm = $hm - 1;
}

If ($hm == 0 ) {
$hm = 12;
$hy = $hy - 1;
if (round(($hy%30)*0.36667)>round((($hy-1)%30)*0.36667)) {
	$hd=30;
	$z=355;
	} else {
		$hd=29;
		$z=354;
	}
}
$L=(round(($hy%30)*0.36667)>round((($hy-1)%30)*0.36667))?(1):(0);
$str='';
for ($n=0;$n<=strlen($format);$n++) {
	$c=substr($format,$n,1);
switch ($c) {
	case "_":
		$n=$n+1;
		switch (substr($format,$n,1)) {
			case "j":
			$str.=$hd;
			break;
			case "d":
			$str.=str_pad($hd,2,"0",STR_PAD_LEFT);
			break;
			case "z":
			$str.=$z-1;
			break;
			case "F":case "M":
			$str.=$hmonths[($hm-1)];
			break;
			case "t":
			$t=($hm%2==1)? (30): (29);
			If ($hm == 12 && $L==1) $t =30;
			$str.=$t;
			break;
			case "m":
			$str.=str_pad($hm,2,"0",STR_PAD_LEFT);
			break;
			case "n":
			$str.=$hm;
			break;
			case "y":
			$str.=substr($hy,2);
			break;
			case "Y":
			$str.=$hy;
			break;
			case "L":
			$str.=$L;
			break;
		}	
	break;
	case '\\':
	$str.=substr($format,$n,2);
	$n++;
	break;
	default:
	$str.=$c;
	break;
}	
	
}
return date($str,$timestamp);
}


/* ============================hejri2time iIaa CaECNiI CaaINi Aai timestamp
i?aa CaECNiI CaaIIa EENEiE Caiaa Ea CaOaN Ea CaOaE
ia?a COEIICa CaNaaO CaECaiE Yi CaYOa Eia AIOCA CaECNiI
- / \ .
*/
function hejri2time($thedate)
         {
list($hd,$hm,$hy)= preg_split('/[\/\-\.\s\\\\]+/',$thedate);
$hy=$hy-1;
$n=intval($hy/30);
$j=($n*10631)+round(($hy-($n*30))*354.36667);
$hm=$hm-1;
$j=$j+round($hm*29.5)+$hd;
$j=$j-492150;
$jd=$j*86400; 
return $jd;
}
    ?>
