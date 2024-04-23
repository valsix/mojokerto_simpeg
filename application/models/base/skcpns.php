<? 
include_once(APPPATH.'/models/Entity.php');

class SkCpns extends Entity{ 

	var $query;

	function SkCpns()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='order by NO_STTPP asc')
	{
		$str = "SELECT SK_CPNS_ID, PEGAWAI_ID, PANGKAT_ID, 					
                   case
                   when PEJABAT_PENETAP_ID is NULL 
                   then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
                   else PEJABAT_PENETAP_ID  end PEJABAT_PENETAP_ID, 
                   TMT_CPNS, TANGGAL_TUGAS, 
                   NO_STTPP, NO_NOTA, TANGGAL_NOTA, 
                   NO_SK, TANGGAL_STTPP, NAMA_PENETAP, 
                   TANGGAL_SK, NIP_PENETAP, TANGGAL_UPDATE, FOTO_BLOB, MASA_KERJA_TAHUN, MASA_KERJA_BULAN,LINK_FILE_APPS, LINK_FILE_APPS_KONVERSI, LINK_FILE_APPS_PENETAPAN_NIP, LINK_FILE_APPS_SPMT, LINK_FILE_APPS_PRAJAB, LINK_FILE_APPS_D2
                FROM SK_CPNS A WHERE SK_CPNS_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ". $orderby;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function insert()
	{
		$this->setField("SK_CPNS_ID", $this->getNextId("SK_CPNS_ID","SK_CPNS")); 
		$str = "INSERT INTO SK_CPNS (
				SK_CPNS_ID, PEGAWAI_ID, NO_NOTA, 
				TANGGAL_NOTA, NAMA_PENETAP,NIP_PENETAP, NO_SK
				TANGGAL_SK, TMT_CPNS,PANGKAT_ID, TANGGAL_TUGAS
				MASA_KERJA_TAHUN, MASA_KERJA_BULAN
				)
				VALUES (
				  ".$this->getField("SK_CPNS_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("NO_NOTA")."',
				  '".$this->getField("TANGGAL_NOTA")."',
				  '".$this->getField("NAMA_PENETAP")."',
				  '".$this->getField("NIP_PENETAP")."',
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("TMT_CPNS")."',
				  '".$this->getField("PANGKAT_ID")."',
				  ".$this->getField("TANGGAL_TUGAS").",
				  '".$this->getField("MASA_KERJA_TAHUN")."',
				  '".$this->getField("MASA_KERJA_BULAN")."'
				)"; 
				
		$this->id= $this->getField("SK_CPNS_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
  	}

  	function update()
	{
		$str = "
				UPDATE SK_CPNS
				SET    
					   NO_NOTA    = '".$this->getField("NO_NOTA")."',
					   TANGGAL_NOTA    = ".$this->getField("TANGGAL_NOTA").",
					   NAMA_PENETAP    = '".$this->getField("NAMA_PENETAP")."',
					   NIP_PENETAP    = '".$this->getField("NIP_PENETAP")."',
					   NO_SK    = '".$this->getField("NO_SK")."',
					   TANGGAL_SK    = ".$this->getField("TANGGAL_SK").",
					   TMT_CPNS    = ".$this->getField("TMT_CPNS").",
					   PANGKAT_ID    = '".$this->getField("PANGKAT_ID")."',
					   TANGGAL_TUGAS    = ".$this->getField("TANGGAL_TUGAS").",
					   MASA_KERJA_TAHUN    = ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN    = ".$this->getField("MASA_KERJA_BULAN")."
				WHERE  SK_CPNS_ID          = '".$this->getField("SK_CPNS_ID")."'
				"; 
				$this->query = $str;

				// echo $str;exit;
		return $this->execQuery($str);
    }
} 
?>