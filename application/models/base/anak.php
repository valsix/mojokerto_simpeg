<? 
include_once(APPPATH.'/models/Entity.php');

class Anak extends Entity{ 

	var $query;

	function Anak()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT ANAK_ID, PEGAWAI_ID, a.PENDIDIKAN_ID, 
				   a.NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   JENIS_KELAMIN, STATUS_KELUARGA, STATUS_TUNJANGAN, 
				   PEKERJAAN, AWAL_BAYAR, AKHIR_BAYAR, 
				   TANGGAL_UPDATE, FOTO,
				   (SELECT x.NAMA FROM PENDIDIKAN x WHERE x.PENDIDIKAN_ID = a.PENDIDIKAN_ID) NMPENDIDIKAN,
				   case when STATUS_KELUARGA = 1 then 'Kandung'
				   when STATUS_KELUARGA = 2 then 'Tiri'
				   when STATUS_KELUARGA = 3 then 'Angkat'
				   end KELUARGA,
				   case when STATUS_KELUARGA = 1 then 'AK'
				   when STATUS_KELUARGA = 2 then 'AT'
				   when STATUS_KELUARGA = 3 then 'AA'
				   end KELUARGA_LAP,
				   case when STATUS_TUNJANGAN = 1 then 'Dapat'
				   when STATUS_TUNJANGAN = 2 then 'Tidak'
				   end TUNJANGAN,
				   case when JENIS_KELAMIN = 'L' then 'Laki-Laki' 
				   when JENIS_KELAMIN = 'P' then 'Perempuan'
				   end KELAMIN, FOTO_BLOB,LINK_FILE_APPS
                FROM ANAK a WHERE 1 = 1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_LAHIR ASC ";
		$this->query = $str;
				
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>