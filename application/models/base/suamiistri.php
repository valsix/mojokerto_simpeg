<? 
  	include_once(APPPATH.'/models/Entity.php');
  	include_once(APPPATH.'/models/base/DbLog.php');

  	class SuamiIstri extends Entity{ 

	var $query;

    function SuamiIstri()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("SUAMI_ISTRI_ID", $this->getNextId("SUAMI_ISTRI_ID","suami_istri")); 

		$str = "
		INSERT INTO suami_istri
		(
			SUAMI_ISTRI_ID, PEGAWAI_ID, PENDIDIKAN_ID, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, TANGGAL_KAWIN, KARTU, STATUS_PNS
			, NIP_PNS, PEKERJAAN, STATUS_TUNJANGAN, STATUS_BAYAR, BULAN_BAYAR, FOTO, STATUS,JENIS_KELAMIN
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("SUAMI_ISTRI_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("PENDIDIKAN_ID")."'
			, '".$this->getField("NAMA")."'
			, '".$this->getField("TEMPAT_LAHIR")."'
			, ".$this->getField("TANGGAL_LAHIR")."
			, ".$this->getField("TANGGAL_KAWIN")."
			, '".$this->getField("KARTU")."'
			, '".$this->getField("STATUS_PNS")."'
			, '".$this->getField("NIP_PNS")."'
			, '".$this->getField("PEKERJAAN")."'
			, '".$this->getField("STATUS_TUNJANGAN")."'
			, '".$this->getField("STATUS_BAYAR")."'
			, ".$this->getField("BULAN_BAYAR")."
			, '".$this->getField("FOTO")."'
			, 1
			, '".$this->getField("JENIS_KELAMIN")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";
		$this->id= $this->getField("SUAMI_ISTRI_ID");	
		$this->query = $str;

		// echo $str;exit;
		
		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("suami_istri", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE suami_istri
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, PENDIDIKAN_ID= '".$this->getField("PENDIDIKAN_ID")."'
			, NAMA= '".$this->getField("NAMA")."'
			, TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."'
			, TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR")."
			, TANGGAL_KAWIN= ".$this->getField("TANGGAL_KAWIN")."
			, KARTU= '".$this->getField("KARTU")."'
			, STATUS_PNS= '".$this->getField("STATUS_PNS")."'
			, NIP_PNS= '".$this->getField("NIP_PNS")."'
			, PEKERJAAN= '".$this->getField("PEKERJAAN")."'
			, STATUS_TUNJANGAN= '".$this->getField("STATUS_TUNJANGAN")."'
			, STATUS_BAYAR= '".$this->getField("STATUS_BAYAR")."'
			, BULAN_BAYAR= ".$this->getField("BULAN_BAYAR")."
			, FOTO= '".$this->getField("FOTO")."'
			, JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."'
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE SUAMI_ISTRI_ID= '".$this->getField("SUAMI_ISTRI_ID")."'
		";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("suami_istri", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function insert_nikah_riwayat()
	{
		$this->setField("SUAMI_ISTRI_ID", $this->getNextId("SUAMI_ISTRI_ID","suami_istri")); 

		$str = "
		INSERT INTO suami_istri
		(
			SUAMI_ISTRI_ID, PEGAWAI_ID, NAMA, STATUS_PNS, NIP_PNS, PEKERJAAN, STATUS
			, SK_CERAI_TANGGAL, SK_CERAI_TMT, SK_CERAI
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("SUAMI_ISTRI_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("NAMA")."'
			, '".$this->getField("STATUS_PNS")."'
			, '".$this->getField("NIP_PNS")."'
			, '".$this->getField("PEKERJAAN")."'
			, 0
			, ".$this->getField("SK_CERAI_TANGGAL")."
			, ".$this->getField("SK_CERAI_TMT")."
			, '".$this->getField("SK_CERAI")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";
		$this->id= $this->getField("SUAMI_ISTRI_ID");	
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("suami_istri", "INSERT", $str);

		return $this->execQuery($str);
    }
    
	function update_nikah_riwayat()
	{
		$str = "
		UPDATE suami_istri
		SET    
			NAMA= '".$this->getField("NAMA")."'
			, STATUS_PNS= '".$this->getField("STATUS_PNS")."'
			, NIP_PNS= '".$this->getField("NIP_PNS")."'
			, PEKERJAAN= '".$this->getField("PEKERJAAN")."'
			, SK_CERAI_TANGGAL= ".$this->getField("SK_CERAI_TANGGAL")."
			, SK_CERAI_TMT= ".$this->getField("SK_CERAI_TMT")."
			, SK_CERAI= '".$this->getField("SK_CERAI")."'
			, STATUS= 0
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE SUAMI_ISTRI_ID= '".$this->getField("SUAMI_ISTRI_ID")."'
		"; 
		$this->query = $str;
		// echo $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("suami_istri", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM suami_istri
        WHERE 
        SUAMI_ISTRI_ID = '".$this->getField("SUAMI_ISTRI_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("suami_istri", "DELETE", $str);

        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		SUAMI_ISTRI_ID, PEGAWAI_ID, PENDIDIKAN_ID
		, (SELECT X.GELAR_DEPAN ||  (case when X.GELAR_DEPAN = NULL then '' else ' ' end ) || X.NAMA || (case when X.GELAR_BELAKANG = NULL then '' else ' ' end) || X.GELAR_BELAKANG FROM PEGAWAI X WHERE A.PEGAWAI_ID = X.PEGAWAI_ID) NAMA_PEGAWAI
		, (SELECT X.NIP_BARU FROM PEGAWAI X WHERE A.PEGAWAI_ID = X.PEGAWAI_ID) NIP_PEGAWAI
		, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR
		, TANGGAL_KAWIN, KARTU, STATUS_PNS
		,
		case when STATUS_PNS = 1 then 'Ya' when STATUS_PNS = 0 then 'Tidak' end  NMPNS
		, NIP_PNS, PEKERJAAN, STATUS_TUNJANGAN
		, STATUS_BAYAR, BULAN_BAYAR, FOTO
		, (SELECT X.NAMA  FROM PENDIDIKAN X WHERE X.PENDIDIKAN_ID = a.PENDIDIKAN_ID) NMPENDIDIKAN
		, FOTO_BLOB, SK_CERAI, SK_CERAI_TANGGAL, SK_CERAI_TMT, STATUS, FOTO_SCAN, DOSIR_KARPEG
		, FORMAT_KARPEG, UKURAN_KARPEG, DOSIR_SURAT_NIKAH, FORMAT_SURAT_NIKAH
		, UKURAN_SURAT_NIKAH, LINK_FILE_APPS_KARPEG, LINK_FILE_APPS_SURAT_NIKAH, JENIS_KELAMIN
		FROM suami_istri A WHERE SUAMI_ISTRI_ID IS NOT NULL"; 
	
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_KAWIN ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }        
  } 
?>