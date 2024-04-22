<? 
include_once(APPPATH.'/models/Entity.php');

class Kgb extends Entity{ 

	var $query;

	function Kgb()
	{
		$this->Entity(); 
	}

	function callKGB()
	{
        $str = "
        select pinsertkgb('".$this->getField("PERIODE")."', '".$this->getField("SATKERID")."')
		";
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY PANGKAT_ID DESC")
	{
		$str = "
		SELECT
			A.*
		FROM kgb A
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

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT 
                DISTINCT
				   SUBSTR(a.SATKER_ID,0,2) SATKER_ID_PARENT,
				   -- HUKUMAN_KGB(A.PEGAWAI_ID) HUKUMAN_STATUS_TERAKHIR,
                   AMBIL_SATKER_INDUK(D.SATKER_ID) SATKER_INDUK, 
                   AMBIL_SATKER_ALAMAT(D.SATKER_ID) SATKER_ALAMAT,
                   AMBIL_SATKER_TELEPON(D.SATKER_ID) SATKER_TELEPON,
                   PERIODE, A.PEGAWAI_ID, a.PANGKAT_ID, P.NAMA || ' (' || P.KODE || ')' PANGKAT,  
                   COALESCE(B.JABATAN,'') PEJABAT_PENETAP1, A.PEJABAT_PENETAP, A.NO_SK, NO_SK_LAMA,  TANGGAL_SK_LAMA, PEJABAT_LAMA, MK_TAHUN_LAMA, MK_BULAN_LAMA,
                   TEMPAT_LAHIR || ', ' || TO_CHAR(TANGGAL_LAHIR, 'DD-MM-YYYY') TTL,
                   TMT_BARU, MASA_KERJA_TAHUN || ' - ' || MASA_KERJA_BULAN MASA_KERJA,
                   MK_TAHUN_LAMA || ' - ' || MK_BULAN_LAMA MASA_KERJA_LAMA, 
                   GAJI_BARU, a.NIP_LAMA, a.NIP_BARU, 
                   A.NAMA, GOL_RUANG, P.NAMA GOL_RUANG_NAMA, a.SATKER_ID,
                   SATKER_ID_GENERATE, TANGGAL_PROSES, TMT_LAMA, 
                   GAJI_LAMA, CASE WHEN F.TIPE_PEGAWAI_ID = '12' THEN 'Fungsional umum' ELSE E.JABATAN END PANGKATJABATAN, D.NAMA SATKER, E.ESELON ESELON, F.TEMPAT_LAHIR TEMPAT_LAHIR, F.TANGGAL_LAHIR TANGGAL_LAHIR,
                   G.PENDIDIKAN, G.JURUSAN
                FROM KGB A 
                LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID                
                LEFT JOIN PANGKAT P ON A.PANGKAT_ID = P.PANGKAT_ID  
                LEFT JOIN JABATAN_TERAKHIR E ON cast(A.PEGAWAI_ID as varchar) = E.PEGAWAI_ID    
                LEFT JOIN PEGAWAI F ON A.PEGAWAI_ID = F.PEGAWAI_ID
                LEFT JOIN SATKER D ON F.SATKER_ID = D.SATKER_ID
                LEFT JOIN PENDIDIKAN_TERAKHIR G ON A.PEGAWAI_ID = G.PEGAWAI_ID
                WHERE 1 = 1
				".$statement; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = $val ";
		}
		
		$str .= " ORDER BY PANGKAT_ID DESC";
		$this->query = $str;
		//echo $str;
		//$str .= " AND $key LIKE '$val%' ";
		
		return $this->selectLimit($str,$limit,$from); 
    }
	
} 
?>