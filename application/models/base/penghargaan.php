<? 
include_once(APPPATH.'/models/Entity.php');

class Penghargaan extends Entity{ 

	var $query;

	function Penghargaan()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PENGHARGAAN_ID, PEGAWAI_ID, 
				case 
				when PEJABAT_PENETAP_ID = NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
				else a.PEJABAT_PENETAP_ID end PEJABAT_PENETAP_ID, 
				NAMA, NO_SK, TANGGAL_SK,TAHUN, 
				case when PEJABAT_PENETAP_ID = NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
				else a.PEJABAT_PENETAP_ID end PEJABAT_PENETAP_ID,
			   	(SELECT x.NAMA 
                FROM PEJABAT_PENETAP x
                WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID OR x.JABATAN = a.PEJABAT_PENETAP
               	) NMPEJABAT,
               	case when NAMA = '1' then 'Satya Lencana Karya Satya X (Perunggu)'
               	when NAMA = '2' then 'Satya Lencana Karya Satya XX (Perak)'
               	when NAMA = '3' then 'Satya Lencana Karya Satya XXX (Emas)'
               	end  NMPENGHARGAAN,
               	(SELECT x.JABATAN 
                FROM PEJABAT_PENETAP x
                WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID OR x.JABATAN = a.PEJABAT_PENETAP
               	) NMPEJABATPENETAP, FOTO_BLOB
				FROM PENGHARGAAN a WHERE 1 = 1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TAHUN, TANGGAL_SK ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>