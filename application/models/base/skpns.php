<? 
include_once(APPPATH.'/models/Entity.php');

class SkPns extends Entity{ 

	var $query;

	function SkPns()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='order by NO_UJI_KESEHATAN asc')
	{
		$str = "SELECT SK_PNS_ID, PEGAWAI_ID, PANGKAT_ID, 
				   case when PEJABAT_PENETAP_ID = NULL then 
				   (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
				   else PEJABAT_PENETAP_ID end PEJABAT_PENETAP_ID, TMT_PNS, SUMPAH, 
				   NO_UJI_KESEHATAN, NO_PRAJAB, TANGGAL_UJI_KESEHATAN, 
				   NO_SK, TANGGAL_PRAJAB, NAMA_PENETAP, NOMOR_BERITA_ACARA, TANGGAL_BERITA_ACARA, KETERANGAN_LPJ,
				   TANGGAL_SK, NIP_PENETAP, TANGGAL_SUMPAH, FOTO_BLOB, MASA_KERJA_TAHUN, MASA_KERJA_BULAN
				FROM SK_PNS WHERE SK_PNS_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ". $orderby;
		$this->query = $str;
		$this->setlogdata("SK_PNS", "INSERT", $str);
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function insert()
	{
		$this->setField("SK_PNS_ID", $this->getNextId("SK_PNS_ID","SK_PNS")); 
		$str = "INSERT INTO SK_PNS (
				   SK_PNS_ID, PEGAWAI_ID, PANGKAT_ID, 
				   PEJABAT_PENETAP_ID, TMT_PNS, SUMPAH, 
				   NO_UJI_KESEHATAN, NO_PRAJAB, TANGGAL_UJI_KESEHATAN, 
				   NO_SK, TANGGAL_PRAJAB, NAMA_PENETAP, 
				   TANGGAL_SK, NIP_PENETAP, NOMOR_BERITA_ACARA, TANGGAL_BERITA_ACARA, KETERANGAN_LPJ,
				   MASA_KERJA_TAHUN, MASA_KERJA_BULAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("SK_PNS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("PANGKAT_ID")."',
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  ".$this->getField("TMT_PNS").",
				  '".$this->getField("SUMPAH")."',
				  '".$this->getField("NO_UJI_KESEHATAN")."',
				  '".$this->getField("NO_PRAJAB")."',
				  ".$this->getField("TANGGAL_UJI_KESEHATAN").",
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_PRAJAB").",
				  '".$this->getField("NAMA_PENETAP")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("NIP_PENETAP")."',
				  '".$this->getField("NOMOR_BERITA_ACARA")."',
				  ".$this->getField("TANGGAL_BERITA_ACARA").",
				  '".$this->getField("KETERANGAN_LPJ")."',
				  '".$this->getField("MASA_KERJA_TAHUN")."',
				  '".$this->getField("MASA_KERJA_BULAN")."'	,				 
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->id= $this->getField("SK_PNS_ID");
		$this->query = $str;
		$this->setlogdata("SK_PNS", "INSERT", $str);
		// echo $str;exit;
		return $this->execQuery($str);
  	}

  	function update()
	{
		$str = "
				UPDATE SK_PNS
				SET    
					   PANGKAT_ID    = '".$this->getField("PANGKAT_ID")."',
					   PEJABAT_PENETAP_ID             = ".$this->getField("PEJABAT_PENETAP_ID").",
					   TMT_PNS     = ".$this->getField("TMT_PNS").",
					   SUMPAH    = '".$this->getField("SUMPAH")."',
					   NO_UJI_KESEHATAN    = '".$this->getField("NO_UJI_KESEHATAN")."',
					   NO_PRAJAB  = '".$this->getField("NO_PRAJAB")."',
					   TANGGAL_UJI_KESEHATAN = ".$this->getField("TANGGAL_UJI_KESEHATAN").",
					   NO_SK        = '".$this->getField("NO_SK")."',
					   TANGGAL_PRAJAB       = ".$this->getField("TANGGAL_PRAJAB").",
					   NAMA_PENETAP      = '".$this->getField("NAMA_PENETAP")."',
					   TANGGAL_SK   = ".$this->getField("TANGGAL_SK").",
					   NIP_PENETAP             = '".$this->getField("NIP_PENETAP")."',
					   MASA_KERJA_TAHUN    = '".$this->getField("MASA_KERJA_TAHUN")."',
					   MASA_KERJA_BULAN    = '".$this->getField("MASA_KERJA_BULAN")."',
					   NOMOR_BERITA_ACARA= '".$this->getField("NOMOR_BERITA_ACARA")."',
				  	   TANGGAL_BERITA_ACARA= ".$this->getField("TANGGAL_BERITA_ACARA").",
				  	   KETERANGAN_LPJ= '".$this->getField("KETERANGAN_LPJ")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  SK_PNS_ID          = '".$this->getField("SK_PNS_ID")."'
				"; 
				$this->query = $str;
				$this->setlogdata("SK_PNS", "UPDATE", $str);

				// echo $str;exit;
		return $this->execQuery($str);
    }
} 
?>