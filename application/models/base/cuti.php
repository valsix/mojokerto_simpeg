<? 
include_once(APPPATH.'/models/Entity.php');

class Cuti extends Entity{ 

	var $query;

	function Cuti()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT CUTI_ID, PEGAWAI_ID, JENIS_CUTI, 
				   NO_SURAT, TANGGAL_PERMOHONAN, TANGGAL_SURAT, 
				   LAMA, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   KETERANGAN, FOTO_BLOB,
				   case 
				   when JENIS_CUTI = 1 then 'Cuti Tahunan' 
				   when JENIS_CUTI = 2 then 'Cuti Besar' 
				   when JENIS_CUTI = 3 then 'Cuti Sakit'
				   when JENIS_CUTI = 4 then 'Cuti Bersalin'
				   when JENIS_CUTI = 5 then 'CLTN'
				   when JENIS_CUTI = 6 then 'Perpanjangan CLTN'
				   when JENIS_CUTI = 7 then 'Cuti Menikah'
				   when JENIS_CUTI = 10 then 'Cuti Alasan Penting'
				   end  NMCUTI
				FROM CUTI WHERE CUTI_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NO_SURAT ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>