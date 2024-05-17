<?
/* *******************************************************************************************************
MODUL NAME 			: 
FILE NAME 			: string.func.php
AUTHOR				: 
VERSION				: 1.0
MODIFICATION DOC	:
DESCRIPTION			: Functions to handle string operation
***************************************************************************************************** */



/* fungsi untuk mengatur tampilan mata uang
 * $value = string
 * $digit = pengelompokan setiap berapa digit, default : 3
 * $symbol = menampilkan simbol mata uang (Rupiah), default : false
 * $minusToBracket = beri tanda kurung pada nilai negatif, default : true
 */
 function makedirs($dirpath, $mode=0777)
{
    return is_dir($dirpath) || mkdir($dirpath, $mode, true);
}

 
function setInfoChecked($val1, $val2, $val="checked")
{
	if($val1 == $val2)
		return $val;
	else
		return "";
}


function in_array_column($text, $column, $array)
{
    if (!empty($array) && is_array($array))
    {
        for ($i=0; $i < count($array); $i++)
        {
            if ($array[$i][$column]==$text || strcmp($array[$i][$column],$text)==0) 
				$arr[] = $i;
        }
		return $arr;
    }
    return "";
}


function currencyToPage($value, $symbol=true, $minusToBracket=true, $minusLess=false, $digit=3)
{

    if($value == "")
		$value = 0;
	$rupiah = number_format($value,0, ",",".");
    $rupiah = $rupiah . ",-";
    return $rupiah;
}

function nomorDigit($value, $symbol=true, $minusToBracket=true, $minusLess=false, $digit=3)
{
	$arrValue = explode(".", $value);
	$value = $arrValue[0];
	if(count($arrValue) == 1)
		$belakang_koma = "";
	else
		$belakang_koma = $arrValue[1];
	if($value < 0)
	{
		$neg = "-";
		$value = str_replace("-", "", $value);
	}
	else
		$neg = false;
		
	$cntValue = strlen($value);
	//$cntValue = strlen($value);
	
	if($cntValue <= $digit)
		$resValue =  $value;
	
	$loopValue = floor($cntValue / $digit);
	
	for($i=1; $i<=$loopValue; $i++)
	{
		$sub = 0 - $i; //ubah jadi negatif
		$tempValue = $endValue;
		$endValue = substr($value, $sub*$digit, $digit);
		$endValue = $endValue;
		
		if($i !== 1)
			$endValue .= ".";
		
		$endValue .= $tempValue;
	}
	
	$beginValue = substr($value, 0, $cntValue - ($loopValue * $digit));
	
	if($cntValue % $digit == 0)
		$resValue = $beginValue.$endValue;
	else if($cntValue > $digit)
		$resValue = $beginValue.".".$endValue;
	
	//additional
	if($belakang_koma == "")
		$resValue = $symbol." ".$resValue;
	else
		$resValue = $symbol." ".$resValue.",".$belakang_koma;
	
	
	if($minusToBracket && $neg)
	{
		$resValue = "(".$resValue.")";
		$neg = "";
	}
	
	if($minusLess == true)
	{
		$neg = "";
	}
	
	$resValue = $neg.$resValue;
	
	//$resValue = "<span style='white-space:nowrap'>".$resValue."</span>";

	return $resValue;
}


function numberToIna($value, $symbol=true, $minusToBracket=true, $minusLess=false, $digit=3)
{
	$arr_value = explode(".", $value);
	
	if(count($arr_value) > 1)
		$value = $arr_value[0];
	
	if($value < 0)
	{
		$neg = "-";
		$value = str_replace("-", "", $value);
	}
	else
		$neg = false;
		
	$cntValue = strlen($value);
	//$cntValue = strlen($value);
	
	if($cntValue <= $digit)
		$resValue =  $value;
	
	$loopValue = floor($cntValue / $digit);
	
	for($i=1; $i<=$loopValue; $i++)
	{
		$sub = 0 - $i; //ubah jadi negatif
		$tempValue = $endValue;
		$endValue = substr($value, $sub*$digit, $digit);
		$endValue = $endValue;
		
		if($i !== 1)
			$endValue .= ".";
		
		$endValue .= $tempValue;
	}
	
	$beginValue = substr($value, 0, $cntValue - ($loopValue * $digit));
	
	if($cntValue % $digit == 0)
		$resValue = $beginValue.$endValue;
	else if($cntValue > $digit)
		$resValue = $beginValue.".".$endValue;
	
	//additional
	if($symbol == true && $resValue !== "")
	{
		$resValue = $resValue;
	}
	
	if($minusToBracket && $neg)
	{
		$resValue = "(".$resValue.")";
		$neg = "";
	}
	
	if($minusLess == true)
	{
		$neg = "";
	}

	if(count($arr_value) == 1)
		$resValue = $neg.$resValue;
	else
		$resValue = $neg.$resValue.",".$arr_value[1];
	
	if(substr($resValue, 0, 1) == ',')
		$resValue = '0'.$resValue;	//$resValue = "<span style='white-space:nowrap'>".$resValue."</span>";

	return $resValue;
}

function getNameValueYaTidak($number) {
	$number = (int)$number;
	$arrValue = array("0"=>"Tidak", "1"=>"Ya");
	return $arrValue[$number];
}

function getNameValueKategori($number) {
	$number = (int)$number;
	$arrValue = array("1"=>"Sangat Baik", "2"=>"Baik", "3"=>"Cukup", "4"=>"Kurang");
	return $arrValue[$number];
}	

