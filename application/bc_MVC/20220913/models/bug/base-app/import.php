<? 
  
  include_once(APPPATH.'/models/Entity.php');

  class Import extends Entity{ 

	var $query;

    function Import()
	{
      $this->Entity(); 
    }

	function insertjabatan()
	{
		$this->setField("PEGAWAI_JABATAN_ID", $this->getNextId("PEGAWAI_JABATAN_ID","PEGAWAI_JABATAN")); 
		
		$str = "INSERT INTO PEGAWAI_JABATAN (
						PEGAWAI_JABATAN_ID, PEGAWAI_ID, ESELON_ID, JENIS_JABATAN_ID, 
						TIPE_PEGAWAI_NEW_ID, JABATAN_FUNGSIONAL_NEW_ID, JABATAN_PELAKSANA_NEW_ID, 
						JABATAN_STRUKTURAL_NEW_ID, BUP, KELAS_JABATAN, TMT_JABATAN,TANGGAL_SK,  
						TUGAS_TAMBAHAN_ID, TUGAS_TAMBAHAN_NAMA,NO_SK,LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,UNOR_ID)
				VALUES (
				  ".$this->getField("PEGAWAI_JABATAN_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("ESELON_ID").",
				  ".$this->getField("JENIS_JABATAN_ID").",
				  '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
				  '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
				  '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
				  '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
				  ".$this->getField("BUP").",
				  ".$this->getField("KELAS_JABATAN").",
				  ".$this->getField("TMT_JABATAN").",
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("TUGAS_TAMBAHAN_ID")."',
				  '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
				  '".$this->getField("NO_SK")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				   ".$this->getField("UNOR_ID")."
				)"; 
				
		$this->query = $str;
		// echo  $str;exit;
		return $this->execQuery($str);
    }

    function updateJabatan()
	{
		$str = "
				UPDATE PEGAWAI_JABATAN
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   ESELON_ID    = ".$this->getField("ESELON_ID").",
					   JENIS_JABATAN_ID             = ".$this->getField("JENIS_JABATAN_ID").",
					   TIPE_PEGAWAI_NEW_ID     = '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
					   JABATAN_FUNGSIONAL_NEW_ID     = '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
					   JABATAN_PELAKSANA_NEW_ID     = '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
					   JABATAN_STRUKTURAL_NEW_ID     = '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
					   BUP     = ".$this->getField("BUP").",
					   KELAS_JABATAN     = ".$this->getField("KELAS_JABATAN").",
					   TMT_JABATAN     = ".$this->getField("TMT_JABATAN").",
					   TANGGAL_SK     = ".$this->getField("TANGGAL_SK").",
					   NO_SK     = '".$this->getField("NO_SK")."',
					   TUGAS_TAMBAHAN_ID     = '".$this->getField("TUGAS_TAMBAHAN_ID")."',
					   TUGAS_TAMBAHAN_NAMA     = '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
					   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."',
					   UNOR_ID	= ".$this->getField("UNOR_ID")."
				WHERE PEGAWAI_JABATAN_ID= ".$this->getField("PEGAWAI_JABATAN_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }


   	function insertpendidikan()
	{
		$this->setField("PEGAWAI_PENDIDIKAN_RIWAYAT_ID", $this->getNextId("PEGAWAI_PENDIDIKAN_RIWAYAT_ID","PEGAWAI_PENDIDIKAN_RIWAYAT")); 
		
		$str = "INSERT INTO PEGAWAI_PENDIDIKAN_RIWAYAT (
						PEGAWAI_PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, ID,PEGAWAI_PENDIDIKAN_ID,TINGKAT_PENDIDIKAN_ID, TANGGAL_LULUS, 
						TAHUN_LULUS, NOMOR_IJAZAH, NAMA_SEKOLAH, 
						GELAR_DEPAN, GELAR_BELAKANG, PENDIDIKAN_CPNS,LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("PEGAWAI_PENDIDIKAN_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("ID")."',
				  '".$this->getField("PEGAWAI_PENDIDIKAN_ID")."',
				  '".$this->getField("TINGKAT_PENDIDIKAN_ID")."',
				  ".$this->getField("TANGGAL_LULUS").",
				  ".$this->getField("TAHUN_LULUS").",
				  '".$this->getField("NOMOR_IJAZAH")."',
				  '".$this->getField("NAMA_SEKOLAH")."',
				  '".$this->getField("GELAR_DEPAN")."',
				  '".$this->getField("GELAR_BELAKANG")."',
				  '".$this->getField("PENDIDIKAN_CPNS")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		// echo  $str;exit;
		return $this->execQuery($str);
    }

    function updatependidikan()
	{
		$str = "
				UPDATE PEGAWAI_PENDIDIKAN_RIWAYAT
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   ID    = '".$this->getField("ID")."',
					   TANGGAL_LULUS             = ".$this->getField("TANGGAL_LULUS").",
					   TAHUN_LULUS     = ".$this->getField("TAHUN_LULUS").",
					   NOMOR_IJAZAH     = '".$this->getField("NOMOR_IJAZAH")."',
					   NAMA_SEKOLAH     = '".$this->getField("NAMA_SEKOLAH")."',
					   GELAR_DEPAN     = '".$this->getField("GELAR_DEPAN")."',
					   GELAR_BELAKANG     = '".$this->getField("GELAR_BELAKANG")."',
					   PENDIDIKAN_CPNS     = '".$this->getField("PENDIDIKAN_CPNS")."',
					   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE PEGAWAI_PENDIDIKAN_RIWAYAT_ID= ".$this->getField("PEGAWAI_PENDIDIKAN_RIWAYAT_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }

    function selectByParamsRiwayatJabatan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
    		*
		FROM
		(
			  SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID, A.ESELON_ID, A.JENIS_JABATAN_ID, 
			  A.TIPE_PEGAWAI_NEW_ID, A.JABATAN_FUNGSIONAL_NEW_ID, A.JABATAN_PELAKSANA_NEW_ID, 
			  A.JABATAN_STRUKTURAL_NEW_ID, A.BUP, A.KELAS_JABATAN
			  NO_SK,A.TUGAS_TAMBAHAN_ID,A.TUGAS_TAMBAHAN_NAMA,
			  B.NAMA KATEGORI_JABATAN,C.NAMA NAMA_FUNGSIONAL,D.NAMA JENIS_JABATAN,E.NAMA NAMA_PELAKSANA,F.NAMA NAMA_STRUKTURAL,H.NAMA ESELON_NAMA
			  ,P.NIP_BARU,P.NAMA NAMA_PEGAWAI,
			  COALESCE(AMBIL_FORMAT_NIP_BARU(P.NIP_BARU),'') || ' - ' || P.NAMA GROUP_NAMA,A.TMT_JABATAN
			  FROM pegawai_jabatan A
			  LEFT JOIN TIPE_PEGAWAI_NEW B ON B.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
			  LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
			  LEFT JOIN JENIS_JABATAN D ON D.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
			  LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
			  LEFT JOIN JABATAN_STRUKTURAL_NEW F ON F.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
			  LEFT JOIN ESELON H ON H.ESELON_ID = A.ESELON_ID
			  LEFT JOIN PEGAWAI P ON P.PEGAWAI_ID = A.PEGAWAI_ID
			  LEFT JOIN SATKER S ON S.SATKER_ID = P.SATKER_ID
			  WHERE 1=1
		) A
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
		SELECT
    		*
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

    function selectByParamsCheckStruktural($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
    		*
		FROM JABATAN_STRUKTURAL_NEW A
		WHERE ID_JABATAN IS NOT NULL
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsCheckFungsional($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
    		*
		FROM JABATAN_FUNGSIONAL_NEW A
		WHERE ID_JABATAN IS NOT NULL
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsCheckPelaksana($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
    		*
		FROM JABATAN_PELAKSANA_NEW A
		WHERE ID_JABATAN IS NOT NULL
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

     function selectByParamsCheckJabatan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT * FROM pegawai_jabatan A
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

    function selectByParamsRiwayatPendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.PEGAWAI_PENDIDIKAN_RIWAYAT_ID, A.PEGAWAI_ID, A.PEGAWAI_PENDIDIKAN_ID, 
		A.TINGKAT_PENDIDIKAN_ID, A.TANGGAL_LULUS, A.TAHUN_LULUS, A.NOMOR_IJAZAH, 
		A.NAMA_SEKOLAH,A.GELAR_DEPAN, A.GELAR_BELAKANG, A.PENDIDIKAN_CPNS,B.NAMA PEGAWAI_PENDIDIKAN,C.NAMA TINGKAT_PENDIDIKAN,A.ID,
		 COALESCE(AMBIL_FORMAT_NIP_BARU(P.NIP_BARU),'') || ' - ' || P.NAMA GROUP_NAMA
		FROM PEGAWAI_PENDIDIKAN_RIWAYAT A
		LEFT JOIN PEGAWAI_PENDIDIKAN B ON B.PEGAWAI_PENDIDIKAN_ID = A.PEGAWAI_PENDIDIKAN_ID
		LEFT JOIN TINGKAT_PENDIDIKAN C ON C.KODE = A.TINGKAT_PENDIDIKAN_ID
		LEFT JOIN PEGAWAI P ON P.PEGAWAI_ID = A.PEGAWAI_ID
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

    function selectByParamsCheckPendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT * FROM PEGAWAI_PENDIDIKAN
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

    function selectByParamsCheckRiwayatPendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT * FROM PEGAWAI_PENDIDIKAN_RIWAYAT
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