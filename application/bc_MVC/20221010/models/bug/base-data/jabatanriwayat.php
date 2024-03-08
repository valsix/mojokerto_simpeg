<? 
  include_once(APPPATH.'/models/Entity.php');

  class JabatanRiwayat extends Entity{ 

	var $query;

    function JabatanRiwayat()
	{
      $this->Entity(); 
    }


    function insertadmin()
	{
		$this->setField("JABATAN_RIWAYAT_ID", $this->getNextId("JABATAN_RIWAYAT_ID","JABATAN_RIWAYAT")); 
		
		$str = "INSERT INTO JABATAN_RIWAYAT (
				   JABATAN_RIWAYAT_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, 
				   JABATAN_FUNGSIONAL_ID, NO_SK, ESELON_ID, 
				   TANGGAL_SK, TMT_JABATAN,
				   TMT_ESELON, NAMA, NO_PELANTIKAN, KETERANGAN_BUP,
				   TANGGAL_PELANTIKAN, TUNJANGAN, KREDIT, BULAN_DIBAYAR, SUDAH_DIBAYAR, TANGGAL_UPDATE, SATKER_ID,
				   TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN, TGL_SK_PERPANJANGAN_BUP, TMT_BATAS_USIA_PENSIUN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("JABATAN_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("JABATAN_FUNGSIONAL_ID").",
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("ESELON_ID").",
				  ".$this->getField("TANGGAL_SK").",
				  ".$this->getField("TMT_JABATAN").",
				  ".$this->getField("TMT_ESELON").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("NO_PELANTIKAN")."',
				  '".$this->getField("KETERANGAN_BUP")."',
				  ".$this->getField("TANGGAL_PELANTIKAN").",
				  ".$this->getField("TUNJANGAN").",
				  ".$this->getField("KREDIT").",
				  ".$this->getField("BULAN_DIBAYAR").",
				  ".$this->getField("SUDAH_DIBAYAR").",
				  NOW(),
				  '".$this->getField("SATKER_ID")."',
				  ".$this->getField("TMT_JABATAN_FUNGSIONAL").",
				  ".$this->getField("TMT_TUGAS_TAMBAHAN").",
				  ".$this->getField("TGL_SK_PERPANJANGAN_BUP").",
				  ".$this->getField("TMT_BATAS_USIA_PENSIUN").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
		$this->query = $str;
		// echo $str;exit;

		return $this->execQuery($str);
    }

    function updateadmin()
	{
		$str = "
				UPDATE JABATAN_RIWAYAT
				SET    
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   JABATAN_FUNGSIONAL_ID= ".$this->getField("JABATAN_FUNGSIONAL_ID").",
					   NO_SK= '".$this->getField("NO_SK")."',
					   ESELON_ID= ".$this->getField("ESELON_ID").",
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
					   TMT_JABATAN= ".$this->getField("TMT_JABATAN").",
					   TMT_ESELON= ".$this->getField("TMT_ESELON").",
					   NAMA= '".$this->getField("NAMA")."',
					   NO_PELANTIKAN= '".$this->getField("NO_PELANTIKAN")."',
					   TANGGAL_PELANTIKAN= ".$this->getField("TANGGAL_PELANTIKAN").",
					   TUNJANGAN= ".$this->getField("TUNJANGAN").",
					   KREDIT= ".$this->getField("KREDIT").",
					   BULAN_DIBAYAR= ".$this->getField("BULAN_DIBAYAR").",
					   SUDAH_DIBAYAR= ".$this->getField("SUDAH_DIBAYAR").",
					   KETERANGAN_BUP= '".$this->getField("KETERANGAN_BUP")."',
					   TANGGAL_UPDATE= NOW(),
					   SATKER_ID= '".$this->getField("SATKER_ID")."',
					   TMT_JABATAN_FUNGSIONAL= ".$this->getField("TMT_JABATAN_FUNGSIONAL").",
					   TMT_TUGAS_TAMBAHAN= ".$this->getField("TMT_TUGAS_TAMBAHAN").",
					   TGL_SK_PERPANJANGAN_BUP= ".$this->getField("TGL_SK_PERPANJANGAN_BUP").",
					   TMT_BATAS_USIA_PENSIUN= ".$this->getField("TMT_BATAS_USIA_PENSIUN").",
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE JABATAN_RIWAYAT_ID= ".$this->getField("JABATAN_RIWAYAT_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.JABATAN_RIWAYAT
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }
	
	function deleteMaster()
	{
        $str = "DELETE FROM JABATAN_RIWAYAT
                WHERE 
                  JABATAN_RIWAYAT_ID= '".$this->getField("JABATAN_RIWAYAT_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }
    
     function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.JABATAN_RIWAYAT_ID, A.PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.PEGAWAI_ID AS ID_PEGAWAI,
		   C.TIPE_PEGAWAI_ID TIPE_PEGAWAI,
		   A.SATKER_ID,
		   JABATAN_FUNGSIONAL_ID, NO_SK, A.ESELON_ID, B.NAMA ESELON, 
		   TANGGAL_SK, TMT_JABATAN, D.JABATAN PEJABAT_NAMA,
		   TMT_ESELON, A.NAMA, NO_PELANTIKAN, KETERANGAN_BUP, 
		   TANGGAL_PELANTIKAN, A.TUNJANGAN, KREDIT, BULAN_DIBAYAR, SUDAH_DIBAYAR, TANGGAL_UPDATE,
		   COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		   (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		   TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN, TGL_SK_PERPANJANGAN_BUP, TMT_BATAS_USIA_PENSIUN
		   ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM validasi.validasi_pegawai_jabatan_riwayat A
		LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
        LEFT JOIN PEGAWAI C ON A.PEGAWAI_ID = C.PEGAWAI_ID
		LEFT JOIN PEJABAT_PENETAP D ON A.PEJABAT_PENETAP_ID = D.PEJABAT_PENETAP_ID
		WHERE 1 = 1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }


    function selectByParamsAdmin($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.JABATAN_RIWAYAT_ID, A.PEGAWAI_ID, A.PEGAWAI_ID AS ID_PEGAWAI,
		   C.TIPE_PEGAWAI_ID TIPE_PEGAWAI,
		   A.SATKER_ID,
		   JABATAN_FUNGSIONAL_ID, NO_SK, A.ESELON_ID, B.NAMA ESELON, 
		   TANGGAL_SK, TMT_JABATAN, D.JABATAN PEJABAT_NAMA,
		   TMT_ESELON, A.NAMA, NO_PELANTIKAN, KETERANGAN_BUP, 
		   TANGGAL_PELANTIKAN, A.TUNJANGAN, KREDIT, BULAN_DIBAYAR, SUDAH_DIBAYAR, 
		   COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		   (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		   TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN, TGL_SK_PERPANJANGAN_BUP, TMT_BATAS_USIA_PENSIUN
		  
		FROM JABATAN_RIWAYAT A
		LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
        LEFT JOIN PEGAWAI C ON A.PEGAWAI_ID = C.PEGAWAI_ID
		LEFT JOIN PEJABAT_PENETAP D ON A.PEJABAT_PENETAP_ID = D.PEJABAT_PENETAP_ID
		WHERE 1 = 1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
    function getCountByParamsJabatanTerakhir($paramsArray=array())
	{
		$str = "SELECT TRIM(NAMA_PEGAWAI || ' (' || NIP_PEGAWAI || ')') NAMA FROM JABATAN_TERAKHIR WHERE SATKER_ID IS NOT NULL "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		return ""; 
		//echo $str;exit;
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("NAMA"); 
		else 
			return ""; 
    }
        
  } 
?>