function getNameValue($number) {
	$number = (int)$number;
	$arrValue = array("0"=>"Tidak", "1"=>"Ya");
	return $arrValue[$number];
}	

function getNameValueAktif($number) {
	$number = (int)$number;
	$arrValue = array("0"=>"Tidak Aktif", "1"=>"Aktif");
	return $arrValue[$number];
}

function getNameValidasi($number) {
	$number = (int)$number;
	$arrValue = array("0"=>"Menunggu Konfirmasi","1"=>"Disetujui", "2"=>"Ditolak");
	return $arrValue[$number];
}	

function getNameInputOutput($char) {
	$arrValue = array("I"=>"Datang", "O"=>"Pulang");
	return $arrValue[$char];
}		
	
function dotToComma($varId)
{
	$newId = str_replace(".", ",", $varId);	
	return $newId;
}

function CommaToQuery($varId)
{
	$newId = str_replace(",", "','", $varId);	
	return $newId;
}


function CommaToDot($varId)
{
	$newId = str_replace(",", ".", $varId);	
	return $newId;
}

function dotToNo($varId)
{
	$newId = str_replace(".", "", $varId);	
	$newId = str_replace(",", ".", $newId);	
	return $newId;
}
function CommaToNo($varId)
{
	$newId = str_replace(",", "", $varId);	
	return $newId;
}

function CrashToNo($varId)
{
	$newId = str_replace("#", "", $varId);	
	return $newId;
}

function StarToNo($varId)
{
	$newId = str_replace("* ", "", $varId);	
	return $newId;
}

function NullDotToNo($varId)
{
	$newId = str_replace(".00", "", $varId);
	return $newId;
}

function ExcelToNo($varId)
{
	$newId = NullDotToNo($varId);
	$newId = StarToNo($newId);
	return $newId;
}

function ValToNo($varId)
{
	$newId = NullDotToNo($varId);
	$newId = CommaToNo($newId);
	$newId = StarToNo($newId);
	return $newId;
}

function ValToNull($varId)
{
	if($varId == '')
		return 0;
	else
		return $varId;
}

function ValToNullMenit($varId)
{
	if($varId == '')
		return 00;
	else
		return $varId;
}

function ValToNullDB($varId)
{
	if($varId == '')
		return 'NULL';
	elseif($varId == 'null')
		return 'NULL';
	else
		return "'".$varId."'";
}

function setQuote($var, $status='')
{	
	if($status == 1)
		$tmp= str_replace("\'", "''", $var);
	else
		$tmp= str_replace("'", "''", $var);
	return $tmp;
}

// fungsi untuk generate nol untuk melengkapi digit

function generateZero($varId, $digitGroup, $digitCompletor = "0")
{
	$newId = "";
	
	$lengthZero = $digitGroup - strlen($varId);
	
	for($i = 0; $i < $lengthZero; $i++)
	{
		$newId .= $digitCompletor;
	}
	
	$newId = $newId.$varId;
	
	return $newId;
}

// truncate text into desired word counts.
// to support dropDirtyHtml function, include default.func.php
function truncate($text, $limit, $dropDirtyHtml=true)
{
	$tmp_truncate = array();
	$text = str_replace("&nbsp;", " ", $text);
	$tmp = explode(" ", $text);
	
	for($i = 0; $i <= $limit; $i++)		//truncate how many words?
	{
		$tmp_truncate[$i] = $tmp[$i];
	}
	
	$truncated = implode(" ", $tmp_truncate);
	
	if ($dropDirtyHtml == true and function_exists('dropAllHtml'))
		return ($truncated);
	else
		return $truncated;
}

function arrayMultiCount($array, $field_name, $search)
{
	$summary = 0;
	for($i = 0; $i < count($array); $i++)
	{
		if($array[$i][$field_name] == $search)
			$summary += 1;
	}
	return $summary;
}

function getValueArray($var)
{
	//$tmp = "";
	for($i=0;$i<count($var);$i++)
	{			
		if($i == 0)
			$tmp .= $var[$i];
		else
			$tmp .= ",".$var[$i];
	}
	
	return $tmp;
}

function getValueArrayMonth($var)
{
	//$tmp = "";
	for($i=0;$i<count($var);$i++)
	{			
		if($i == 0)
			$tmp .= "'".$var[$i]."'";
		else
			$tmp .= ", '".$var[$i]."'";
	}
	
	return $tmp;
}

function getColoms($var)
{
	$tmp = "";
	if($var == 0)	$tmp = 'D';
	elseif($var == 1)	$tmp = 'E';
	elseif($var == 2)	$tmp = 'F';
	elseif($var == 3)	$tmp = 'G';
	elseif($var == 4)	$tmp = 'H';
	elseif($var == 5)	$tmp = 'I';
	elseif($var == 6)	$tmp = 'J';
	elseif($var == 7)	$tmp = 'K';
	
	return $tmp;
}

function setNULL($var)
{	
	if($var == '')
		$tmp = 'NULL';
	else
		$tmp = $var;
	
	return $tmp;
}

function setNULLModif($var)
{	
	if($var == '')
		$tmp = 'NULL';
	else
		$tmp = "'".$var."'";
	
	return $tmp;
}

function setVal_0($var)
{	
	if($var == '')
		$tmp = '0';
	else
		$tmp = $var;
	
	return $tmp;
}

function get_null_10($varId)
{
	if($varId == '') return '';
	if($varId < 10)	$temp= '0'.$varId;
	else			$temp= $varId;
			
	return $temp;
}

