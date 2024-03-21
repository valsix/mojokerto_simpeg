<? 
include_once(APPPATH.'/models/Entity.php');

class Organisasi extends Entity{ 

	var $query;

	function Organisasi()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, JABATAN, 
				   NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
				   PIMPINAN, TEMPAT, FOTO_BLOB
				FROM ORGANISASI_RIWAYAT WHERE ORGANISASI_RIWAYAT_ID IS NOT NULL "; 
		//, AMBIL_JUMLAH_BULAN(TANGGAL_AWAL, TANGGAL_AKHIR) LAMA
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