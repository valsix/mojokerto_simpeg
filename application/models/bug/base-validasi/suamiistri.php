<? 
  include_once(APPPATH.'/models/Entity.php');

  class SuamiIstri extends Entity{ 

	var $query;

    function SuamiIstri()
	{
      $this->Entity(); 
    }

    	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.SUAMI_ISTRI")); 
		
		$str = "INSERT INTO validasi.SUAMI_ISTRI ( 
				   SUAMI_ISTRI_ID, PEGAWAI_ID, PENDIDIKAN_ID, 
				   NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   TANGGAL_KAWIN, KARTU, SK_CERAI, BUKU_NIKAH, STATUS_PNS, 
				   NIP_PNS, PEKERJAAN, STATUS_TUNJANGAN, 
				   STATUS_BAYAR, BULAN_BAYAR, STATUS, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("SUAMI_ISTRI_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PENDIDIKAN_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("TEMPAT_LAHIR")."',
				  ".$this->getField("TANGGAL_LAHIR").",
				  ".$this->getField("TANGGAL_KAWIN").",
				  '".$this->getField("KARTU")."',
				  '".$this->getField("SK_CERAI")."',
				  '".$this->getField("BUKU_NIKAH")."',
				  ".$this->getField("STATUS_PNS").",
				  '".$this->getField("NIP_PNS")."',
				  '".$this->getField("PEKERJAAN")."',
				  ".$this->getField("STATUS_TUNJANGAN").",
				  ".$this->getField("STATUS_BAYAR").",
				  ".$this->getField("BULAN_BAYAR").",
				  ".$this->getField("STATUS").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("TEMP_VALIDASI_ID");
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("SUAMI_ISTRI_FILE_ID", $this->getNextId("SUAMI_ISTRI_FILE_ID","SUAMI_ISTRI_FILE")); 
		
		$str = "INSERT INTO SUAMI_ISTRI_FILE(
	            SUAMI_ISTRI_FILE_ID,SUAMI_ISTRI_ID, PEGAWAI_ID,  TEMP_VALIDASI_ID,
	            NAMA_FILE_KK, LINK_FILE_KK, NAMA_FILE_AKTA,LINK_FILE_AKTA,NAMA_FILE_KTP,LINK_FILE_KTP,LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("SUAMI_ISTRI_FILE_ID").",
				  ".$this->getField("SUAMI_ISTRI_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  ".$this->getField("TEMP_VALIDASI_ID").",
				  '".$this->getField("NAMA_FILE_KK")."',
				  '".$this->getField("LINK_FILE_KK")."',
				  '".$this->getField("NAMA_FILE_AKTA")."',
				  '".$this->getField("LINK_FILE_AKTA")."',
				  '".$this->getField("NAMA_FILE_KTP")."',
				  '".$this->getField("LINK_FILE_KTP")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

     function updateupload($nama,$link,$tipe)
	{
		$str = "
				UPDATE SUAMI_ISTRI_FILE
				SET    
					   TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID").",
					   ".$nama."= '".$this->getField($nama)."',
					   ".$link."= '".$this->getField($link)."',
					   ".$tipe."= '".$this->getField($tipe)."',
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  SUAMI_ISTRI_FILE_ID= '".$this->getField("SUAMI_ISTRI_FILE_ID")."'
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE validasi.SUAMI_ISTRI
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID").",
					   NAMA= '".$this->getField("NAMA")."',
					   TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
					   TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
					   TANGGAL_KAWIN= ".$this->getField("TANGGAL_KAWIN").",
					   KARTU= '".$this->getField("KARTU")."',
					   SK_CERAI= '".$this->getField("SK_CERAI")."',
				       BUKU_NIKAH= '".$this->getField("BUKU_NIKAH")."',
					   STATUS_PNS= ".$this->getField("STATUS_PNS").",
					   NIP_PNS= '".$this->getField("NIP_PNS")."',
					   PEKERJAAN= '".$this->getField("PEKERJAAN")."',
					   STATUS_TUNJANGAN= ".$this->getField("STATUS_TUNJANGAN").",
					   STATUS_BAYAR= ".$this->getField("STATUS_BAYAR").",
					   STATUS= ".$this->getField("STATUS").",
					   BULAN_BAYAR= ".$this->getField("BULAN_BAYAR").",
					   FOTO= '".$this->getField("FOTO")."',
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "
				UPDATE validasi.SUAMI_ISTRI
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID").",
					   NAMA= '".$this->getField("NAMA")."',
					   TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
					   TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
					   TANGGAL_KAWIN= ".$this->getField("TANGGAL_KAWIN").",
					   KARTU= '".$this->getField("KARTU")."',
					   SK_CERAI= '".$this->getField("SK_CERAI")."',
				       BUKU_NIKAH= '".$this->getField("BUKU_NIKAH")."',
					   STATUS_PNS= ".$this->getField("STATUS_PNS").",
					   NIP_PNS= '".$this->getField("NIP_PNS")."',
					   PEKERJAAN= '".$this->getField("PEKERJAAN")."',
					   STATUS_TUNJANGAN= ".$this->getField("STATUS_TUNJANGAN").",
					   STATUS_BAYAR= ".$this->getField("STATUS_BAYAR").",
					   STATUS= ".$this->getField("STATUS").",
					   BULAN_BAYAR= ".$this->getField("BULAN_BAYAR").",
					   FOTO= '".$this->getField("FOTO")."',
					   VALIDASI	= ".$this->getField("VALIDASI").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					   TANGGAL_VALIDASI= NOW()
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.SUAMI_ISTRI
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

     function deletefile($reqNama,$reqLink,$reqTipe)
	{
		$str = "UPDATE SUAMI_ISTRI_FILE
		SET
		".$reqNama." = '', 
		".$reqLink." = '',
		".$reqTipe." = ''
		WHERE SUAMI_ISTRI_FILE_ID= ".$this->getField("SUAMI_ISTRI_FILE_ID")."
		AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
		"; 

		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }


    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.SUAMI_ISTRI_ID, A.PEGAWAI_ID, A.PENDIDIKAN_ID, 
		 B.GELAR_DEPAN ||  CASE B.GELAR_DEPAN WHEN NULL THEN '' ELSE ' ' END || B.NAMA || CASE B.GELAR_BELAKANG WHEN NULL THEN '' ELSE ' ' END || B.GELAR_BELAKANG NAMA_PEGAWAI,
		 B.NIP_BARU NIP_PEGAWAI,
		 A.NAMA, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR, 
		 A.TANGGAL_KAWIN, A.KARTU, A.BUKU_NIKAH NO_HP, A.SK_CERAI NO_AKTA_NIKAH, A.STATUS_PNS,
		 CASE STATUS_PNS WHEN 1 THEN 'Ya' ELSE 'Tidak' END NMPNS,
		 A.NIP_PNS, A.PEKERJAAN, A.STATUS_TUNJANGAN, 
		 A.STATUS_BAYAR, A.BULAN_BAYAR,
		 C.NAMA NMPENDIDIKAN, STATUS
		 , CASE WHEN STATUS = '1' THEN 'nikah' WHEN STATUS = '2' THEN 'cerai' WHEN STATUS = '3' THEN 'meninggal' END STATUS_INFO
		 ,A.TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI,
		 CASE WHEN A.FOTO_BLOB IS NULL THEN NULL ELSE 99 END FOTO_BLOB
		 ,COALESCE(PJ.LINK_FILE_KK,PA.LINK_FILE_KK) LINK_FILE_KK
		 ,COALESCE(PJ.LINK_FILE_AKTA,PA.LINK_FILE_AKTA) LINK_FILE_AKTA
		 ,COALESCE(PJ.LINK_FILE_KTP,PA.LINK_FILE_KTP) LINK_FILE_KTP
		 ,COALESCE(PJ.SUAMI_ISTRI_FILE_ID,PA.SUAMI_ISTRI_FILE_ID)SUAMI_ISTRI_FILE_ID
		FROM validasi.validasi_pegawai_suami_istri A
		LEFT JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
		LEFT JOIN PENDIDIKAN C ON A.PENDIDIKAN_ID = C.PENDIDIKAN_ID
		LEFT JOIN SUAMI_ISTRI_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN SUAMI_ISTRI_FILE PA ON PA.SUAMI_ISTRI_ID = A.SUAMI_ISTRI_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

     function selectByParamsCheckPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.PEGAWAI_ID,A.NIP_BARU 
		FROM PEGAWAI A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

     function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY SUAMI_ISTRI_FILE_ID")
	{
		$str = "
		SELECT A.SUAMI_ISTRI_FILE_ID,A.PEGAWAI_ID, 
		A.NAMA_FILE_KK,A.NAMA_FILE_AKTA,A.NAMA_FILE_KTP ,A.LINK_FILE_KK
		 ,A.LINK_FILE_AKTA
		 ,A.LINK_FILE_KTP, A.TIPE_FILE,A.TEMP_VALIDASI_ID,A.SUAMI_ISTRI_ID
		FROM SUAMI_ISTRI_FILE A
		LEFT JOIN validasi.SUAMI_ISTRI B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsServer($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY LINK_SERVER_ID")
	{
		$str = "
		SELECT LINK_SERVER_ID, LINK_SERVER, FOLDER, JENIS
		FROM LINK_SERVER
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
        
  } 
?>