<? 
include_once(APPPATH.'/models/Entity.php');

class CatatanPrestasi extends Entity{ 

	var $query;

	function CatatanPrestasi()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PRESTASI_KERJA_ID, PEGAWAI_ID, KETERANGAN, 
				   a.NAMA, NO_SK, TANGGAL_SK, TAHUN, 
                   case when a.PEJABAT_PENETAP_ID = NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
                   else a.PEJABAT_PENETAP_ID 
                   	end PEJABAT_PENETAP_ID, 
                   (SELECT x.NAMA 
                    FROM PEJABAT_PENETAP x
                    WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID OR x.JABATAN = a.PEJABAT_PENETAP
                   ) NMPEJABATPENETAP, FOTO_BLOB,
                   case when b.JABATAN = NULL then a.PEJABAT_PENETAP else b.JABATAN end PEJABAT_PENETAP
                FROM PRESTASI_KERJA a
                LEFT JOIN PEJABAT_PENETAP b ON a.PEJABAT_PENETAP_ID = b.PEJABAT_PENETAP_ID
				WHERE 1=1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NAMA ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>