<? 
include_once(APPPATH.'/models/Entity.php');

class Pensiun extends Entity{ 

	var $query;

	function Pensiun()
	{
		$this->Entity(); 
	}

	function callPensiun()
	{
        $str = "
        select pinsertpensiun('".$this->getField("PERIODE")."', '".$this->getField("SATKERID")."', '".$this->getField("USER_APP_ID")."')
		";
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY TANGGAL_PENSIUN ASC")
	{
		$str = "
		SELECT
			B.TIPE_PEGAWAI_ID, A.STATUS, A.PERIODE, A.PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU, A.NAMA, NO_BKN, A.TANGGAL_BKN
			, A.SK_PENSIUN, A.TANGGAL_PENSIUN, A.TMT_PENSIUN, A.TMT_CPNS, A.TANGGAL_LAHIR, A.JENIS_KELAMIN
			,  A.GOL_RUANG, A.ESELON, A.JABATAN, A.ALAMAT, A.MASA_KERJA, A.USIA, A.USIA_TAHUN, A.USIA_BATAS, A.SATKER_ID
		FROM pensiun A
		INNER JOIN pegawai B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
		WHERE 1=1
		";
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }
	
} 
?>