function _ip( )
{
    return ( preg_match( "/^([d]{1,3}).([d]{1,3}).([d]{1,3}).([d]{1,3})$/", $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'] );
}

function getFotoProfile($id)
{
	$filename = "uploads/foto/profile-".$id.".jpg";
	if (file_exists($filename)) {
	} else {
		$filename = "images/foto-profile.png";
	}	
	return $filename;
}

/*function getFotoProfile($id)
{
	$filename = "uploads/foto/profile-".$id.".jpg";
	if (file_exists($filename)) {
	} else {
		$filename = "images/foto-profile.jpg";
	}	
	return $filename;
}*/
function toNumber($varId)
{	
	return (float)$varId;
}

function searchWordDelimeter($varSource, $varSearch, $varDelimeter=",")
{

	$arrSource = explode($varDelimeter, $varSource);
	
	for($i=0; $i<count($arrSource);$i++)
	{
		if(trim($arrSource[$i]) == $varSearch)
			return true;
	}
	
	return false;
}

function getZodiac($day,$month){
	if(($month==1 && $day>20)||($month==2 && $day<20)){
	$mysign = "Aquarius";
	}
	if(($month==2 && $day>18 )||($month==3 && $day<21)){
	$mysign = "Pisces";
	}
	if(($month==3 && $day>20)||($month==4 && $day<21)){
	$mysign = "Aries";
	}
	if(($month==4 && $day>20)||($month==5 && $day<22)){
	$mysign = "Taurus";
	}
	if(($month==5 && $day>21)||($month==6 && $day<22)){
	$mysign = "Gemini";
	}
	if(($month==6 && $day>21)||($month==7 && $day<24)){
	$mysign = "Cancer";
	}
	if(($month==7 && $day>23)||($month==8 && $day<24)){
	$mysign = "Leo";
	}
	if(($month==8 && $day>23)||($month==9 && $day<24)){
	$mysign = "Virgo";
	}
	if(($month==9 && $day>23)||($month==10 && $day<24)){
	$mysign = "Libra";
	}
	if(($month==10 && $day>23)||($month==11 && $day<23)){
	$mysign = "Scorpio";
	}
	if(($month==11 && $day>22)||($month==12 && $day<23)){
	$mysign = "Sagitarius";
	}
	if(($month==12 && $day>22)||($month==1 && $day<21)){
	$mysign = "Capricorn";
	}
	return $mysign;
}

function getValueANDOperator($var)
{
	$tmp = ' AND ';
	
	return $tmp;
}

function getValueKoma($var)
{
	if($var == '')
		$tmp = '';
	else
		$tmp = ',';	
	
	return $tmp;
}

function import_format($val)
{
	if($val == ":02")
	{
		$temp= str_replace(":02","24:00",$val);
	}
	else
	{	
		$temp="";
		if($val == "[hh]:mm" || $val == "[h]:mm"){}
		else
			$temp= $val;
	}
	return $temp;
	//return $val;
}

function kekata($x) 
{
	$x = abs($x);
	$angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($x <12) 
	{
		$temp = " ". $angka[$x];
	} 
	else if ($x <20) 
	{
		$temp = kekata($x - 10). " belas";
	} 
	else if ($x <100) 
	{
		$temp = kekata($x/10)." puluh". kekata($x % 10);
	} 
	else if ($x <200) 
	{
		$temp = " seratus" . kekata($x - 100);
	} 
	else if ($x <1000) 
	{
		$temp = kekata($x/100) . " ratus" . kekata($x % 100);
	} 
	else if ($x <2000) 
	{
		$temp = " seribu" . kekata($x - 1000);
	} 
	else if ($x <1000000) 
	{
		$temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
	} 
	else if ($x <1000000000) 
	{
		$temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
	} 
	else if ($x <1000000000000) 
	{
		$temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
	} 
	else if ($x <1000000000000000) 
	{
		$temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
	}      
	
	return $temp;
}

function terbilang($x, $style=4) 
{
	if($x < 0) 
	{
		$hasil = "minus ". trim(kekata($x));
	} 
	else 
	{
		$hasil = trim(kekata($x));
	}      
	switch ($style) 
	{
		case 1:
			$hasil = strtoupper($hasil);
			break;
		case 2:
			$hasil = strtolower($hasil);
			break;
		case 3:
			$hasil = ucwords($hasil);
			break;
		default:
			$hasil = ucfirst($hasil);
			break;
	}      
	return $hasil;
}

function romanic_number($integer, $upcase = true)
{
    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
    $return = '';
    while($integer > 0)
    {
        foreach($table as $rom=>$arb)
        {
            if($integer >= $arb)
            {
                $integer -= $arb;
                $return .= $rom;
                break;
            }
        }
    }

    return $return;
}

function getExe($tipe)
{
	switch ($tipe) {
	  case "application/pdf": $ctype="pdf"; break;
	  case "application/octet-stream": $ctype="exe"; break;
	  case "application/zip": $ctype="zip"; break;
	  case "application/msword": $ctype="doc"; break;
	  case "application/vnd.ms-excel": $ctype="xls"; break;
	  case "application/vnd.ms-powerpoint": $ctype="ppt"; break;
	  case "image/gif": $ctype="gif"; break;
	  case "image/png": $ctype="png"; break;
	  case "image/jpeg": $ctype="jpeg"; break;
	  case "image/jpg": $ctype="jpg"; break;
	  case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet": $ctype="xlsx"; break;
	  case "application/vnd.openxmlformats-officedocument.wordprocessingml.document": $ctype="docx"; break;
	  default: $ctype="application/force-download";
	} 
	
	return $ctype;
} 

function getExtension($varSource)
{
	$temp = explode(".", $varSource);
	return end($temp);
}


function coalesce($varSource, $varReplace)
{
	if($varSource == "")
		return $varReplace;
		
	return $varSource;
}

function getconcatseparator($var, $vadd, $separator=",")
{
	$vreturn= "";
	if(empty($var))
		$vreturn = $vadd;
	else
	{
		$vreturn = $var.$separator.$vadd;
	}

	return $vreturn;
}

function unserialized($serialized)
{
	$arrSerialized = str_replace('@', '"', $serialized);			
	return unserialize($arrSerialized);
}



function translate($id, $en)
{
	if($_SESSION["lang"] == "en")
		return $en;	
	else
		return $id;
}

function getBahasa()
{
	if($_SESSION["lang"] == "en")
		return "en";	
	else
		return "";
}

function getTerbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return getTerbilang($x - 10) . " belas";
  elseif ($x < 100)
    return getTerbilang($x / 10) . " puluh" . getTerbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . getTerbilang($x - 100);
  elseif ($x < 1000)
    return getTerbilang($x / 100) . " ratus" . getTerbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . getTerbilang($x - 1000);
  elseif ($x < 1000000)
    return getTerbilang($x / 1000) . " ribu" . getTerbilang($x % 1000);
  elseif ($x < 1000000000)
    return getTerbilang($x / 1000000) . " juta" . getTerbilang($x % 1000000);
}


function renameFile($varSource)
{
	$varSource = str_replace(" ", "_",$varSource);
	$varSource = str_replace("'", "", $varSource);
	return $varSource;
}

function getColumnExcel($var)
{
	$var = strtoupper($var);
	if($var == "")
		return 0;
		
	if($var == "A")	$tmp = 1;
	elseif($var == "B")	$tmp = 2;
	elseif($var == "C")	$tmp = 3;
	elseif($var == "D")	$tmp = 4;
	elseif($var == "E")	$tmp = 5;
	elseif($var == "F")	$tmp = 6;
	elseif($var == "G")	$tmp = 7;
	elseif($var == "H")	$tmp = 8;
	elseif($var == "I")	$tmp = 9;
	elseif($var == "J")	$tmp = 10;
	elseif($var == "K")	$tmp = 11;
	elseif($var == "L")	$tmp = 12;
	elseif($var == "M")	$tmp = 13;
	elseif($var == "N")	$tmp = 14;
	elseif($var == "0")	$tmp = 15;
	elseif($var == "P")	$tmp = 16;
	elseif($var == "Q")	$tmp = 17;
	elseif($var == "R")	$tmp = 18;
	elseif($var == "S")	$tmp = 19;
	elseif($var == "T")	$tmp = 20;
	
	return $tmp;
}

function terbilang_en($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'terbilang_en only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . terbilang_en(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . terbilang_en($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = terbilang_en($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= terbilang_en($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

function decimalNumber($num2)
{
	if(strpos($num2, '.'))
		return number_format($num2, 2, '.', '');	
	
	return $num2;
}

function harcodemenu($userstatuspegId)
{

	if ($userstatuspegId == 1 || $userstatuspegId == 2)
	{

		$arrdata= array(
		  array("MENU_ID"=>"01", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Utama", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "Identitas Pegawai", "LINK_FILE"=>"pegawai_data", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "SK CPNS", "LINK_FILE"=>"pegawai_sk_cpns", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "SK PNS", "LINK_FILE"=>"pegawai_sk_pns", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  , array("MENU_ID"=>"02", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Riwayat", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Pangkat/Golongan", "LINK_FILE"=>"pegawai_pangkat", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Jabatan", "LINK_FILE"=>"pegawai_jabatan_tipe", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Gaji", "LINK_FILE"=>"pegawai_gaji", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Pendidikan", "LINK_FILE"=>"riwayat_pendidikan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Diklat Struktural", "LINK_FILE"=>"pegawai_diklat", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Kursus", "LINK_FILE"=>"pegawai_kursus", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat SKP", "LINK_FILE"=>"pegawai_skp", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Peninjauan Masa Kerja", "LINK_FILE"=>"tambahan_masa_kerja", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		
		  , array("MENU_ID"=>"03", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Keluarga", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Orang Tua", "LINK_FILE"=>"pegawai_orang_tua", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Suami/Istri", "LINK_FILE"=>"pegawai_suami_istri", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Anak", "LINK_FILE"=>"pegawai_anak", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  , array("MENU_ID"=>"04", "MENU_PARENT_ID"=>"0", "NAMA"=> "Lain Lain", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Organisasi", "LINK_FILE"=>"pegawai_organisasi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penghargaan", "LINK_FILE"=>"pegawai_penghargaan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		 // , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penilaian Potensi Diri", "LINK_FILE"=>"pegawai_penilaian_potensi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Hukuman", "LINK_FILE"=>"pegawai_hukuman", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Cuti", "LINK_FILE"=>"pegawai_cuti", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		);

	}
	else if ($userstatuspegId == 4 || $userstatuspegId == 5)
	{

		$arrdata= array(
		  array("MENU_ID"=>"01", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Utama", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "Identitas Pegawai", "LINK_FILE"=>"pegawai_data", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  , array("MENU_ID"=>"02", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Riwayat", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Kontrak", "LINK_FILE"=>"pegawai_riwayat_kontrak", "AKSES"=>"", "JUMLAH_CHILD"=>0)	  
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Jabatan", "LINK_FILE"=>"pegawai_jabatan_tipe", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  //, array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Jabatan", "LINK_FILE"=>"pegawai_jabatan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Gaji", "LINK_FILE"=>"pegawai_gaji", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		 // , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Pendidikan Umum", "LINK_FILE"=>"pendidikan_umum", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Pendidikan", "LINK_FILE"=>"riwayat_pendidikan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Diklat Struktural", "LINK_FILE"=>"pegawai_diklat", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Kursus", "LINK_FILE"=>"pegawai_kursus", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  //, array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Penilaian Prestasi Kerja (SKP)", "LINK_FILE"=>"pegawai_penilaian_prestasi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat SKP", "LINK_FILE"=>"pegawai_skp", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Peninjauan Masa Kerja", "LINK_FILE"=>"tambahan_masa_kerja", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  

		  , array("MENU_ID"=>"03", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Keluarga", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Orang Tua", "LINK_FILE"=>"pegawai_orang_tua", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Suami/Istri", "LINK_FILE"=>"pegawai_suami_istri", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Anak", "LINK_FILE"=>"pegawai_anak", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  , array("MENU_ID"=>"04", "MENU_PARENT_ID"=>"0", "NAMA"=> "Lain Lain", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Organisasi", "LINK_FILE"=>"pegawai_organisasi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penghargaan", "LINK_FILE"=>"pegawai_penghargaan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		 // , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penilaian Potensi Diri", "LINK_FILE"=>"pegawai_penilaian_potensi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Hukuman", "LINK_FILE"=>"pegawai_hukuman", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Cuti", "LINK_FILE"=>"pegawai_cuti", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  //, array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penguasaan Bahasa", "LINK_FILE"=>"pegawai_bahasa", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  );

	}
	else
	{
		$arrdata= array(
		  array("MENU_ID"=>"01", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Utama", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "Identitas Pegawai", "LINK_FILE"=>"pegawai_data", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "SK CPNS", "LINK_FILE"=>"pegawai_sk_cpns", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "SK PNS", "LINK_FILE"=>"pegawai_sk_pns", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  , array("MENU_ID"=>"02", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Riwayat", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Pangkat/Golongan", "LINK_FILE"=>"pegawai_pangkat", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		 // , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Jabatan", "LINK_FILE"=>"pegawai_jabatan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		   , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Jabatan", "LINK_FILE"=>"pegawai_jabatan_tipe", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Gaji", "LINK_FILE"=>"pegawai_gaji", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Pendidikan Umum", "LINK_FILE"=>"pendidikan_umum", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Pendidikan", "LINK_FILE"=>"riwayat_pendidikan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Diklat Struktural", "LINK_FILE"=>"pegawai_diklat", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Kursus", "LINK_FILE"=>"pegawai_kursus", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		
		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Tambahkan Masa Kerja", "LINK_FILE"=>"tambahan_masa_kerja", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		 

		  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Kontrak", "LINK_FILE"=>"pegawai_riwayat_kontrak", "AKSES"=>"", "JUMLAH_CHILD"=>0)	  
		  

		  , array("MENU_ID"=>"03", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Keluarga", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Orang Tua", "LINK_FILE"=>"pegawai_orang_tua", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Suami/Istri", "LINK_FILE"=>"pegawai_suami_istri", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Anak", "LINK_FILE"=>"pegawai_anak", "AKSES"=>"", "JUMLAH_CHILD"=>0)

		  , array("MENU_ID"=>"04", "MENU_PARENT_ID"=>"0", "NAMA"=> "Lain Lain", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Organisasi", "LINK_FILE"=>"pegawai_organisasi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penghargaan", "LINK_FILE"=>"pegawai_penghargaan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penilaian Potensi Diri", "LINK_FILE"=>"pegawai_penilaian_potensi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penilaian Prestasi Kerja (SKP)", "LINK_FILE"=>"pegawai_penilaian_prestasi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "SKP", "LINK_FILE"=>"pegawai_skp", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Hukuman", "LINK_FILE"=>"pegawai_hukuman", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Cuti", "LINK_FILE"=>"pegawai_cuti", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  //, array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penguasaan Bahasa", "LINK_FILE"=>"pegawai_bahasa", "AKSES"=>"", "JUMLAH_CHILD"=>0)
		  );
	}
	

	return $arrdata;
}



function harcodemenuadmin()
{
	$arrdata= array(
	  array("MENU_ID"=>"01", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Utama", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
	  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "Identitas Pegawai", "LINK_FILE"=>"pegawai_data", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "SK CPNS", "LINK_FILE"=>"pegawai_sk_cpns", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0101", "MENU_PARENT_ID"=>"01", "NAMA"=> "SK PNS", "LINK_FILE"=>"pegawai_sk_pns", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"02", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Riwayat", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Pangkat/Golongan", "LINK_FILE"=>"pegawai_pangkat", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Jabatan", "LINK_FILE"=>"pegawai_jabatan_tipe", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  //, array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Jabatan", "LINK_FILE"=>"pegawai_jabatan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Gaji", "LINK_FILE"=>"pegawai_gaji", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  //, array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Pendidikan Umum", "LINK_FILE"=>"pendidikan_umum", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Pendidikan", "LINK_FILE"=>"riwayat_pendidikan", "AKSES"=>"", "JUMLAH_CHILD"=>0)


	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Diklat ", "LINK_FILE"=>"pegawai_diklat", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Kursus", "LINK_FILE"=>"pegawai_kursus", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat SKP", "LINK_FILE"=>"pegawai_skp", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Tambahkan Masa Kerja", "LINK_FILE"=>"tambahan_masa_kerja", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	   

	   , array("MENU_ID"=>"0201", "MENU_PARENT_ID"=>"02", "NAMA"=> "Riwayat Kontrak", "LINK_FILE"=>"pegawai_riwayat_kontrak", "AKSES"=>"", "JUMLAH_CHILD"=>0)

	  , array("MENU_ID"=>"03", "MENU_PARENT_ID"=>"0", "NAMA"=> "Data Keluarga", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
	  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Orang Tua", "LINK_FILE"=>"pegawai_orang_tua", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Suami/Istri", "LINK_FILE"=>"pegawai_suami_istri", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0301", "MENU_PARENT_ID"=>"03", "NAMA"=> "Anak", "LINK_FILE"=>"pegawai_anak", "AKSES"=>"", "JUMLAH_CHILD"=>0)

	  , array("MENU_ID"=>"04", "MENU_PARENT_ID"=>"0", "NAMA"=> "Lain Lain", "LINK_FILE"=>"", "AKSES"=>"", "JUMLAH_CHILD"=>1)
	  //, array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "SKP", "LINK_FILE"=>"pegawai_skp", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Organisasi", "LINK_FILE"=>"pegawai_organisasi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penghargaan", "LINK_FILE"=>"pegawai_penghargaan", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  //, array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penilaian Potensi Diri", "LINK_FILE"=>"pegawai_penilaian_potensi", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  
	  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Hukuman", "LINK_FILE"=>"pegawai_hukuman", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  , array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Cuti", "LINK_FILE"=>"pegawai_cuti", "AKSES"=>"", "JUMLAH_CHILD"=>0)
	  //, array("MENU_ID"=>"0401", "MENU_PARENT_ID"=>"04", "NAMA"=> "Penguasaan Bahasa", "LINK_FILE"=>"pegawai_bahasa", "AKSES"=>"", "JUMLAH_CHILD"=>0)

	 

	);
	return $arrdata;
}



function json_response($code = 200, $message = null)
{
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message
        ));
}

function infostatuspegawai()
{
	$arrField= array(
	  array("id"=>"AND STATUS_PEGAWAI = 0", "nama"=>"Usulan")
	  , array("id"=>"AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2 OR STATUS_PEGAWAI = 5)", "nama"=>"AKTIF")
	  , array("id"=>"AND STATUS_PEGAWAI = 1", "nama"=>"CPNS")
	  , array("id"=>"AND STATUS_PEGAWAI = 2", "nama"=>"PNS")
	  , array("id"=>"AND STATUS_PEGAWAI = 3", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	  , array("id"=>"1", "nama"=>"Pulang")
	);
	return $arrField;
}

function queryfiltervalid()
{
	$arrField="AND A.SATKER_ID IN  (
                SELECT C.SATKER_ID 
                FROM validasi.anak A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.bahasa A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.cuti A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.diklat_fungsional A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.diklat_struktural A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.diklat_teknis A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.gaji_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.hukuman A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.jabatan_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.kursus A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.organisasi_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.pangkat_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.penataran A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.pendidikan_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.pengalaman A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.penghargaan A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.penilaian A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.potensi_diri A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.prestasi_kerja A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.saudara A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.seminar A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.sk_cpns A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.sk_pns A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.tambahan_masa_kerja A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.suami_istri A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.orang_tua A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.mertua A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.tugas A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.PEGAWAI A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID )" ;
	return $arrField;
}


function isStrContain($string, $keyword)
{
	if (empty($string) || empty($keyword)) return false;
	$keyword_first_char = $keyword[0];
	$keyword_length = strlen($keyword);
	$string_length = strlen($string);
	
	// case 1
	if ($string_length < $keyword_length) return false;
	
	// case 2
	if ($string_length == $keyword_length) {
	  if ($string == $keyword) return true;
	  else return false;
	}
	
	// case 3
	if ($keyword_length == 1) {
	  for ($i = 0; $i < $string_length; $i++) {
	
		// Check if keyword's first char == string's first char
		if ($keyword_first_char == $string[$i]) {
		  return true;
		}
	  }
	}
	
	// case 4
	if ($keyword_length > 1) {
	  for ($i = 0; $i < $string_length; $i++) {
		/*
		the remaining part of the string is equal or greater than the keyword
		*/
		if (($string_length + 1 - $i) >= $keyword_length) {
	
		  // Check if keyword's first char == string's first char
		  if ($keyword_first_char == $string[$i]) {
			$match = 1;
			for ($j = 1; $j < $keyword_length; $j++) {
			  if (($i + $j < $string_length) && $keyword[$j] == $string[$i + $j]) {
				$match++;
			  }
			  else {
				return false;
			  }
			}
	
			if ($match == $keyword_length) {
			  return true;
			}
	
			// end if first match found
		  }
	
		  // end if remaining part
		}
		else {
		  return false;
		}
	
		// end for loop
	  }
	
	  // end case4
	}
	
	return false;
}

function ucAddress($str) {

    // first lowercase all and use the default ucwords
    $str = ucwords(strtolower($str));

    // let's fix the default ucwords...
    // uppercase letters after house number (was lowercased by the strtolower above)
    $str = mb_eregi_replace('\b([0-9]{1,4}[a-z]{1,2})\b', "strtoupper('\\1')", $str, 'e');

    // the same for roman numerals
    $str = mb_eregi_replace('\bM{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})\b', "strtoupper('\\0')", $str, 'e');
	
	$str= str_replace("Sdn", "SDN", $str);
	$str= str_replace("Tk", "TK", $str);
	$str= str_replace("Smp", "SMP", $str);
	$str= str_replace("SMPn", "SMPN", $str);
	$str= str_replace("Sma", "SMA", $str);
	$str= str_replace("SMAn", "SMAN", $str);
	$str= str_replace("Smk", "SMK", $str);
	
	$str= str_replace("Rsud", "RSUD", $str);
	$str= str_replace("Dr", "dr", $str);
	$str= str_replace("Dprd", "DPRD", $str);
	
	$str= str_replace("Uptd", "UPTD", $str);
	$str= str_replace("Dan", "dan", $str);
    return $str;
}

function getFipNama($var)
{
   if('PEGAWAI' == $var)
    return 'FIP - 01, Identitas Pegawai';
   elseif('PENGALAMAN' == $var)
    return 'FIP - 01, Pengalaman Kerja';
   elseif('SK_CPNS' == $var)
    return 'FIP - 01, SK CPNS';
   elseif('SK_PNS' == $var)
    return 'FIP - 01, SK PNS';
   elseif('PANGKAT_RIWAYAT' == $var)
    return 'FIP - 02, Riwayat Pangkat';
   elseif('JABATAN_RIWAYAT' == $var)
    return 'FIP - 02, Riwayat Jabatan';
   elseif('GAJI_RIWAYAT' == $var)
    return 'FIP - 02, Riwayat Gaji';
   elseif('PENDIDIKAN_RIWAYAT' == $var)
    return 'FIP - 02, Pendidikan Umum';
   elseif('DIKLAT_STRUKTURAL' == $var)
    return 'FIP - 02, Diklat Struktural';
   elseif('DIKLAT_FUNGSIONAL' == $var)
    return 'FIP - 02, Diklat Fungsional';
   elseif('DIKLAT_TEKNIS' == $var)
    return 'FIP - 02, Diklat Teknis';
   elseif('DIKLAT_LPJ' == $var)
    return 'FIP - 02, Diklat Lpj';
   elseif('PENATARAN_SEMINAR' == $var)
    return 'FIP - 02, Penataran';
   elseif('SEMINAR' == $var)
    return 'FIP - 02, Seminar';
   elseif('KURSUS' == $var)
    return 'FIP - 02, Kursus Umum';
   elseif('KURSUS_KHUSUS' == $var)
    return 'FIP - 02, Kursus Khusus';
   elseif('ORANG_TUA' == $var)
    return 'FIP - 02, Orang Tua';
   elseif('MERTUA' == $var)
    return 'FIP - 02, Mertua';
   elseif('SUAMI_ISTRI' == $var)
    return 'FIP - 02, Suami Istri';
   elseif('ANAK' == $var)
    return 'FIP - 02, Anak';
   elseif('SAUDARA' == $var)
    return 'FIP - 02, Saudara';
   elseif('ORGANISASI_RIWAYAT' == $var)
    return 'FIP - 02, Organisasi';
   elseif('PENGHARGAAN' == $var)
    return 'FIP - 02, Penghargaan';
   elseif('PENILAIAN' == $var)
    return 'FIP - 02, Penilaian DP-3';
   elseif('PENILAIAN_KERJA' == $var)
    return 'Lain-lain, Penilaian Prestasi Kerja (SKP)';
   elseif('POTENSI_DIRI' == $var)
    return 'FIP - 02, Penilaian Potensi Diri';
   elseif('PRESTASI_KERJA' == $var)
    return 'FIP - 02, Catatan Prestasi';
   elseif('HUKUMAN' == $var)
    return 'FIP - 02, Hukuman';
   elseif('CUTI' == $var)
    return 'FIP - 02, Cuti';
   elseif('TUGAS' == $var)
    return 'FIP - 02, Riwayat Penugasan';
   elseif('BAHASA' == $var)
    return 'FIP - 02, Penguasaan Bahasa';
   elseif('NIKAH_RIWAYAT' == $var)
    return 'FIP - 02, Nikah';
   elseif('TAMBAHAN_MASA_KERJA' == $var)
    return 'FIP - 02, Tambahkan Masa Kerja';
}


function setLogInfo($mode, $namaUser, $namaTable)
{
	if($mode == "insert")
		return $namaUser." telah menambah ".getFipNama($namaTable).$statement." pada tanggal ".date('d-m-Y H:i:s');
	elseif($mode == "update")
		return $namaUser." telah merubah ".getFipNama($namaTable).$statement." pada tanggal ".date('d-m-Y H:i:s');
	elseif($mode == "delete")
		return $namaUser." telah menghapus ".getFipNama($namaTable).$statement." pada tanggal ".date('d-m-Y H:i:s');
}

function getColomsNew($var)
{
	$tmp = "";
	if($var == 1)	$tmp = 'A';
	elseif($var == 2)	$tmp = 'B';
	elseif($var == 3)	$tmp = 'C';
	elseif($var == 4)	$tmp = 'D';
	elseif($var == 5)	$tmp = 'E';
	elseif($var == 6)	$tmp = 'F';
	elseif($var == 7)	$tmp = 'G';
	elseif($var == 8)	$tmp = 'H';
	elseif($var == 9)	$tmp = 'I';
	elseif($var == 10)	$tmp = 'J';
	elseif($var == 11)	$tmp = 'K';
	elseif($var == 12)	$tmp = 'L';
	elseif($var == 13)	$tmp = 'M';
	elseif($var == 14)	$tmp = 'N';
	elseif($var == 15)	$tmp = 'O';
	elseif($var == 16)	$tmp = 'P';
	elseif($var == 17)	$tmp = 'Q';
	elseif($var == 18)	$tmp = 'R';
	elseif($var == 19)	$tmp = 'S';
	elseif($var == 20)	$tmp = 'T';
	elseif($var == 21)	$tmp = 'U';
	elseif($var == 22)	$tmp = 'V';
	elseif($var == 23)	$tmp = 'W';
	elseif($var == 24)	$tmp = 'X';
	elseif($var == 25)	$tmp = 'Y';
	elseif($var == 26)	$tmp = 'Z';
	elseif($var == 27)	$tmp = 'AA';
	elseif($var == 28)	$tmp = 'AB';
	elseif($var == 29)	$tmp = 'AC';
	elseif($var == 30)	$tmp = 'AD';
	elseif($var == 31)	$tmp = 'AE';
	elseif($var == 32)	$tmp = 'AF';
	elseif($var == 33)	$tmp = 'AG';
	elseif($var == 34)	$tmp = 'AH';
	elseif($var == 35)	$tmp = 'AI';
	elseif($var == 36)	$tmp = 'AJ';
	elseif($var == 37)	$tmp = 'AK';
	elseif($var == 38)	$tmp = 'AL';
	elseif($var == 39)	$tmp = 'AM';
	elseif($var == 40)	$tmp = 'AN';
	elseif($var == 41)	$tmp = 'AO';
	elseif($var == 42)	$tmp = 'AP';
	elseif($var == 43)	$tmp = 'AQ';
	elseif($var == 44)	$tmp = 'AR';
	elseif($var == 45)	$tmp = 'AS';
	elseif($var == 46)	$tmp = 'AT';
	elseif($var == 47)	$tmp = 'AU';
	elseif($var == 48)	$tmp = 'AV';
	elseif($var == 49)	$tmp = 'AW';
	elseif($var == 50)	$tmp = 'AX';
	elseif($var == 51)	$tmp = 'AY';
	elseif($var == 52)	$tmp = 'AZ';
	elseif($var == 53)	$tmp = 'BA';
	elseif($var == 54)	$tmp = 'BB';
	elseif($var == 55)	$tmp = 'BC';
	elseif($var == 56)	$tmp = 'BD';
	
	return $tmp;
}

function churuf($x, $style=3) 
{
	$hasil = $x;

	switch ($style) 
	{
		case 1:
			$hasil = strtoupper($hasil);
			break;
		case 2:
			$hasil = strtolower($hasil);
			break;
		case 3:
			$hasil = ucwords($hasil);
			break;
		default:
			$hasil = ucfirst($hasil);
			break;
	}      
	return $hasil;
}

function toAlpha($data){
    $alphabet =   array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $alpha_flip = array_flip($alphabet);
        if($data <= 25){
          return $alphabet[$data];
        }
        elseif($data > 25){
          $dividend = ($data + 1);
          $alpha = '';
          $modulo;
          while ($dividend > 0){
            $modulo = ($dividend - 1) % 26;
            $alpha = $alphabet[$modulo] . $alpha;
            $dividend = floor((($dividend - $modulo) / 26));
          } 
          return $alpha;
        }

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sfvalidateip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}

function sfgetipaddress() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                // trim for safety measures
                $ip = trim($ip);
                // attempt to validate IP
                if (sfvalidateip($ip)) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
}

function sfgetmac()
{
	// echo sfgetipaddress();exit;
	// $vmac= exec('getmac');
	// echo "adasd".$vmac;exit;
	// $vmac= str_replace("-", "", strtok($vmac, ' '));
	return $vmac;
}

function vgethostname()
{
    if(isset($_SERVER['HTTP_HOST'])) {
        $host = $_SERVER['HTTP_HOST'];
    } else {
        $host = $_SERVER['SERVER_NAME'];
    }
    return $host;
}

function checkFile($tipe,$jenis)
{
	$acceptable = array();

	if($jenis==1)
	{
		//gambar
		$acceptable = array(
			'image/jpeg'
			,'image/png'
		);
	}
	else if($jenis==2)
	{
		//dokumen
		$acceptable = array(
			'application/pdf' //pdf
			,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' // xlsx
			,'application/vnd.ms-excel' // xls
			,'application/msword' //doc
			,'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // docx
		);
	}
	else if($jenis==3)
	{
		//all
		$acceptable = array(
			'application/pdf' //pdf
			,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' // xlsx
			,'application/vnd.ms-excel' // xls
			,'application/msword' //doc
			,'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // docx
			,'image/jpeg'
			,'image/png'
		);
	}
	else
	{
		$acceptable = array(
			'application/pdf'
		);
	}
	
	if((in_array($tipe, $acceptable))) {
		return true;
	}
	else
	{
		return false;
	}
}


// <option value=''></option>
//         <option value='' selected='selected'></option>
//         <option value=''></option>
//         <option value=''></option>
//         <option value=''>Pensiun</option>
//         <option value='AND STATUS_PEGAWAI = 9'>MPP</option>
//         <option value='AND STATUS_PEGAWAI = 4'>TNI</option>
//         <option value='AND (STATUS_PEGAWAI = 5 OR STATUS_PEGAWAI = 6)'>Meninggal Dunia</option>
//         <option value='AND STATUS_PEGAWAI = 7'>Pindah</option>
//         <option value='AND STATUS_PEGAWAI = 8'>Diberhentikan</option>
//         <option value='AND STATUS_PEGAWAI = 10'>Mengundurkan diri</option>
?>